<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'nama_cabinet',
        'deskripsi_jurusan',
        'logo_cabinet',
        'foto_fungsionaris',
    ];
}
