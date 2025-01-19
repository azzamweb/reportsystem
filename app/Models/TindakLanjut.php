<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
    protected $fillable = [
        'tahun_anggaran',
        'waktu_pengerjaan',
        'biaya',
        'sumber_dana_id',
        'laporan_id',
        'foto',
        'keterangan',
        'pihak_ketiga',
        'dokumen_pendukung',
    ];

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class, 'sumber_dana_id');
    }

public function laporan()
{
    return $this->belongsTo(Laporan::class);
}
}
