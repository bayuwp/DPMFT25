<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawasan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug', 'deskripsi', 'logo', 'foto_proker', ];

    public function prokers()
    {
        return $this->hasMany(Proker::class);
    }
}

