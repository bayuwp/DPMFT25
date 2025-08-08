<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komisi2;
use Illuminate\Support\Facades\Storage;

class PublicKomisi2Controller extends Controller
{
    public function index()
    {
        $data = Komisi2::latest()->get();
        return view('admin.tentang-kami.komisi-2.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('komisi2', 'public') : null;

        Komisi2::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.komisi2.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $editData = Komisi2::findOrFail($id);
        $data = Komisi2::latest()->get();

        return view('admin.tentang-kami.komisi-2.index', compact('editData', 'data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $komisi = Komisi2::findOrFail($id);
        $fotoPath = $komisi->foto;

        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('komisi2', 'public');
        }

        $komisi->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.komisi2.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $komisi = Komisi2::findOrFail($id);

        if ($komisi->foto && Storage::disk('public')->exists($komisi->foto)) {
            Storage::disk('public')->delete($komisi->foto);
        }

        $komisi->delete();

        return redirect()->route('admin.komisi2.index')->with('success', 'Data berhasil dihapus!');
    }
}
