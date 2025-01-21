<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'sumber_dana';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    // Relationship ke TindakLanjut
    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'sumber_dana_id');
    }

    
}
