<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Namespace yang benar untuk HasFactory


use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function desas()
    {
        return $this->hasMany(Desa::class);
    }
}
