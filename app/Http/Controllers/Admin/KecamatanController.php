<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan; // Impor model Kecamatan


class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::all();
        return view('admin.kecamatans.index', compact('kecamatans'));
    }

    public function create()
    {
        return view('admin.kecamatans.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Kecamatan::create($request->all());
        return redirect()->route('kecamatans.index')->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    public function edit(Kecamatan $kecamatan)
    {
        return view('admin.kecamatans.edit', compact('kecamatan'));
    }

    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $kecamatan->update($request->all());
        return redirect()->route('kecamatans.index')->with('success', 'Kecamatan berhasil diperbarui!');
    }

    public function destroy(Kecamatan $kecamatan)
{
    // Periksa apakah kecamatan memiliki relasi dengan desa
    if ($kecamatan->desas()->exists()) {
        return redirect()->route('kecamatans.index')
            ->with('error', 'Kecamatan tidak dapat dihapus karena masih digunakan oleh desa.');
    }

    // Hapus kecamatan jika tidak ada relasi
    $kecamatan->delete();

    return redirect()->route('kecamatans.index')
        ->with('success', 'Kecamatan berhasil dihapus!');
}

}
