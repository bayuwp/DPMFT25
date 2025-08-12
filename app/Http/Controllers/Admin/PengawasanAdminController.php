<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengawasan;
use App\Models\Proker;
use App\Models\Cabinet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengawasanAdminController extends Controller
{
    public function index()
    {
        $programs = [
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

        $programs = Cabinet::select('slug', 'nama_cabinet', 'logo_cabinet')->get();
        return view('admin.pengawasan.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.pengawasan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'foto_proker' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $logoPath = $request->file('logo')->store('logo', 'public');
        $fotoProkerPath = $request->hasFile('foto_proker')
            ? $request->file('foto_proker')->store('foto_proker', 'public')
            : null;

        $pengawasan = Pengawasan::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'logo' => $logoPath,
            'foto_proker' => $fotoProkerPath,
        ]);

        return redirect()->route('admin.proker.create', $pengawasan->id)
            ->with('success', 'Data HMP berhasil ditambahkan. Silakan tambah program kerja.');
    }

    public function show($slug)
{
    // Jika slug langsung menunjuk model Proker spesifik
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
    $prokers = $model::all();

    return view('admin.pengawasan.show', [
        'slug' => $slug,
        'nama' => ucwords(str_replace('-', ' ', $slug)),
        'prokers' => $prokers
    ]);
}


    public function edit($id)
    {
        $pengawasan = Pengawasan::findOrFail($id);
        return view('admin.pengawasan.edit', compact('pengawasan'));
    }

    public function update(Request $request, $id)
    {
        $pengawasan = Pengawasan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'foto_proker' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'slug' => Str::slug($request->nama),
        ];

        if ($request->hasFile('logo')) {
            if ($pengawasan->logo && Storage::disk('public')->exists($pengawasan->logo)) {
                Storage::disk('public')->delete($pengawasan->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo', 'public');
        }

        if ($request->hasFile('foto_proker')) {
            if ($pengawasan->foto_proker && Storage::disk('public')->exists($pengawasan->foto_proker)) {
                Storage::disk('public')->delete($pengawasan->foto_proker);
            }
            $data['foto_proker'] = $request->file('foto_proker')->store('foto_proker', 'public');
        }

        $pengawasan->update($data);

        return redirect()->route('admin.pengawasan.index')
            ->with('success', 'Data HMP berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengawasan = Pengawasan::findOrFail($id);

        if ($pengawasan->logo && Storage::disk('public')->exists($pengawasan->logo)) {
            Storage::disk('public')->delete($pengawasan->logo);
        }
        if ($pengawasan->foto_proker && Storage::disk('public')->exists($pengawasan->foto_proker)) {
            Storage::disk('public')->delete($pengawasan->foto_proker);
        }

        $pengawasan->delete();

        return redirect()->route('admin.pengawasan.index')
            ->with('success', 'Data HMP berhasil dihapus.');
    }

    // ✅ Approve request edit
    public function approveEdit($slug, $id)
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

        // Validasi slug
        if (!isset($map[$slug])) {
            abort(404, 'Jurusan tidak ditemukan');
        }

        $model = $map[$slug];
        $proker = $model::findOrFail($id);

        // Update status permintaan edit
        $proker->edit_request_status = 'approved';
        $proker->save();

        return redirect()
            ->route('admin.pengawasan.show', $slug)
            ->with('success', 'Permintaan edit berhasil disetujui.');
    }


    // ✅ Reject request edit
    public function rejectEdit($slug, $id)
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

        // Validasi slug
        if (!isset($map[$slug])) {
            abort(404, 'Jurusan tidak ditemukan');
        }

        $model = $map[$slug];
        $proker = $model::findOrFail($id);

        // Update status permintaan edit
        $proker->edit_request_status = 'rejected';
        $proker->save();

        return redirect()
            ->route('admin.pengawasan.show', $slug)
            ->with('success', 'Permintaan edit berhasil ditolak.');
    }

    // ✅ Upload Berita
    public function uploadBerita(Request $request, $slug, $id)
    {
        // Validasi file berita
        $request->validate([
            'berita' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

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

        // Validasi slug
        if (!isset($map[$slug])) {
            abort(404, 'Jurusan tidak ditemukan');
        }

        $model = $map[$slug];
        $proker = $model::findOrFail($id);

        // Simpan file berita
        $path = $request->file('berita')->store('berita', 'public');
        $proker->berita = $path;
        $proker->save();

        return redirect()
            ->route('admin.pengawasan.show', $slug)
            ->with('success', 'Berita berhasil diunggah.');
    }

    public function updateStatus(Request $request, $slug, $id)
    {
        $request->validate([
            'status' => 'required|in:belum terisi,terisi,terlaksana'
        ]);

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

        // Validasi slug
        if (!isset($map[$slug])) {
            abort(404, 'Jurusan tidak ditemukan');
        }

        $model = $map[$slug];
        $proker = $model::findOrFail($id);

        // Update status
        $proker->status = $request->status;
        $proker->save();

        return back()->with('success', 'Status proker berhasil diperbarui.');
    }





}
