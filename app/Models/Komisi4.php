<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi4 extends Model
{
    use HasFactory;

    protected $table = 'komisi_4';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'deskripsi',
    ];
}
