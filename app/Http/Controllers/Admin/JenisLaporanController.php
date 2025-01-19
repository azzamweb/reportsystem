<?php

namespace App\Http\Controllers\Admin;
use App\Models\Kecamatan;
use App\Models\JenisLaporan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JenisLaporanController extends Controller
{
    public function index()
    {
        $jenisLaporans = JenisLaporan::all();
        return view('admin.jenis_laporans.index', compact('jenisLaporans'));
    }

    public function create()
    {
        return view('admin.jenis_laporans.create');
    }

    public function store(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'nama_laporan' => 'required|string|max:255',
        'keterangan' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);
    
    // Simpan data ke database
    $jenisLaporan = new JenisLaporan();
    $jenisLaporan->nama_laporan = $validated['nama_laporan'];
    $jenisLaporan->keterangan = $validated['keterangan'];

    // Simpan gambar jika ada
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('jenis_laporans', 'public');
        $jenisLaporan->gambar = $path;
    }

    $jenisLaporan->save();

    return redirect()->route('dashboard')->with('success', 'Jenis laporan berhasil ditambahkan.');
}

public function edit($id)
{
    $jenisLaporan = JenisLaporan::findOrFail($id);
    return view('admin.jenis_laporans.edit', compact('jenisLaporan'));
}

    public function update(Request $request, JenisLaporan $jenisLaporan)
    {
        $validated = $request->validate([
            'nama_laporan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('jenis-laporans');
        }

        $jenisLaporan->update($validated);
        return redirect()->route('jenis_laporans.index')->with('success', 'Jenis Laporan berhasil diperbarui.');
    }

    public function destroy(JenisLaporan $jenisLaporan)
    {
        if ($jenisLaporan->gambar) {
            \Storage::delete($jenisLaporan->gambar);
        }
        $jenisLaporan->delete();
        return redirect()->route('jenis_laporans.index')->with('success', 'Jenis Laporan berhasil dihapus.');
    }
}
