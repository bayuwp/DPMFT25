<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataJurusan extends Model
{
    protected $table = 'data'; // semua db harus punya tabel 'data'

    public function useConnection($slug)
    {
        $map = [
            'teknik-mesin' => 'teknik_mesin',
            'pendidikan-teknik-mesin' => 'pendidikan_teknik_mesin',
            'pendidikan-tata-boga' => 'pendidikan_tata_boga',
            'pendidikan-tata-busana' => 'pendidikan_tata_busana',
            'pendidikan-tata-rias' => 'pendidikan_tata_rias',
            'teknik-informatika' => 'teknik_informatika',
            'pendidikan-teknik-informatika' => 'pendidikan_teknik_informatika',
            'sistem-informasi' => 'sistem_informasi',
            'teknik-elektro' => 'teknik_elektro',
            'pendidikan-teknik-elektro' => 'pendidikan_teknik_elektro',
            'teknik-sipil' => 'teknik_sipil',
            'pendidikan-teknik-bangunan' => 'pendidikan_teknik_bangunan',
            'perencanaan wilayah dan kota' => 'perencanaan_wilayah_dan_kota',
            'badan eksekutif mahasiswa' => 'badan_eksekutif_mahasiswa',
        ];

        if (isset($map[$slug])) {
            $this->setConnection($map[$slug]);
        }

        return $this;
    }
}
