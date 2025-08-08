<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProkerPendidikanTeknikMesin extends Model
{
    use HasFactory;

    protected $table = 'prokers_pendidikan_teknik_mesin';

    protected $fillable = [
    'kategori',
    'nama_proker',
    'ketupel',
    'nomor_wa', // ✅ tambahkan ini
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
