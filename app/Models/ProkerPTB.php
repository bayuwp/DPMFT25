<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProkerPTB extends Model
{
    use HasFactory;

    protected $table = 'prokers_ptb';

    protected $fillable = [
        'kategori',
        'nama_proker',
        'ketupel',
        'nomor_wa',
        'tanggal',
        'proposal',
        'lpj',
        'status',
        'status_proposal',
        'status_lpj',
        'lpa',
        'rundown_kegiatan',
        'absensi_panitia',
        'absensi_peserta',
        'absensi_tamu_undangan',
        'instrumen_materi',
        'dokumentasi',
        'time_stap',
    ];
}
