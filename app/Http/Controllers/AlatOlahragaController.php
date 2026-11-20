<?php

namespace App\Http\Controllers;

use App\Models\AlatOlahraga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatOlahragaController extends Controller
{
    /**
     * Menampilkan daftar seluruh data alat olahraga.
     */
    public function index()
    {
        $alatOlahraga = AlatOlahraga::all();

        return view('alat_olahraga.index', compact('alatOlahraga'));
    }

    /**
     * Menampilkan form untuk menambahkan data alat olahraga.
     */
    public function create()
    {
        return view('alat_olahraga.create');
    }

    /**
     * Menyimpan data baru alat olahraga ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat'  => 'required',
            'kategori'   => 'required',
            'kondisi'    => 'required',
            'tarif_sewa' => 'required|numeric',
            'stok'       => 'required|numeric',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('alat-olahraga', 'public');
        }

        AlatOlahraga::create($validated);

        return redirect()->route('alat-olahraga.index')
            ->with('success', 'Data alat olahraga LANCAR ditambahkan!');
    }

    /**
     * Menampilkan detail alat olahraga.
     */
    public function show($id)
    {
        $alatOlahraga = AlatOlahraga::findOrFail($id);

        return view('alat_olahraga.show', compact('alatOlahraga'));
    }

    /**
     * Menampilkan form edit untuk data alat olahraga tertentu.
     */
    public function edit($id)
    {
        $alatOlahraga = AlatOlahraga::findOrFail($id);

        return view('alat_olahraga.edit', compact('alatOlahraga'));
    }

    /**
     * Memperbarui data alat olahraga di database.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_alat'  => 'required',
            'kategori'   => 'required',
            'kondisi'    => 'required',
            'tarif_sewa' => 'required|numeric',
            'stok'       => 'required|numeric',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $alatOlahraga = AlatOlahraga::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($alatOlahraga->gambar && Storage::disk('public')->exists($alatOlahraga->gambar)) {
                Storage::disk('public')->delete($alatOlahraga->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('alat-olahraga', 'public');
        }

        $alatOlahraga->update($validated);

        return redirect()->route('alat-olahraga.index')
            ->with('success', 'Data alat olahraga LANCAR diperbarui!');
    }

    /**
     * Menghapus data alat olahraga dari database.
     */
    public function destroy($id)
    {
        $alatOlahraga = AlatOlahraga::findOrFail($id);

        if ($alatOlahraga->gambar && Storage::disk('public')->exists($alatOlahraga->gambar)) {
            Storage::disk('public')->delete($alatOlahraga->gambar);
        }

        $alatOlahraga->delete();
        
        return redirect()->route('alat-olahraga.index')
            ->with('success', 'Data alat olahraga LANCAR dihapus!');
    }
}
