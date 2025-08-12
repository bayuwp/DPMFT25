<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Cabinet;

class PPLFTUserController extends Controller
{
    private function getModelMap()
    {
        return [
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
    }

    private function getModelInstance($slug)
    {
        $modelMap = $this->getModelMap();
        abort_unless(isset($modelMap[$slug]), 404, 'Jurusan tidak ditemukan');
        return $modelMap[$slug];
    }

    public function index()
    {
        $jurusans = collect($this->getModelMap())->keys()->map(function ($slug) {
            $cabinet = Cabinet::where('slug', $slug)->first();

            return [
                'name' => ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'logo_cabinet' => $cabinet?->logo_cabinet
            ];
        });

        return view('pplft.index', compact('jurusans'));
    }

    public function show($slug)
    {
        $model = $this->getModelInstance($slug);
        $prokers = $model::all();
        $chats = \App\Models\Chat::where('jurusan_slug', $slug)->latest()->get();

        return view('pplft.show', compact('slug', 'prokers', 'chats'));
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'kategori' => 'required|string',
            'nama_proker' => 'required|string',
            'ketupel' => 'required|string',
            'tanggal' => 'required|date',
            'proposal' => 'nullable|file|mimes:pdf|max:2048',
            'lpj' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $model = $this->getModelInstance($slug);

        $proposalPath = $request->file('proposal')?->store("proker/{$slug}", 'public');
        $lpjPath = $request->file('lpj')?->store("lpj/{$slug}", 'public');

        $model::create([
            'kategori' => $request->kategori,
            'nama_proker' => $request->nama_proker,
            'ketupel' => $request->ketupel,
            'tanggal' => $request->tanggal,
            'proposal' => $proposalPath,
            'lpj' => $lpjPath,
            'status_proposal' => $proposalPath ? 'Diupload' : 'Belum Diunggah',
            'status_lpj' => $lpjPath ? 'Diupload' : 'Belum Diunggah',
            'lpa' => null,
        ]);

        return back()->with('success', 'Program kerja berhasil ditambahkan.');
    }

    public function updateProposal(Request $request, $slug, $id)
    {
        $request->validate(['proposal' => 'required|file|mimes:pdf|max:2048']);

        $model = $this->getModelInstance($slug);
        $proker = $model::findOrFail($id);

        if ($proker->proposal && Storage::disk('public')->exists($proker->proposal)) {
            Storage::disk('public')->delete($proker->proposal);
        }

        $proker->proposal = $request->file('proposal')->store("proker/{$slug}", 'public');
        $proker->status_proposal = 'Diupload';
        $proker->save();

        return back()->with('success', 'Proposal berhasil diperbarui.');
    }

    public function updateLpj(Request $request, $slug, $id)
    {
        $request->validate(['lpj' => 'required|file|mimes:pdf|max:2048']);

        $model = $this->getModelInstance($slug);
        $proker = $model::findOrFail($id);

        if ($proker->lpj && Storage::disk('public')->exists($proker->lpj)) {
            Storage::disk('public')->delete($proker->lpj);
        }

        $proker->lpj = $request->file('lpj')->store("lpj/{$slug}", 'public');
        $proker->status_lpj = 'Diupload';
        $proker->save();

        return back()->with('success', 'LPJ berhasil diperbarui.');
    }

    public function updateLpa(Request $request, $slug, $id)
    {
        $request->validate(['lpa' => 'required|string|max:255']);

        $model = $this->getModelInstance($slug);
        $proker = $model::findOrFail($id);

        $proker->lpa = $request->lpa;
        $proker->save();

        return back()->with('success', 'LPA berhasil diperbarui.');
    }


    public function updateDokumen(Request $request, $slug, $id, $field)
    {
        // Mapping slug ke model
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

        if (!isset($map[$slug])) {
            abort(404, 'Jurusan tidak ditemukan');
        }

        $model = $map[$slug];
        $proker = $model::findOrFail($id);

        if ($proker->$field && \Storage::exists('public/' . $proker->$field)) {
            \Storage::delete('public/' . $proker->$field);
        }

        $path = $request->file('file')->store('dokumen-proker', 'public');

        $proker->$field = $path;
        $proker->save();

        return back()->with('success', 'Dokumen berhasil diperbarui.');
    }




    public function uploadTimeStap(Request $request, $slug, $id)
    {
        $request->validate([
            'time_stap' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $model = $this->getModelInstance($slug);
        $proker = $model::findOrFail($id);

        $file = $request->file('time_stap');
        $path = $file->store("time_stap/{$slug}", 'public');

        if ($proker->time_stap && Storage::disk('public')->exists($proker->time_stap)) {
            Storage::disk('public')->delete($proker->time_stap);
        }

        $proker->time_stap = $path;
        $proker->save();

        return back()->with('success', 'Foto Time Stap berhasil diunggah.');
    }


    public function prokerDetail($slug, $id)
    {
        $model = $this->getModelInstance($slug);
        $proker = $model::findOrFail($id);

        return view('agenda.pengawasan.detail', compact('slug', 'proker'));
    }

    public function updateDokumenTambahan(Request $request, $slug, $id, $field)
    {
        $allowedFields = [
            'rundown_kegiatan',
            'absensi_panitia',
            'absensi_peserta',
            'absensi_tamu_undangan',
            'instrumen_materi',
            'dokumentasi',
        ];

        // Validasi field agar tidak bisa upload ke kolom sembarangan
        if (!in_array($field, $allowedFields)) {
            abort(400, 'Kolom tidak valid');
        }

        // Mapping slug ke model
        $slugModelMap = [
            'teknik-mesin' => \App\Models\ProkerMesin::class,
            'pendidikan-teknik-mesin' => \App\Models\ProkerPendidikanTeknikMesin::class,
            'pendidikan-tata-boga' => \App\Models\ProkerBoga::class,
            'pendidikan-tata-busana' => \App\Models\ProkerBusana::class,
            'pendidikan-tata-rias' => \App\Models\ProkerRias::class,
            'teknik-informatika' => \App\Models\ProkerTI::class,
            'pendidikan-teknik-informatika' => \App\Models\ProkerPTI::class,
            'sistem-informasi' => \App\Models\ProkerSI::class,
            'teknik-elektro' => \App\Models\ProkerElektro::class,
            'pendidikan-teknik-elektro' => \App\Models\ProkerPTE::class,
            'teknik-sipil' => \App\Models\ProkerSipil::class,
            'pendidikan-teknik-bangunan' => \App\Models\ProkerBangunan::class,
            'pwk' => \App\Models\ProkerPWK::class,
            'bem' => \App\Models\ProkerBEM::class,
        ];

        if (!array_key_exists($slug, $slugModelMap)) {
            abort(404, 'Jurusan tidak ditemukan');
        }

        $modelClass = $slugModelMap[$slug];
        $proker = $modelClass::findOrFail($id);

        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Simpan file
        $path = $request->file('file')->store("dokumen/{$field}", 'public');
        $proker->$field = $path;
        $proker->save();

        return back()->with('success', 'Dokumen berhasil diunggah.');
    }

    public function validasiStatus($slug, $id)
    {
        $model = $this->getModelInstance($slug);

        if (!class_exists($model)) {
            return redirect()->back()->with('error', 'Model tidak ditemukan.');
        }

        $proker = $model::find($id);

        if (!$proker) {
            return redirect()->back()->with('error', 'Data proker tidak ditemukan.');
        }

        // Validasi status otomatis
        if ($proker->lpj) {
            $status = 'Terlaksana';
        } elseif ($proker->proposal && $proker->instrumen_materi) {
            $status = 'Terisi';
        } else {
            $status = 'Belum Terisi';
        }

        $proker->status = $status;
        $proker->save();

        return redirect()->route('ppl-ft.show', $slug)
            ->with('success', 'Status berhasil divalidasi!');
    }

    public function updateLinkDokumen(Request $request, $slug, $id, $field)
{
    // Field yang boleh diisi dengan link
    $allowedLinkFields = ['dokumentasi', 'time_stap'];

    if (!in_array($field, $allowedLinkFields)) {
        abort(400, 'Kolom tidak valid untuk input link.');
    }

    $request->validate([
        'link' => 'required|url|max:255',
    ]);

    $model = $this->getModelInstance($slug);
    $proker = $model::findOrFail($id);

    $proker->$field = $request->link;
    $proker->save();

    return back()->with('success', ucfirst($field) . ' berhasil diperbarui dengan link.');
}




}
