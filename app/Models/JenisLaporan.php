<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Namespace yang benar untuk HasFactory


use Illuminate\Database\Eloquent\Model;

class JenisLaporan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_laporan', 'keterangan', 'gambar'];

    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'jenis_laporan_id');
    }
}
