<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengawasanPKKMB;
use Illuminate\Support\Facades\Storage;

class PengawasanPKKMBController extends Controller
{
    public function index()
    {
        $items = PengawasanPKKMB::latest()->get();
        return view('admin.pengawasan-pkkmb.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pengawasan-pkkmb.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'berita' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048',
            'dokumentasi' => 'nullable|url',
        ]);

        $data = $request->only('tanggal', 'dokumentasi');

        if ($request->hasFile('berita')) {
            $data['berita'] = $request->file('berita')->store('berita_pkkmb', 'public');
        }

        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi_pkkmb', 'public');
        }

        PengawasanPKKMB::create($data);

        return redirect()->route('admin.pengawasan-pkkmb.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(PengawasanPKKMB $pengawasan_pkkmb)
    {
        return view('admin.pengawasan-pkkmb.edit', [
            'pkkmb' => $pengawasan_pkkmb
        ]);
    }


    public function update(Request $request, PengawasanPKKMB $pengawasan_pkkmb)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'berita' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048',
            'dokumentasi' => 'nullable|url',
        ]);

        $data = $request->only('tanggal', 'dokumentasi');

        // Handle upload file berita
        if ($request->hasFile('berita')) {
            if ($pengawasan_pkkmb->berita) {
                Storage::delete('public/' . $pengawasan_pkkmb->berita);
            }
            $data['berita'] = $request->file('berita')->store('berita_pkkmb', 'public');
        }

        // Dokumentasi adalah URL, jadi tidak perlu diproses sebagai file

        $pengawasan_pkkmb->update($data);

        return redirect()->route('admin.pengawasan-pkkmb.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(PengawasanPKKMB $pkkmb)
    {
        if ($pkkmb->berita) Storage::delete('public/' . $pkkmb->berita);
        if ($pkkmb->dokumentasi) Storage::delete('public/' . $pkkmb->dokumentasi);
        $pkkmb->delete();

        return redirect()->route('admin.pengawasan-pkkmb.index')->with('success', 'Data berhasil dihapus.');
    }
}
