<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengawasan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Proker;
use Illuminate\Support\Facades\Storage;

class AdminProkerController extends Controller
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

        return view('admin.pengawasan.index', compact('programs'));
    }

    public function show($slug)
    {
        $pengawasan = Pengawasan::where('slug', $slug)->first();

        if (!$pengawasan) {
            return redirect()->route('admin.pengawasan.create')->with('error', 'Data belum tersedia. Silakan tambahkan terlebih dahulu.');
        }

        return view('admin.pengawasan.show', compact('pengawasan'));
    }

    public function create($pengawasanId)
    {
        $pengawasan = Pengawasan::findOrFail($pengawasanId);
        return view('admin.proker.create', compact('pengawasan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pengawasan_id' => 'required|exists:pengawasans,id',
            'nama' => 'required|string|max:255',
            'berita' => 'required|file|mimes:pdf,doc,docx,txt|max:2048',
            'terlaksana' => 'required|in:0,1',
        ]);

        $beritaPath = $request->file('berita')->store('berita', 'public');

        Proker::create([
            'pengawasan_id' => $request->pengawasan_id,
            'nama' => $request->nama,
            'berita' => $beritaPath,
            'terlaksana' => $request->terlaksana,
        ]);

        $slug = Pengawasan::find($request->pengawasan_id)->slug;

        return redirect()->route('admin.pengawasan.show', $slug)
            ->with('success', 'Proker berhasil ditambahkan');
    }



    public function edit($id)
    {
        $proker = \App\Models\Proker::findOrFail($id);
        return view('admin.proker.edit', compact('proker'));
    }

    public function update(Request $request, Pengawasan $pengawasan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pengawasans,slug,' . $pengawasan->id,
            'deskripsi' => 'required|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_proker' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $pengawasan->logo = $request->file('logo')->store('logo', 'public');
        }

        if ($request->hasFile('foto_proker')) {
            $pengawasan->foto_proker = $request->file('foto_proker')->store('foto_proker', 'public');
        }

        $pengawasan->update([
            'nama' => $request->nama,
            'slug' => $request->slug,
            'deskripsi' => $request->deskripsi,
            'logo' => $pengawasan->logo,
            'foto_proker' => $pengawasan->foto_proker,
        ]);

        return redirect()->route('admin.pengawasan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Pengawasan $pengawasan)
    {
        $pengawasan->delete();
        return redirect()->route('admin.pengawasan.index')->with('success', 'Data berhasil dihapus');
    }
}
