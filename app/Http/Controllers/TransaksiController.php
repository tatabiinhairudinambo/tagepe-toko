<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use App\Models\Cabang;
use App\Models\StokCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\DatabaseHelper;

class TransaksiController extends Controller
{
    // Halaman kasir (input transaksi)
    public function index()
    {
        // Admin tidak perlu akses halaman kasir
        if (auth()->user()->role === 'admin') {
            return redirect()->route('dashboard')->with('info', 'Halaman kasir hanya untuk kasir.');
        }

        // Ambil semua cabang yang aktif
        $cabangs = Cabang::where('is_active', true)->get();
        $user = auth()->user();

        // Kasir otomatis pakai cabang dari akun mereka
        if ($user->role === 'kasir' && $user->cabang_id) {
            session(['cabang_id' => $user->cabang_id]);
        }

        // Ambil produk dengan stok cabang jika ada cabang_id di session
        $cabang_id = session('cabang_id');
        
        if ($cabang_id) {
            // Ambil produk yang ada stoknya di cabang ini
            $produks = Produk::with(['kategori', 'stokCabangs' => function($q) use ($cabang_id) {
                $q->where('cabang_id', $cabang_id);
            }])
            ->whereHas('stokCabangs', function($q) use ($cabang_id) {
                $q->where('cabang_id', $cabang_id)->where('stok', '>', 0);
            })
            ->get();

            // Fallback: kalau tidak ada stok cabang, tampilkan semua produk
            if ($produks->isEmpty()) {
                $produks = Produk::with('kategori')->get();
            }
        } else {
            // Jika belum pilih cabang, tampilkan semua produk (untuk backward compatibility)
            $produks = Produk::with('kategori')->where('stok', '>', 0)->get();
        }
        
        return view('backend.transaksi.index', compact('produks', 'cabangs', 'cabang_id'));
    }
    
    // Set cabang untuk transaksi
    public function setCabang(Request $request)
    {
        $request->validate([
            'cabang_id' => 'required|exists:cabangs,id'
        ]);
        
        session(['cabang_id' => $request->cabang_id]);
        return back()->with('success', 'Cabang berhasil dipilih');
    }

    // Simpan transaksi
    public function store(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('dashboard');
        }
        $request->validate([
            'cabang_id' => 'nullable|exists:cabangs,id',
            'kasir'     => 'required|string|max:100',
            'items' => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:produks,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'bayar' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $cabang_id = $request->cabang_id ?? session('cabang_id');
            
            // Simpan nama kasir ke session supaya tidak perlu isi ulang
            session(['kasir_nama' => $request->kasir]);
            
            // Hitung total & validasi stok
            $total = 0;
            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                $total += $produk->harga * $item['jumlah'];
                
                // Cek stok cabang jika ada cabang_id
                if ($cabang_id) {
                    $stokCabang = StokCabang::where('cabang_id', $cabang_id)
                        ->where('produk_id', $produk->id)
                        ->first();
                    
                    if (!$stokCabang || $stokCabang->stok < $item['jumlah']) {
                        return back()->with('error', 'Stok ' . $produk->nama_produk . ' tidak cukup di cabang ini!');
                    }
                } else {
                    // Fallback ke stok global
                    if ($produk->stok < $item['jumlah']) {
                        return back()->with('error', 'Stok ' . $produk->nama_produk . ' tidak cukup!');
                    }
                }
            }

            // Validasi bayar
            if ($request->bayar < $total) {
                return back()->with('error', 'Uang bayar kurang!');
            }

            // Generate kode transaksi
            $kode = 'TRX-' . date('Ymd') . '-' . str_pad(Transaksi::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

            // Simpan transaksi
            $transaksi = Transaksi::create([
                'cabang_id' => $cabang_id,
                'kode_transaksi' => $kode,
                'tanggal' => now(),
                'total' => $total,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $total,
                'kasir' => $request->kasir,
            ]);

            // Simpan detail & kurangi stok
            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $item['jumlah'],
                    'harga' => $produk->harga,
                    'subtotal' => $produk->harga * $item['jumlah'],
                ]);

