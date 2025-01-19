<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TindakLanjut;
use App\Models\Laporan;
use App\Models\SumberDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Impor Storage


class TindakLanjutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tindakLanjuts = TindakLanjut::with(['laporan', 'sumberDana'])->get();
        return view('admin.tindaklanjut.index', compact('tindakLanjuts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $laporan_id = $request->query('laporan_id'); // Ambil laporan_id dari query string
    $laporan = $laporan_id ? Laporan::with(['kecamatan', 'desa'])->findOrFail($laporan_id) : null; // Ambil data laporan jika ada
    $sumberDanas = SumberDana::all(); // Data untuk dropdown sumber dana

    return view('admin.tindaklanjut.create', compact('laporan', 'sumberDanas'));
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_anggaran' => 'required|integer|min:2000|max:'.date('Y'),
            'waktu_pengerjaan' => 'required|date',
            'biaya' => 'required|numeric',
            'sumber_dana_id' => 'required|exists:sumber_dana,id',
            'laporan_id' => 'required|exists:laporans,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'keterangan' => 'nullable|string|max:500',
            'pihak_ketiga' => 'nullable|string|max:255',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('foto')) {
         
            $validated['foto'] = $request->file('foto')->store('tindaklanjut/foto', 'public');
        }

        if ($request->hasFile('dokumen_pendukung')) {
            $validated['dokumen_pendukung'] = $request->file('dokumen_pendukung')->store('tindaklanjut/dokumen', 'public');
        }

        // Simpan data tindak lanjut dan simpan ke variabel $tindakLanjut
    $tindakLanjut = TindakLanjut::create($validated);

        
        // Redirect ke halaman detail laporan yang terkait
    return redirect()->route('laporans.show', $tindakLanjut->laporan_id)
    ->with('success', 'Tindak Lanjut berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tindaklanjut = TindakLanjut::findOrFail($id);
        $laporans = Laporan::all();
        $sumberDanas = SumberDana::all();
        return view('admin.tindaklanjut.edit', compact('tindaklanjut', 'laporans', 'sumberDanas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TindakLanjut $tindaklanjut)
{
    $validated = $request->validate([
            'tahun_anggaran' => 'required|integer|min:2000|max:'.date('Y'),
            'waktu_pengerjaan' => 'required|date',
            'biaya' => 'required|numeric',
            'sumber_dana_id' => 'required|exists:sumber_dana,id',
            'laporan_id' => 'required|exists:laporans,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'keterangan' => 'nullable|string|max:500',
            'pihak_ketiga' => 'nullable|string|max:255',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

   

    // Jika ada file baru, simpan
    if ($request->hasFile('dokumen_pendukung')) {
        $validated['dokumen_pendukung'] = $request->file('dokumen_pendukung')->store('tindaklanjut/dokumen');
    }
    if ($request->hasFile('foto')) {
        // Hapus file lama
        if ($tindaklanjut->foto) {
            Storage::disk('public')->delete($tindaklanjut->foto);
        }
        // Simpan file baru  
        $validated['foto'] = $request->file('foto')->store('tindaklanjut/foto', 'public');
    }
     // Update data
     $tindaklanjut->update($validated);

    $tindaklanjut->save();
    // return redirect()->route('dashboard')->with('success', 'Tindak Lanjut berhasil diperbarui.');
    // return redirect()->route('tindaklanjut.index')->with('success', 'Tindak lanjut berhasil diperbarui.');

    // Redirect ke halaman detail laporan yang terkait
    return redirect()->route('laporans.show', $tindaklanjut->laporan_id)
                     ->with('success', 'Tindak lanjut berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $tindakLanjut = TindakLanjut::findOrFail($id);
    // dd($tindakLanjut);
    // Periksa dan hapus file foto jika ada
    if ($tindakLanjut->foto && \Storage::disk('public')->exists($tindakLanjut->foto)) {
        Storage::disk('public')->delete($tindakLanjut->foto);
    }

    // Periksa dan hapus dokumen pendukung jika ada
    if ($tindakLanjut->dokumen_pendukung && \Storage::disk('public')->exists($tindakLanjut->dokumen_pendukung)) {
        Storage::disk('public')->delete($tindakLanjut->dokumen_pendukung);
    }
    

    // Hapus data dari database
    $tindakLanjut->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('tindaklanjut.index')->with('success', 'Tindak Lanjut berhasil dihapus.');
}


    public function autocomplete(Request $request)
{
    $query = $request->query('query');
    $laporans = Laporan::with(['kecamatan', 'desa'])
        ->where('nama_kk_penerima', 'LIKE', "%{$query}%")
        ->orWhere('no_kk_penerima', 'LIKE', "%{$query}%")
        ->get();

    return response()->json($laporans->map(function ($laporan) {
        return [
            'id' => $laporan->id,
            'nama_kk_penerima' => $laporan->nama_kk_penerima,
            'no_kk_penerima' => $laporan->no_kk_penerima,
            'kecamatan' => $laporan->kecamatan->name ?? '-',
            'desa' => $laporan->desa->name ?? '-',
        ];
    }));
}

}