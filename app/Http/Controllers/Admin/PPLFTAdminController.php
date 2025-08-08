<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;

class PPLFTAdminController extends Controller
{
    protected $map = [
        'teknik-mesin' => 'teknik_mesin',
        'pendidikan-teknik-mesin' => 'pendidikan_teknik_mesin',
        'pendidikan-tata-boga' => 'pendidikan_tata_boga',
        'pendidikan-tata-busana' => 'pendidikan_tata_busana',
        'pendidikan-tata-rias' => 'pendidikan_tata_rias',
        'teknik-informatika' => 'teknik_informatika',
        'pendidikan-teknik-informatika' => 'pendidikan_teknik_informatika',
        'sistem-informasi' => 'sistem_informasi',
        'teknik-elektro' => 'teknik_elektro',
        'pendidikan-teknik-elektro' => 'pendidikan_teknik_elektro',
        'teknik-sipil' => 'teknik_sipil',
        'pendidikan-teknik-bangunan' => 'pendidikan_teknik_bangunan',
        'pwk' => 'PWK',
        'bem' => 'BEM',
    ];

    public function index()
    {
        $jurusans = collect($this->map)->map(function ($conn, $slug) {
            return [
                'slug' => $slug,
                'name' => ucwords(str_replace('-', ' ', $slug)),
            ];
        });

        return view('admin.ppl-ft.index', compact('jurusans'));
    }

    public function show($slug)
    {
        $modelMap = [
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

        if (!array_key_exists($slug, $modelMap)) {
            abort(404, 'Jurusan tidak ditemukan.');
        }

        $model = $modelMap[$slug];
        $prokers = $model::orderBy('tanggal', 'desc')->get();
        $chats = Chat::where('jurusan_slug', $slug)->orderBy('created_at', 'asc')->get();

        return view('admin.ppl-ft.show', compact('prokers', 'chats', 'slug'));
    }

    public function sendChat(Request $request, $slug)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        // Cek berdasarkan email, bukan role
        $sender = auth()->user()->email === 'admin@example.com' ? 'Admin' : auth()->user()->name;

        Chat::create([
            'jurusan_slug' => $slug,
            'sender' => $sender,
            'message' => $request->message,
        ]);

        return redirect()->route('admin.ppl-ft.show', $slug);
    }


    public function updateStatus(Request $request, $slug, $id,)
    {
        $request->validate([
            'value' => 'required|string|max:255',
        ]);

        $modelMap = [
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

        if (!isset($modelMap[$slug])) {
            return back()->with('error', 'Model tidak ditemukan.');
        }

        $model = $modelMap[$slug];
        $proker = $model::findOrFail($id);
        $field = $request->field;
        // Hanya izinkan field tertentu
        if (!in_array($field, ['status_proposal', 'status_lpj'])) {
            return back()->with('error', 'Field status tidak dikenali.');
        }

        $proker->$field = $request->value;
        $proker->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function updateLink(Request $request, $slug, $id)
    {
        $request->validate([
            'field' => 'required|string',
            'link'  => 'required|url|max:255',
        ]);

        $modelMap = [
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

        if (!isset($modelMap[$slug])) {
            return back()->with('error', 'Model tidak ditemukan.');
        }

        $model = $modelMap[$slug];
        $proker = $model::findOrFail($id);

        // Hanya izinkan field tertentu
        if (!in_array($request->field, ['link_gform_panitia', 'link_gform_peserta'])) {
            return back()->with('error', 'Field link tidak dikenali.');
        }

        $proker->{$request->field} = $request->link;
        $proker->save();

        return back()->with('success', 'Link berhasil diperbarui.');
    }



}
