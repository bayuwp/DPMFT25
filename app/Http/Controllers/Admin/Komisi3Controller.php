<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komisi3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Komisi3Controller extends Controller
{
    public function index()
    {
        $data = Komisi3::all();
        return view('admin.tentang-kami.komisi-3.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('struktur/komisi3', 'public');
        }

        Komisi3::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.komisi3.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $editData = Komisi3::findOrFail($id);
        $data = Komisi3::all();

        return view('admin.tentang-kami.komisi-3.index', compact('data', 'editData'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $item = Komisi3::findOrFail($id);
        $path = $item->foto;

        if ($request->hasFile('foto')) {
            if ($item->foto) {
                Storage::disk('public')->delete($item->foto);
            }
            $path = $request->file('foto')->store('struktur/komisi3', 'public');
        }

        $item->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.komisi3.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Komisi3::findOrFail($id);
        if ($item->foto) {
            Storage::disk('public')->delete($item->foto);
        }
        $item->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
