<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_kk_penerima',
        'no_kk_penerima',
        'alamat_penerima',
        'kecamatan_id',
        'desa_id',
        'foto',
        'titik_koordinat',
        'jenis_laporan_id',
        'tahun_pengajuan',
        
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class);
    }
    
    public function desa() {
        return $this->belongsTo(Desa::class);
    }
    // app/Models/Laporan.php
    public function jenisLaporan()
    {
        return $this->belongsTo(JenisLaporan::class, 'jenis_laporan_id');
    }

    public function tindakLanjut()
{
    return $this->hasOne(TindakLanjut::class);
}
}
