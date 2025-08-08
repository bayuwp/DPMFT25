<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurusanLoginController extends Controller
{
    // Daftar jurusan tetap
    private $jurusans = [
        ['name' => 'Teknik Mesin', 'slug' => 'teknik-mesin'],
        ['name' => 'Pendidikan Teknik Mesin', 'slug' => 'pendidikan-teknik-mesin'],
        ['name' => 'Pendidikan Tata Boga', 'slug' => 'pendidikan-tata-boga'],
        ['name' => 'Pendidikan Tata Busana', 'slug' => 'pendidikan-tata-busana'],
        ['name' => 'Pendidikan Tata Rias', 'slug' => 'pendidikan-tata-rias'],
        ['name' => 'Teknik Informatika', 'slug' => 'teknik-informatika'],
        ['name' => 'Pendidikan Teknik Informatika', 'slug' => 'pendidikan-teknik-informatika'],
        ['name' => 'Sistem Informasi', 'slug' => 'sistem-informasi'],
        ['name' => 'Teknik Elektro', 'slug' => 'teknik-elektro'],
        ['name' => 'Pendidikan Teknik Elektro', 'slug' => 'pendidikan-teknik-elektro'],
        ['name' => 'Teknik Sipil', 'slug' => 'teknik-sipil'],
        ['name' => 'Pendidikan Teknik Bangunan', 'slug' => 'pendidikan-teknik-bangunan'],
        ['name' => 'PWK', 'slug' => 'pwk'],
        ['name' => 'BEM', 'slug' => 'bem'],
    ];

    // Tampilan login default
    public function showLoginForm()
    {
        $slug = null;
        $programs = $this->jurusans;
        return view('auth.jurusan-login', compact('slug', 'programs'));
    }

    // Tampilan login per jurusan
    public function showJurusan($slug)
    {
        $programs = $this->jurusans;

        // Validasi slug agar tidak sembarangan
        if (!collect($programs)->pluck('slug')->contains($slug)) {
            abort(404, 'Jurusan tidak ditemukan');
        }

        return view('auth.jurusan-login', compact('slug', 'programs'));
    }

    // Proses login
    public function login(Request $request, $slug)
{
    $request->validate([
        'password' => 'required',
    ]);

    // Ganti strip (-) jadi titik (.)
    $email = str_replace('-', '.', $slug) . '@ft.unesa.ac.id';
    $password = $request->input('password');

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        $request->session()->regenerate();
        return redirect()->intended('/agenda/pengawasan/' . $slug);
    }

    return back()->withErrors([
        'password' => 'Password salah.',
    ])->withInput();
}

}
