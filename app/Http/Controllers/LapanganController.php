<?php

namespace App\Http\Controllers; 

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapangans = Lapangan::all();
        return view('lapangan.index', compact('lapangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lapangan.create');
        //return view lapangan.create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lapangan' => 'required',
            'jenis_olahraga' => 'required',
            'jenis_lantai' => 'required',
            'ukuran' => 'required',
            'status_fisik' => 'required',
        ]);

        Lapangan::create($validated);

        return redirect()->route('lapangan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        return view('lapangan.edit', compact('lapangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $lapangan = Lapangan::findOrFail($id);

        return view('lapangan.edit', compact('lapangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'nama_lapangan' => 'required',
            'jenis_olahraga' => 'required',
            'jenis_lantai' => 'required',
            'ukuran' => 'required',
            'status_fisik' => 'required',
        ]);

        $lapangan = Lapangan::findOrFail($id);

        $lapangan->update($validated);

        return redirect()->route('lapangan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $lapangan->delete();
        //lapangan delete

        return redirect()->route('lapangan.index');
    }
}
