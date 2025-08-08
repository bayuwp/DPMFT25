<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('layouts.admin'); // asumsi admin.dashboard extend ke layouts.admin
    }


    public function showLoginForm()
    {
        return view('admin.auth.login'); // nanti kita buat view ini
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->email === 'admin@example.com') {
                return redirect()->route('admin.index'); // redirect ke halaman admin
            }

            Auth::logout(); // jika bukan admin
            return redirect()->route('admin.login')->withErrors(['email' => 'Anda bukan admin.']);
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
