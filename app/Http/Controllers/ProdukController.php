<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\AktivitasKasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Produk::with('kategori');
        
        // Filter berdasarkan kategori jika ada parameter
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }
        
        // Admin lihat semua, kasir hanya lihat produk aktif
        if ($user->role === 'admin') {
            $produks = $query->get();
        } else {
            $produks = $query->where('status', 'aktif')->get();
        }
        
        // Get kategori yang dipilih untuk ditampilkan di view
        $kategoriDipilih = $request->kategori ? \App\Models\Kategori::find($request->kategori) : null;
        
        return view('backend.produk.index', compact('produks', 'kategoriDipilih'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('backend.produk.form', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
        ]);

        $user = Auth::user();
        $isKasir = $user->role === 'kasir';

        $data = $request->only('nama', 'kategori_id', 'harga', 'stok', 'deskripsi');

        // Handle upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        } elseif ($request->filled('foto_url')) {
            $data['foto'] = $request->foto_url;
        }

        $produk = Produk::create([
            ...$data,
            'status'      => $isKasir ? 'pending' : 'aktif',
            'dibuat_oleh' => $user->id,
        ]);

        // Log aktivitas kasir
        if ($isKasir) {
            AktivitasKasir::create([
                'user_id'    => $user->id,
                'aksi'       => 'tambah_produk',
                'keterangan' => 'Mengajukan produk baru: ' . $produk->nama . ' (menunggu persetujuan admin)',
                'nominal'    => 0,
            ]);
            return redirect()->route('produk.index')->with('success', 'Produk berhasil diajukan, menunggu persetujuan admin.');
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('backend.produk.form', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama'        => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
        ]);
        $data = $request->only('nama', 'kategori_id', 'harga', 'stok', 'deskripsi');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        } elseif ($request->filled('foto_url')) {
            $data['foto'] = $request->foto_url;
        }

        $produk->update($data);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    // Admin approve produk dari kasir
    public function approve(Produk $produk)
    {
        $produk->update(['status' => 'aktif']);
        return back()->with('success', 'Produk "' . $produk->nama . '" berhasil disetujui.');
    }

    // Quick search untuk dashboard (AJAX)
    public function quickSearch(Request $request)
    {
        $search = $request->get('q', '');
        $user = Auth::user();
        
        if (strlen($search) < 2) {
            return response()->json([]);
        }

        $query = Produk::with(['kategori', 'stokCabangs'])
            ->where('status', 'aktif')
            ->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%");
            });

        // Kasir: filter by cabang
        if ($user->role === 'kasir' && $user->cabang_id) {
            $cabang_id = $user->cabang_id;
            $query->whereHas('stokCabangs', function($q) use ($cabang_id) {
                $q->where('cabang_id', $cabang_id);
            });
        }

        $produks = $query->limit(10)->get()->map(function($produk) use ($user) {
            // Get stok based on role
            $stok = 0;
            if ($user->role === 'kasir' && $user->cabang_id) {
                $stokCabang = $produk->stokCabangs->where('cabang_id', $user->cabang_id)->first();
                $stok = $stokCabang ? $stokCabang->stok : 0;
            } else {
                $stok = $produk->stok;
            }

            return [
                'id' => $produk->id,
                'nama' => $produk->nama,
                'kategori' => $produk->kategori->nama ?? '-',
                'harga' => number_format($produk->harga, 0, ',', '.'),
                'harga_raw' => $produk->harga,
                'stok' => $stok,
                'foto' => $produk->foto ? asset('storage/' . $produk->foto) : null,
            ];
        });

        return response()->json($produks);
    }
}
