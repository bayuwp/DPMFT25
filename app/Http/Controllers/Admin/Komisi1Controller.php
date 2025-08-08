<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komisi1;
use Illuminate\Support\Facades\Storage;

class Komisi1Controller extends Controller
{
    // ✅ Menampilkan data Komisi 1
    public function index()
    {
        $data = Komisi1::latest()->get();
        return view('admin.tentang-kami.komisi-1.index', compact('data'));
    }

    // ✅ Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('komisi1', 'public') : null;

        Komisi1::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.komisi1.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // ✅ Tampilkan halaman edit
    public function edit($id)
    {
        $editData = Komisi1::findOrFail($id);
        $data = Komisi1::latest()->get();

        return view('admin.tentang-kami.komisi-1.index', compact('editData', 'data'));
    }

    // ✅ Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $komisi = Komisi1::findOrFail($id);
        $fotoPath = $komisi->foto;

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('komisi1', 'public');
        }

        $komisi->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.komisi1.index')->with('success', 'Data berhasil diperbarui!');
    }

    // ✅ Hapus data
    public function destroy($id)
    {
        $komisi = Komisi1::findOrFail($id);

        if ($komisi->foto && Storage::disk('public')->exists($komisi->foto)) {
            Storage::disk('public')->delete($komisi->foto);
        }

        $komisi->delete();

        return redirect()->route('admin.komisi1.index')->with('success', 'Data berhasil dihapus!');
    }
}
