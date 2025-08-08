<?php

namespace Database\Seeders;

use App\Models\Pengawasan;
use App\Models\Proker;
use Illuminate\Database\Seeder;

class PengawasanSeeder extends Seeder
{
    public function run()
    {
        $pengawasan = Pengawasan::create([
            'nama' => 'Teknik Mesin',
            'slug' => 'teknik-mesin',
            'deskripsi' => 'Deskripsi singkat Teknik Mesin.',
            'logo' => 'img/logo-tm.png',
            'foto_proker' => 'img/proker-tm.jpg',
        ]);

        $pengawasan->prokers()->createMany([
            ['nama' => 'Workshop Mesin', 'berita' => 'Berita 1', 'terlaksana' => true],
            ['nama' => 'Pelatihan CAD', 'berita' => 'Berita 2', 'terlaksana' => false],
        ]);
    }
}
