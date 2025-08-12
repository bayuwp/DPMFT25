<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get() ?? collect();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar'    => 'required',
            'gambar.*'  => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarFiles = is_array($request->file('gambar'))
            ? $request->file('gambar')
            : [$request->file('gambar')];

        $gambarPaths = [];
        foreach ($gambarFiles as $file) {
            $gambarPaths[] = $file->store('berita', 'public');
        }

        Berita::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar'    => json_encode($gambarPaths),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar.*'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPaths = json_decode($berita->gambar, true) ?? [];

        if ($request->hasFile('gambar')) {
            // Hapus semua gambar lama
            foreach ($gambarPaths as $old) {
                if (Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
            }

            $gambarFiles = is_array($request->file('gambar'))
                ? $request->file('gambar')
                : [$request->file('gambar')];

            $gambarPaths = [];
            foreach ($gambarFiles as $file) {
                $gambarPaths[] = $file->store('berita', 'public');
            }
        }

        $berita->update([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar'    => json_encode($gambarPaths),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            $gambarList = json_decode($berita->gambar, true) ?? [];
            foreach ($gambarList as $gambar) {
                if (Storage::disk('public')->exists($gambar)) {
                    Storage::disk('public')->delete($gambar);
                }
            }
        }

        $berita->delete();
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
