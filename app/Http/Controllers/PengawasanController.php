<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengawasanController extends Controller
{
    protected $programs;
    protected $jurusanEmails;

    public function __construct()
    {
        $this->middleware('auth')->only(['loginJurusan', 'show', 'validasiStatus']);

        $this->programs = [
            ['name' => 'Teknik Mesin', 'slug' => 'teknik-mesin'],
            ['name' => 'Pendidikan Teknik Mesin', 'slug' => 'pendidikan-teknik-mesin'],
            ['name' => 'Pendidikan Tata Boga', 'slug' => 'pendidikan-tata-boga'],
            ['name' => 'Pendidikan Tata Busana', 'slug' => 'pendidikan-tata-busana'],
            ['name' => 'Pendidikan Tata Rias', 'slug' => 'pendidikan-tata-rias'],
            ['name' => 'Teknik Informatika', 'slug' => 'teknik-informatika'],
            ['name' => 'Pendidikan Teknik Informatika', 'slug' => 'pendidikan-teknik-informatika'],
            ['name' => 'Sistem Informasi', 'slug' => 'sistem-informasi'],
            ['name' => 'Teknik Elektro', 'slug' => 'teknik-elektro'],
            ['name' => 'Pendidikan Teknik Elektro', 'slug' => 'pendidikan-teknik-elektro'],
            ['name' => 'Teknik Sipil', 'slug' => 'teknik-sipil'],
            ['name' => 'Pendidikan Teknik Bangunan', 'slug' => 'pendidikan-teknik-bangunan'],
            ['name' => 'Perencanaan Wilayah dan Kota', 'slug' => 'pwk'],
            ['name' => 'Badan Eksekutif Mahasiswa', 'slug' => 'bem'],
        ];

        $this->jurusanEmails = [
            'teknik-mesin' => 'teknik.mesin@ft.unesa.ac.id',
            'pendidikan-teknik-mesin' => 'pendidikan.mesin@ft.unesa.ac.id',
            'pendidikan-tata-boga' => 'tata.boga@ft.unesa.ac.id',
            'pendidikan-tata-busana' => 'tata.busana@ft.unesa.ac.id',
            'pendidikan-tata-rias' => 'tata.rias@ft.unesa.ac.id',
            'teknik-informatika' => 'informatika@ft.unesa.ac.id',
            'pendidikan-teknik-informatika' => 'pendidikan.informatika@ft.unesa.ac.id',
            'sistem-informasi' => 'sistem.informasi@ft.unesa.ac.id',
            'teknik-elektro' => 'elektro@ft.unesa.ac.id',
            'pendidikan-teknik-elektro' => 'pendidikan.elektro@ft.unesa.ac.id',
            'teknik-sipil' => 'sipil@ft.unesa.ac.id',
            'pendidikan-teknik-bangunan' => 'bangunan@ft.unesa.ac.id',
            'pwk' => 'pwk@ft.unesa.ac.id',
            'bem' => 'bem@ft.unesa.ac.id',
        ];
    }

    public function selectJurusan()
    {
        return view('agenda.pengawasan.select', [
            'programs' => $this->programs,
        ]);
    }

    public function loginJurusan($slug)
    {
        $jurusan = collect($this->programs)->firstWhere('slug', $slug);

        if (!$jurusan) {
            abort(404, 'Jurusan tidak ditemukan.');
        }

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('jurusan.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!isset($this->jurusanEmails[$slug]) || $user->email !== $this->jurusanEmails[$slug]) {
            return redirect()->route('pengawasan.select')->with('error', 'Akses ditolak. Email Anda tidak sesuai dengan jurusan yang dipilih.');
        }

        return redirect()->route('pengawasan.detail', ['slug' => $slug]);
    }

    public function show($slug)
{
    $nama = ucwords(str_replace('-', ' ', $slug));
    $model = $this->getModelInstance($slug);

    if (!class_exists($model)) {
        return redirect()->route('pengawasan.select')->with('error', 'Model tidak ditemukan.');
    }

    // Ambil semua data proker dari model (object Eloquent)
    $prokers = $model::orderBy('tanggal')->get([
        'id',
        'nama_proker',
        'ketupel',
        'tanggal',
        'kategori',
        'status'
    ]);

    return view('agenda.pengawasan.detail', [
        'data' => [
            'nama'       => $nama,
            'slug'       => $slug,
            'logo'       => asset('img/logo-hmp.png'),
            'deskripsi'  => "Deskripsi kegiatan dari $nama",
            'foto_proker'=> asset('img/foto-proker.jpg'),
            'prokers'    => $prokers
        ],
    ]);
}

    public function showJurusan($slug)
    {
        return view('auth.jurusan-login', [
            'slug' => $slug,
            'programs' => $this->programs,
        ]);
    }

    public function validasiStatus(Request $request, $slug, $id)
{
    $model = $this->getModelInstance($slug);

    if (!class_exists($model)) {
        return redirect()->back()->with('error', 'Model tidak ditemukan.');
    }

    // Ambil data proker dari DB sebagai object Eloquent
    $proker = $model::find($id);

    if (!$proker) {
        return redirect()->back()->with('error', 'Data proker tidak ditemukan.');
    }

    // Ambil status dari input user
    $proker->status = $request->input('status');
    $proker->save();

    return redirect()->route('pengawasan.detail', ['slug' => $slug])
        ->with('success', 'Status berhasil diperbarui!');
}


    protected function getModelInstance($slug)
    {
        $map = [
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

        return $map[$slug] ?? null;
    }



}
