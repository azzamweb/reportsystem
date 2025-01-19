<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Laporan;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\TindakLanjut;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with(['kecamatan', 'desa', 'jenisLaporan','tindakLanjut'])->orderBy('created_at', 'desc')->get(); // Tambahkan relasi
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();

        //mengambil jenis laporan yang sudah di entri dengan nilai uniq
        $jenisLaporans = DB::table('laporans')
    ->join('jenis_laporans', 'laporans.jenis_laporan_id', '=', 'jenis_laporans.id')
    ->select('jenis_laporans.id', 'jenis_laporans.nama_laporan')
    ->distinct()
    ->get();

    
        return view('dashboard', compact('laporans', 'kecamatans', 'desas','jenisLaporans'));
    }
}
