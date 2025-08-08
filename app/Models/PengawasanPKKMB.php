<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PengawasanPKKMB extends Model
{
    use HasFactory;

    protected $table = 'pengawasan_pkkmbs';

    protected $fillable = [
        'tanggal',
        'berita',
        'dokumentasi',
    ];
}
