<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komisi4;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Komisi4Controller extends Controller
{
    public function index()
    {
        $data = Komisi4::all();
        return view('admin.tentang-kami.komisi-4.index', compact('data'));
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
            $path = $request->file('foto')->store('struktur/komisi4', 'public');
        }

        Komisi4::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.komisi4.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $editData = Komisi4::findOrFail($id);
        $data = Komisi4::all();

        return view('admin.tentang-kami.komisi-4.index', compact('data', 'editData'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $item = Komisi4::findOrFail($id);
        $path = $item->foto;

        if ($request->hasFile('foto')) {
            if ($item->foto) {
                Storage::disk('public')->delete($item->foto);
            }
            $path = $request->file('foto')->store('struktur/komisi4', 'public');
        }

        $item->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.komisi4.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Komisi4::findOrFail($id);
        if ($item->foto) {
            Storage::disk('public')->delete($item->foto);
        }
        $item->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
