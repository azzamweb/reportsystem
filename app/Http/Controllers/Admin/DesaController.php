<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Laporan;

class DesaController extends Controller
{
    public function index()
    {
        $desas = Desa::with('kecamatan')->get();
        return view('admin.desas.index', compact('desas'));
    }

    public function getDesas($kecamatanId)
    {
        // Ambil desa berdasarkan kecamatan
        $desas = Desa::where('kecamatan_id', $kecamatanId)->get();

        // Kembalikan data dalam bentuk JSON
        return response()->json($desas);
    }

    public function create()
    {
        $kecamatans = Kecamatan::all();
        return view('admin.desas.create', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatans,id',
        ]);

        Desa::create($request->all());
        return redirect()->route('desas.index')->with('success', 'Desa berhasil ditambahkan!');
    }

    public function edit(Desa $desa)
    {
        $kecamatans = Kecamatan::all();
        return view('admin.desas.edit', compact('desa', 'kecamatans'));
    }

    public function update(Request $request, Desa $desa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatans,id',
        ]);

        $desa->update($request->all());
        return redirect()->route('desas.index')->with('success', 'Desa berhasil diperbarui!');
    }

    public function destroy(Desa $desa)
{
    // Periksa apakah desa memiliki relasi dengan laporan
    if ($desa->laporans()->exists()) {
        return redirect()->route('desas.index')
            ->with('error', 'Desa tidak dapat dihapus karena masih digunakan oleh laporan.');
    }

    // Hapus desa jika tidak ada relasi
    $desa->delete();

    return redirect()->route('desas.index')
        ->with('success', 'Desa berhasil dihapus!');
}

}
