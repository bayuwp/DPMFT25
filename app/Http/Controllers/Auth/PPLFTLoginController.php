<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PPLFTLoginController extends Controller
{
    // Menampilkan form login berdasarkan slug jurusan
    public function showLoginForm($slug)
    {
        return view('auth.pplft-login', compact('slug'));
    }

    // Proses login
    public function login(Request $request, $slug)
    {
        $request->validate([
            'password' => 'required',
        ]);

        // Email berdasarkan slug jurusan
        $emailMap = [
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

        $email = $emailMap[$slug] ?? null;

        if (!$email) {
            abort(403, 'Jurusan tidak valid.');
        }

        if (Auth::attempt(['email' => $email, 'password' => $request->password])) {
            return redirect()->route('ppl-ft.show', $slug);
        }

        throw ValidationException::withMessages([
            'password' => ['Password salah.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('ppl-ft.index');
    }
}
