<?php

namespace App\Http\Controllers;
use App\Models\Cabinet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgendaTeknikVisionController extends Controller
{
    protected $modelMap = [
        'teknik-mesin' => \App\Models\ProkerTeknikMesin::class,
        'pendidikan-teknik-mesin' => \App\Models\ProkerPendidikanTeknikMesin::class,
        'pendidikan-tata-boga' => \App\Models\ProkerTataBoga::class,
        'pendidikan-tata-busana' => \App\Models\ProkerTataBusana::class,
        'pendidikan-tata-rias' => \App\Models\ProkerTataRias::class,
        'teknik-informatika' => \App\Models\ProkerTI::class,
        'pendidikan-teknik-informatika' => \App\Models\ProkerPTI::class,
        'sistem-informasi' => \App\Models\ProkerSI::class,
        'teknik-elektro' => \App\Models\ProkerTE::class,
        'pendidikan-teknik-elektro' => \App\Models\ProkerPTE::class,
        'teknik-sipil' => \App\Models\ProkerSipil::class,
        'pendidikan-teknik-bangunan' => \App\Models\ProkerPTB::class,
        'pwk' => \App\Models\ProkerPWK::class,
        'bem' => \App\Models\ProkerBEM::class,
    ];

    public function index()
    {
        $jurusans = collect($this->modelMap)
        ->keys()
        ->map(function ($slug) {
            $cabinet = Cabinet::where('slug', $slug)->first();
            return [
                'name' => ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'logo_cabinet' => $cabinet->logo_cabinet ?? null,
            ];
        });

        return view('ruang_cakra.index', compact('jurusans'));
    }

    public function show($slug)
    {
        $model = $this->getModel($slug);
        if (!$model) {
            abort(404, 'Model tidak ditemukan');
        }

        $prokers = $model::where('status', 'Terlaksana')
            ->orderByDesc('tanggal')
            ->get();

        $cabinet = Cabinet::where('slug', $slug)->first();

        $fotoFungsionaris = $cabinet && $cabinet->foto_fungsionaris
            ? asset('storage/' . ltrim($cabinet->foto_fungsionaris, '/'))
            : asset('img/default-fungsionaris.png');

        $namaKabinet = $cabinet && $cabinet->nama_cabinet
            ? $cabinet->nama_cabinet
            : "Nama Kabinet Tidak Tersedia";

        $deskripsi = $cabinet && $cabinet->deskripsi_jurusan
            ? $cabinet->deskripsi_jurusan
            : "Deskripsi singkat untuk jurusan " . ucwords(str_replace('-', ' ', $slug));

        return view('ruang_cakra.show', compact(
            'slug',
            'prokers',
            'fotoFungsionaris',
            'namaKabinet',
            'deskripsi'
        ));
    }




    public function detail($slug, $id)
    {
        $model = $this->getModel($slug);
        $proker = $model::findOrFail($id);

        // Ambil logo & deskripsi jurusan (jika perlu)
        $cabinet = Cabinet::where('slug', $slug)->first();

        $logo = $cabinet && $cabinet->logo_cabinet
            ? asset('storage/' . $cabinet->logo_cabinet)
            : asset("img/default-logo.png");

        $deskripsi = $cabinet && $cabinet->deskripsi_jurusan
            ? $cabinet->deskripsi_jurusan
            : "Deskripsi singkat untuk jurusan " . ucwords(str_replace('-', ' ', $slug));

        return view('ruang_cakra.detail', compact('slug', 'proker', 'logo', 'deskripsi'));
    }

    /**
     * Ambil model berdasarkan slug
     */
    private function getModel($slug)
    {
        if (!array_key_exists($slug, $this->modelMap)) {
            abort(404, 'Jurusan tidak ditemukan.');
        }
        return $this->modelMap[$slug];
    }

    /**
     * Ambil logo jika ada, gunakan default jika tidak ditemukan
     */
    private function getLogo($slug)
    {
        $logoPath = public_path("img/logo-$slug.png");
        return File::exists($logoPath)
            ? asset("img/logo-$slug.png")
            : asset("img/default-logo.png");
    }
}
