<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    use HasFactory;

    protected $fillable = [
    'pengawasan_id',
    'nama_proker',
    'berita',
    'status',
    'tanggal',
    'ketupel',
    'kategori',
];

    public function pengawasan()
    {
        return $this->belongsTo(Pengawasan::class);
    }
}

