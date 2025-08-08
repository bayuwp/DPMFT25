<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi1 extends Model
{
    use HasFactory;

    protected $table = 'komisi_1';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'deskripsi',
    ];
}