                // Kurangi stok cabang atau stok global
                if ($cabang_id) {
                    $stokCabang = StokCabang::where('cabang_id', $cabang_id)
                        ->where('produk_id', $produk->id)
                        ->first();
                    $stokCabang->decrement('stok', $item['jumlah']);
                } else {
                    $produk->decrement('stok', $item['jumlah']);
                }
            }

            DB::commit();
            // Log aktivitas kasir
            if (auth()->user()->role === 'kasir') {
                \App\Models\AktivitasKasir::create([
                    'user_id'    => auth()->id(),
                    'aksi'       => 'transaksi',
                    'keterangan' => 'Transaksi ' . $kode,
                    'nominal'    => $total,
                ]);
            }
            return redirect()->route('transaksi.struk', $transaksi->id)->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Transaksi gagal: ' . $e->getMessage());
        }
    }

    // Tampilkan struk
    public function struk($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        $toko = \App\Models\Toko::first();
        return view('backend.transaksi.struk', compact('transaksi', 'toko'));
    }

    // Laporan transaksi
    public function laporan(Request $request)
    {
        $query = Transaksi::with('details');

        if ($request->tanggal_dari) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->tanggal_sampai) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_transaksi', 'like', "%$search%")
                  ->orWhere('kasir', 'like', "%$search%")
                  ->orWhereHas('cabang', fn($c) => $c->where('nama_cabang', 'like', "%$search%"));
            });
        }
        if ($request->cabang_id) {
            $query->where('cabang_id', $request->cabang_id);
        }

        $transaksis = $query->latest()->paginate(20);
        $total_pendapatan = $query->sum('total');
        $cabangs = \App\Models\Cabang::all();

        // Data grafik: pendapatan per hari (30 hari terakhir)
        $dateExpr = DatabaseHelper::date('tanggal');
        
        $grafikQuery = Transaksi::select(
                DB::raw("{$dateExpr} as tanggal_hari"),
                DB::raw('SUM(total) as total_hari'),
                DB::raw('COUNT(*) as jumlah_transaksi')
            )
            ->groupBy(DB::raw($dateExpr))
            ->orderBy(DB::raw($dateExpr));

        if ($request->tanggal_dari) {
            $grafikQuery->whereDate('tanggal', '>=', $request->tanggal_dari);
        } elseif (!$request->tanggal_sampai) {
            $grafikQuery->whereDate('tanggal', '>=', now()->subDays(29));
        }
        if ($request->tanggal_sampai) {
            $grafikQuery->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        $grafikData = $grafikQuery->get();
        $grafikLabels = $grafikData->pluck('tanggal_hari')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d/m'))->toArray();
        $grafikPendapatan = $grafikData->pluck('total_hari')->toArray();
        $grafikJumlah = $grafikData->pluck('jumlah_transaksi')->toArray();

        return view('backend.transaksi.laporan', compact('transaksis', 'total_pendapatan', 'grafikLabels', 'grafikPendapatan', 'grafikJumlah', 'cabangs'));
    }

    // Detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        $toko = \App\Models\Toko::first();
        return view('backend.transaksi.detail', compact('transaksi', 'toko'));
    }

    // Export PDF
    public function exportPdf(Request $request)
    {
        $query = Transaksi::with(['details.produk', 'cabang'])->latest();
        if ($request->tanggal_dari) $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        if ($request->tanggal_sampai) $query->whereDate('tanggal', '<=', $request->tanggal_sampai);

        $transaksis = $query->get();
        $total_pendapatan = $transaksis->sum('total');
        $toko = \App\Models\Toko::first();

        return view('backend.transaksi.export-pdf', compact('transaksis', 'total_pendapatan', 'toko', 'request'));
    }

    // Export CSV (Excel)
    public function exportCsv(Request $request)
    {
        $query = Transaksi::with(['cabang'])->latest();
        if ($request->tanggal_dari) $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        if ($request->tanggal_sampai) $query->whereDate('tanggal', '<=', $request->tanggal_sampai);

        $transaksis = $query->get();

        $filename = 'laporan-transaksi-' . now()->format('Ymd-His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($transaksis) {
            $file = fopen('php://output', 'w');
            // BOM untuk Excel agar bisa baca UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            // sep=; agar Excel Indonesia pakai semicolon sebagai delimiter
            fwrite($file, "sep=;\n");
            fputcsv($file, ['No', 'Kode Transaksi', 'Tanggal', 'Cabang', 'Kasir', 'Total', 'Bayar', 'Kembalian'], ';');
            foreach ($transaksis as $i => $t) {
                fputcsv($file, [
                    $i + 1,
                    $t->kode_transaksi,
                    $t->tanggal->format('d-m-Y H:i'),
                    $t->cabang->nama_cabang ?? '-',
                    $t->kasir,
                    $t->total,
                    $t->bayar,
                    $t->kembalian,
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
