<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTeknikVisionController extends Controller
{
    protected $modelMap = [
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

    /**
     * Menampilkan daftar jurusan
     */
    public function index()
    {
        $jurusans = collect($this->modelMap)->keys()->map(function ($slug) {
            return [
                'name' => ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug
            ];
        });

        return view('admin.teknik-vision.index', compact('jurusans'));
    }

    /**
     * Menampilkan semua proker berdasarkan jurusan
     */
    public function show($slug)
    {
        $model = $this->getModel($slug);
        $prokers = $model::all();

        return view('admin.teknik-vision.show', compact('slug', 'prokers'));
    }

    public function editDeskripsi($slug, $id)
{
    $model = $this->getModel($slug);         // ambil model sesuai slug
    $proker = $model::findOrFail($id);       // cari data proker

    return view('admin.teknik-vision.edit-deskripsi', compact('proker', 'slug'));
}

public function updateDeskripsi(Request $request, $slug, $id)
{
    $request->validate([
        'deskripsi_proker' => 'nullable|string',
    ]);

    $model = $this->getModel($slug);          // ambil model sesuai slug
    $proker = $model::findOrFail($id);

    $proker->deskripsi_proker = $request->input('deskripsi_proker');
    $proker->save();

    return redirect()->route('teknik-vision.edit-deskripsi', [$slug, $id])
                     ->with('success', 'Deskripsi berhasil diperbarui.');
}


    /**
     * Helper untuk mendapatkan model berdasarkan slug
     */
    private function getModel($slug)
    {
        if (!isset($this->modelMap[$slug])) {
            abort(404, 'Jurusan tidak ditemukan.');
        }

        return $this->modelMap[$slug];
    }

    public function showDetail($slug, $id)
    {
        $model = $this->getModel($slug);
        $proker = $model::findOrFail($id);

        return view('admin.teknik-vision.proker-detail', compact('slug', 'proker'));
    }

    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            ]);

            // Simpan file
            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('uploads', $filename, 'public');

            return response()->json([
                'success' => true,
                'url' => asset('storage/' . $path)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Upload gagal: ' . $e->getMessage()
            ], 500);
        }
    }



}
