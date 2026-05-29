<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\AktivitasKasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Admin lihat semua, kasir hanya lihat produk aktif
        if ($user->role === 'admin') {
            $produks = Produk::with('kategori')->get();
        } else {
            $produks = Produk::with('kategori')->where('status', 'aktif')->get();
        }
        return view('backend.produk.index', compact('produks'));
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
}
