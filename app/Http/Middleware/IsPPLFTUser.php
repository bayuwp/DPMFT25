<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IsPPLFTUser
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Validasi login
        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil slug dari URL
        $slug = Route::current()->parameter('slug');

        // Cek apakah email cocok dengan slug
        $jurusanSlugMap = [
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

        if (!isset($jurusanSlugMap[$slug]) || $jurusanSlugMap[$slug] !== $user->email) {
            abort(403, 'Akses ditolak: Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
