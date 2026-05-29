<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    // Tampilkan data toko (selalu ambil baris pertama)
    public function index()
    {
        $toko = Toko::first();
        return view('backend.toko.index', compact('toko'));
    }

    // Form edit data toko
    public function edit($id)
    {
        $toko = Toko::findOrFail($id);
        return view('backend.toko.edit', compact('toko'));
    }

    // Simpan perubahan data toko
    public function update(Request $request, $id)
    {
        $toko = Toko::findOrFail($id);

        $request->validate([
            'nama_toko' => 'required|string|max:150',
            'alamat'    => 'required|string',
            'telepon'   => 'required|string|max:20',
            'email'     => 'nullable|email|max:100',
            'logo'      => 'nullable|image|max:2048',
            'logo_url'  => 'nullable|url',
        ]);

        $data = $request->only('nama_toko', 'alamat', 'telepon', 'email');

        // Prioritas: URL dulu, baru file upload
        if ($request->filled('logo_url')) {
            // Hapus logo lama jika bukan URL
            if ($toko->logo && !str_starts_with($toko->logo, 'http')) {
                \Storage::disk('public')->delete($toko->logo);
            }
            $data['logo'] = $request->logo_url;
        } elseif ($request->hasFile('logo')) {
            // Hapus logo lama jika bukan URL
            if ($toko->logo && !str_starts_with($toko->logo, 'http')) {
                \Storage::disk('public')->delete($toko->logo);
            }
            $data['logo'] = $request->file('logo')->store('toko', 'public');
        }

        $toko->update($data);

        return redirect()->route('toko.index')->with('success', 'Data toko berhasil diperbarui.');
    }
}
