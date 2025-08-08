<?php

// app/Http/Controllers/BeritaPublikController.php
namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaPublikController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('home', compact('beritas'));
    }
}
