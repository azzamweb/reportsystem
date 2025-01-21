<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SumberDana;
use App\Models\Laporan;
use Illuminate\Http\Request;

class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sumberDana = SumberDana::all();
        return view('admin.sumber_dana.index', compact('sumberDana'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sumber_dana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:sumber_dana,nama|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        SumberDana::create($request->all());
        return redirect()->route('sumber_dana.index')->with('success', 'Sumber Dana berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SumberDana $sumberDana)
    {
        return view('admin.sumber_dana.edit', compact('sumberDana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SumberDana $sumberDana)
    {
        $request->validate([
            'nama' => 'required|max:255|unique:sumber_dana,nama,' . $sumberDana->id,
            'deskripsi' => 'nullable|string',
        ]);

        $sumberDana->update($request->all());
        return redirect()->route('sumber_dana.index')->with('success', 'Sumber Dana berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SumberDana $sumberDana)
{
    // Periksa apakah sumber dana sudah digunakan dalam tindak lanjut
    if ($sumberDana->tindaklanjut()->exists()) {
        return redirect()->route('sumber_dana.index')->with('error', 'Sumber Dana tidak dapat dihapus karena sudah digunakan pada Tindak Lanjut.');
    }

    

    // Hapus sumber dana
    $sumberDana->delete();

    return redirect()->route('sumber_dana.index')->with('success', 'Sumber Dana berhasil dihapus.');
}

}
