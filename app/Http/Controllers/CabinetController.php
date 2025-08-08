<?php

namespace App\Http\Controllers;

use App\Models\Cabinet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CabinetController extends Controller
{
    /**
     * Menampilkan semua data cabinets
     */
    public function index()
    {
        $cabinets = Cabinet::latest()->paginate(10);
        return view('admin.cabinets.index', compact('cabinets'));
    }

    /**
     * Menampilkan form tambah cabinet
     */
    public function create()
{
    $jurusanList = [
        'teknik-mesin' => 'Teknik Mesin',
        'pendidikan-teknik-mesin' => 'Pendidikan Teknik Mesin',
        'pendidikan-tata-boga' => 'Pendidikan Tata Boga',
        'pendidikan-tata-busana' => 'Pendidikan Tata Busana',
        'pendidikan-tata-rias' => 'Pendidikan Tata Rias',
        'teknik-informatika' => 'Teknik Informatika',
        'pendidikan-teknik-informatika' => 'Pendidikan Teknik Informatika',
        'sistem-informasi' => 'Sistem Informasi',
        'teknik-elektro' => 'Teknik Elektro',
        'pendidikan-teknik-elektro' => 'Pendidikan Teknik Elektro',
        'teknik-sipil' => 'Teknik Sipil',
        'pendidikan-teknik-bangunan' => 'Pendidikan Teknik Bangunan',
        'pwk' => 'PWK',
        'bem' => 'BEM',
    ];

    $jurusanEmails = [
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

    return view('admin.cabinets.create', compact('jurusanList', 'jurusanEmails'));
}

    /**
     * Menyimpan data cabinet baru
     */
    public function store(Request $request)
    {
        $validated = $this->validateCabinet($request);

        if ($request->hasFile('logo_cabinet')) {
            $validated['logo_cabinet'] = $request->file('logo_cabinet')->store('logo_cabinet', 'public');
        }

        if ($request->hasFile('foto_fungsionaris')) {
            $validated['foto_fungsionaris'] = $request->file('foto_fungsionaris')->store('foto_fungsionaris', 'public');
        }

        Cabinet::create($validated);

        return redirect()->route('admin.cabinets.index')->with('success', 'Data cabinet berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail cabinet
     */
    public function show(Cabinet $cabinet)
    {
        return view('admin.cabinets.show', compact('cabinet'));
    }

    /**
     * Menampilkan form edit cabinet
     */
    public function edit(Cabinet $cabinet)
    {
        $jurusanList = [
            'teknik-mesin' => 'Teknik Mesin',
            'pendidikan-teknik-mesin' => 'Pendidikan Teknik Mesin',
            'pendidikan-tata-boga' => 'Pendidikan Tata Boga',
            'pendidikan-tata-busana' => 'Pendidikan Tata Busana',
            'pendidikan-tata-rias' => 'Pendidikan Tata Rias',
            'teknik-informatika' => 'Teknik Informatika',
            'pendidikan-teknik-informatika' => 'Pendidikan Teknik Informatika',
            'sistem-informasi' => 'Sistem Informasi',
            'teknik-elektro' => 'Teknik Elektro',
            'pendidikan-teknik-elektro' => 'Pendidikan Teknik Elektro',
            'teknik-sipil' => 'Teknik Sipil',
            'pendidikan-teknik-bangunan' => 'Pendidikan Teknik Bangunan',
            'pwk' => 'PWK',
            'bem' => 'BEM',
        ];

        return view('admin.cabinets.edit', compact('cabinet', 'jurusanList'));
    }

    /**
     * Update data cabinet
     */
    public function update(Request $request, Cabinet $cabinet)
    {
        $validated = $this->validateCabinet($request, $cabinet->id);

        if ($request->hasFile('logo_cabinet')) {
            if ($cabinet->logo_cabinet && Storage::disk('public')->exists($cabinet->logo_cabinet)) {
                Storage::disk('public')->delete($cabinet->logo_cabinet);
            }
            $validated['logo_cabinet'] = $request->file('logo_cabinet')->store('logo_cabinet', 'public');
        }

        if ($request->hasFile('foto_fungsionaris')) {
            if ($cabinet->foto_fungsionaris && Storage::disk('public')->exists($cabinet->foto_fungsionaris)) {
                Storage::disk('public')->delete($cabinet->foto_fungsionaris);
            }
            $validated['foto_fungsionaris'] = $request->file('foto_fungsionaris')->store('foto_fungsionaris', 'public');
        }

        $cabinet->update($validated);

        return redirect()->route('admin.cabinets.index')->with('success', 'Data cabinet berhasil diperbarui!');
    }

    /**
     * Hapus data cabinet
     */
    public function destroy(Cabinet $cabinet)
    {
        if ($cabinet->logo_cabinet) {
            Storage::disk('public')->delete($cabinet->logo_cabinet);
        }
        if ($cabinet->foto_fungsionaris) {
            Storage::disk('public')->delete($cabinet->foto_fungsionaris);
        }

        $cabinet->delete();

        return redirect()->route('admin.cabinets.index')->with('success', 'Data cabinet berhasil dihapus!');
    }

    /**
     * Validasi data Cabinet
     */
    private function validateCabinet(Request $request, $ignoreId = null)
    {
        return $request->validate([
            'slug' => 'required|unique:cabinets,slug,' . $ignoreId,
            'nama_cabinet' => 'required|string|max:255',
            'deskripsi_jurusan' => 'nullable|string',
            'logo_cabinet' => 'nullable|image|mimes:jpg,jpeg,png',
            'foto_fungsionaris' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
    }

}
