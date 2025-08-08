<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BphController extends Controller
{
    public function index()
    {
        $data = Bph::all();
        return view('admin.tentang-kami.bph.index', compact('data'));
    }

        public function store(Request $request)
    {
        \Log::info('Store BPH called', $request->all());

        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|max:2048',
            'deskripsi' => 'nullable',
        ]);

        $path = $request->file('foto')?->store("struktur/bph", 'public');

        $data = Bph::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        \Log::info('Data saved:', $data->toArray());

        return back()->with('success', 'Data berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $item = Bph::findOrFail($id);
        if ($item->foto) {
            Storage::disk('public')->delete($item->foto);
        }
        $item->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function edit($id)
    {
        $editData = Bph::findOrFail($id);
        $data = Bph::all();
        return view('admin.tentang-kami.bph.index', compact('data', 'editData'));
    }

    public function update(Request $request, $id)
    {
        $bph = Bph::findOrFail($id);
        $bph->nama = $request->nama;
        $bph->jabatan = $request->jabatan;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('bph', 'public');
            $bph->foto = $path;
        }

        $bph->save();

        return redirect()->route('admin.bph.index')->with('success', 'Data berhasil diupdate');
    }

}
