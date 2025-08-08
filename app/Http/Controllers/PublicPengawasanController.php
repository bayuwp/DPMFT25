<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabinet;

class PublicPengawasanController extends Controller
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
                    'logo_cabinet' => $cabinet->logo_cabinet ?? null, // ambil logo
                ];
            });

        return view('agenda.pengawasan.index', compact('jurusans'));
    }



    protected function getModel($slug)
    {
        if (!isset($this->modelMap[$slug])) {
            abort(404, 'Program tidak ditemukan');
        }
        return $this->modelMap[$slug];
    }

    public function show($slug)
    {
        $model = $this->getModel($slug);
        $prokers = $model::all();

        $data = [
            'slug' => $slug,
            'nama_proker' => ucwords(str_replace('-', ' ', $slug)),
            'deskripsi' => 'Deskripsi kegiatan dari ' . ucwords(str_replace('-', ' ', $slug)),
            'logo' => null,
            'foto_proker' => null,
            'prokers' => $prokers->map(function ($proker) {
                return [
                    'id' => $proker->id,
                    'nama_proker' => $proker->nama_proker ?? '-',
                    'ketupel' => $proker->ketupel ?? '-',
                    'no_wa' => $proker->no_wa ?? '-',
                    'tanggal' => $proker->tanggal ?? '-',
                    'kategori' => $proker->kategori ?? '-',
                    'berita' => $proker->berita ?? '-',
                    'instrumen_materi' => $proker->instrumen_materi ?? '-',
                    'status' => $proker->status ?? 'Belum Terisi',
                    'edit_request_status' => $proker->edit_request_status ?? 'none',
                    'created_at' => $proker->created_at->format('d-m-Y H:i'),
                ];
            }),
        ];

        return view('agenda.pengawasan.detail', compact('data'));
    }

    public function prokerDetail($slug, $id)
    {
        $model = $this->getModel($slug);
        $proker = $model::findOrFail($id);

        return view('agenda.pengawasan.proker-detail', compact('slug', 'proker'));
    }

    public function edit($slug, $id)
    {
        $model = $this->getModel($slug);
        $proker = $model::findOrFail($id);

        // Pastikan view edit sudah ada di resources/views/agenda/pengawasan/edit.blade.php
        return view('agenda.pengawasan.edit', compact('slug', 'proker'));
    }

    public function store(Request $request, $slug)
    {
        $model = $this->getModel($slug);

        $validated = $request->validate([
            'nama_proker' => 'required|string|max:255',
            'ketupel' => 'required|string|max:255',
            'nomor_wa' => 'required|string|max:20',
            'tanggal' => 'nullable|date',
            'kategori' => 'nullable|string|max:255',
            'berita' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'instrumen_materi' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        // Simpan file berita
        if ($request->hasFile('berita')) {
            $validated['berita'] = $request->file('berita')->store('berita', 'public');
        }

        // Simpan file instrumen materi
        if ($request->hasFile('instrumen_materi')) {
            $validated['instrumen_materi'] = $request->file('instrumen_materi')->store('instrumen', 'public');
        }

        $validated['terlaksana'] = $request->hasFile('berita') || $request->hasFile('instrumen_materi');

        $model::create($validated);

        return redirect()->route('pengawasan.show', $slug)->with('success', 'Proker berhasil disimpan!');
    }

    public function update(Request $request, $slug, $id)
    {
        $model = $this->getModel($slug);
        $proker = $model::findOrFail($id);

        $validated = $request->validate([
            'nama_proker' => 'required|string|max:255',
            'ketupel' => 'required|string|max:255',
            'nomor_wa' => 'required|string|max:20',
            'tanggal' => 'nullable|date',
            'kategori' => 'nullable|string|max:255',
            'berita' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($request->hasFile('berita')) {
            $validated['berita'] = $request->file('berita')->store('berita', 'public');
        }


        $validated['terlaksana'] = $request->hasFile('berita') || $request->hasFile('instrumen_materi');

        $proker->update($validated);

        return redirect()->route('pengawasan.show', $slug)->with('success', 'Proker berhasil diperbarui!');
    }



    public function destroy($slug, $id)
    {
        $model = $this->getModel($slug);
        $proker = $model::findOrFail($id);
        $proker->delete();

        return redirect()->route('pengawasan.show', $slug)->with('success', 'Proker berhasil dihapus!');
    }

    // === Permintaan Edit ===
    public function requestEdit($slug, $id)
    {
        $model = $this->getModel($slug);
        $proker = $model::find($id);

        if (!$proker) {
            return redirect()->back()->with('error', 'Data proker tidak ditemukan.');
        }

        $proker->edit_request_status = 'pending';
        $proker->save();

        return redirect()->back()->with('success', 'Permintaan edit telah dikirim ke admin.');
    }

    public function approveEdit($slug, $id)
    {
        $model = $this->getModel($slug);
        $proker = $model::find($id);

        if (!$proker) {
            return redirect()->back()->with('error', 'Data proker tidak ditemukan.');
        }

        $proker->edit_request_status = 'approved';
        $proker->save();

        return redirect()->back()->with('success', 'Permintaan edit disetujui.');
    }

    public function rejectEdit($slug, $id)
    {
        $model = $this->getModel($slug);
        $proker = $model::find($id);

        if (!$proker) {
            return redirect()->back()->with('error', 'Data proker tidak ditemukan.');
        }

        $proker->edit_request_status = 'rejected';
        $proker->save();

        return redirect()->back()->with('success', 'Permintaan edit ditolak.');
    }

    public function listEditRequests()
    {
        $allRequests = collect();

        foreach ($this->modelMap as $modelClass) {
            $requests = $modelClass::where('edit_request_status', 'pending')->get();
            $allRequests = $allRequests->merge($requests);
        }

        return view('admin.proker_edit_requests', [
            'requests' => $allRequests
        ]);
    }

}
