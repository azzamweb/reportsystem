<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kecamatan;
use App\Models\Desa; 
use App\Models\Laporan;
use App\Models\JenisLaporan;
use App\Models\TindakLanjut;


class LaporanController extends Controller
{
    public function index()
    {
        // Ambil semua laporan dari database
        $laporans = Laporan::all();

        // Kembalikan view dengan data laporan
        return view('dashboard', compact('laporans'));

        
    }

    public function create()
{
    $kecamatans = Kecamatan::all(); // Data kecamatan
    $jenisLaporans = JenisLaporan::all(); // Data jenis laporan

    return view('admin.laporans.create', compact('kecamatans', 'jenisLaporans'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nama_kk_penerima' => 'required|string|max:255',
        'no_kk_penerima' => 'required|string|max:255',
        'alamat_penerima' => 'required|string',
        'kecamatan_id' => 'required|exists:kecamatans,id',
        'desa_id' => 'required|exists:desas,id',
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'titik_koordinat' => 'required|string',
        'jenis_laporan_id' => 'required|exists:jenis_laporans,id',
        // Validasi lainnya
        'tahun_pengajuan' => 'required|integer|between:2020,2025',
    ]);

    // Simpan data ke database
    $laporan = new Laporan();
    $laporan->fill($validated);
    $laporan->user_id = auth()->id();

    // Simpan file gambar
    if ($request->hasFile('foto')) {
        $laporan->foto = $request->file('foto')->store('laporans', 'public');
    }

    $laporan->save();

    return redirect()->route('dashboard')->with('success', 'Laporan berhasil dibuat.');
}

        public function show($id)
        {
            $laporan = Laporan::with(['kecamatan', 'desa'])->findOrFail($id);
            return view('admin.laporans.show', compact('laporan'));
        }

        public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $kecamatans = Kecamatan::all();
        $desas = Desa::where('kecamatan_id', $laporan->kecamatan_id)->get();
        $jenisLaporans = JenisLaporan::all(); // Data jenis laporan

        return view('admin.laporans.edit', compact('laporan', 'kecamatans', 'desas','jenisLaporans'));
    }

    public function update(Request $request, Laporan $laporan)
{
    $validated = $request->validate([
        'nama_kk_penerima' => 'required|string|max:255',
        'no_kk_penerima' => 'required|string|max:255',
        'alamat_penerima' => 'required|string',
        'kecamatan_id' => 'required|exists:kecamatans,id',
        'desa_id' => 'required|exists:desas,id',
        'jenis_laporan_id' => 'required|exists:jenis_laporans,id',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'tahun_pengajuan' => 'required|integer|between:2020,2025',
    ]);

    $laporan->fill($validated);

    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }
        // Simpan foto baru
        $laporan->foto = $request->file('foto')->store('laporans', 'public');
    }

    $laporan->save();

    return redirect()->route('dashboard')->with('success', 'Laporan berhasil diperbarui.');
}

public function map()
{
    $kecamatans = Kecamatan::all(); // Data kecamatan
    $jenisLaporans = JenisLaporan::all(); // Data jenis laporan
    $desas = Desa::all();
    $laporans = Laporan::with(['kecamatan', 'desa', 'jenisLaporan','tindakLanjut'])->get();
    return view('admin.laporans.map', compact('laporans', 'kecamatans','jenisLaporans','desas'));
    
}

public function autocomplete(Request $request)
{
    $query = $request->get('query');

    // Cari laporan berdasarkan nama KK, nomor KK, kecamatan, atau desa
    $laporans = Laporan::with(['kecamatan', 'desa'])
        ->where('nama_kk_penerima', 'LIKE', "%{$query}%")
        ->orWhere('no_kk_penerima', 'LIKE', "%{$query}%")
        ->orWhereHas('kecamatan', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })
        ->orWhereHas('desa', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })
        ->limit(10)
        ->get();

    // Format data untuk JSON
    $data = $laporans->map(function ($laporan) {
        return [
            'id' => $laporan->id,
            'nama_kk_penerima' => $laporan->nama_kk_penerima,
            'no_kk_penerima' => $laporan->no_kk_penerima,
            'kecamatan' => $laporan->kecamatan->name ?? '-',
            'desa' => $laporan->desa->name ?? '-',
        ];
    });

    return response()->json($data);
    
}

}
