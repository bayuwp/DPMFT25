<?php

namespace App\Http\Controllers;

use App\Models\Bph;

class PublicBphController extends Controller
{
    public function index()
    {
        $data = Bph::all();
        return view('tentang-kami.bph', compact('data'));
    }
}
