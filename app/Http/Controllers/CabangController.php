<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Produk;
use App\Models\StokCabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        $cabangs = Cabang::withCount('stokCabangs')->latest()->get();
        return view('backend.cabang.index', compact('cabangs'));
    }

    public function create()
    {
        return view('backend.cabang.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cabang' => 'required|unique:cabangs',
            'nama_cabang' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        Cabang::create($request->all());
        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $cabang = Cabang::findOrFail($id);
        return view('backend.cabang.form', compact('cabang'));
    }

    public function update(Request $request, $id)
    {
        $cabang = Cabang::findOrFail($id);
        
        $request->validate([
            'kode_cabang' => 'required|unique:cabangs,kode_cabang,' . $id,
            'nama_cabang' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $cabang->update($request->all());
        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil diupdate');
    }

    public function destroy($id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabang->delete();
        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil dihapus');
    }

    // Kelola stok cabang
    public function stok($id)
    {
        $cabang = Cabang::findOrFail($id);
        $produks = Produk::with(['kategori'])->get();
        
        // Get stok untuk cabang ini
        $stoks = StokCabang::where('cabang_id', $id)
            ->with('produk.kategori')
            ->get()
            ->keyBy('produk_id');
        
        return view('backend.cabang.stok', compact('cabang', 'produks', 'stoks'));
    }

    // Update stok cabang
    public function updateStok(Request $request, $id)
    {
        $cabang = Cabang::findOrFail($id);
        
        $request->validate([
            'stok' => 'required|array',
            'stok.*' => 'required|integer|min:0',
        ]);

        foreach ($request->stok as $produk_id => $jumlah_stok) {
            StokCabang::updateOrCreate(
                [
                    'cabang_id' => $cabang->id,
                    'produk_id' => $produk_id,
                ],
                [
                    'stok' => $jumlah_stok
                ]
            );
        }

        return redirect()->route('cabang.stok', $id)->with('success', 'Stok berhasil diupdate');
    }
}
