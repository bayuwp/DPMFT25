<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi3 extends Model
{
    use HasFactory;

    protected $table = 'komisi_3';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'deskripsi',
    ];
}
