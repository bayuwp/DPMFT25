<?php

namespace App\Http\Controllers;

use App\Models\Komisi2;
use Illuminate\Http\Request;

class PublicKomisi2Controller extends Controller
{
    public function index()
    {
        $data = Komisi2::all();
        return view('tentang-kami.komisi2', compact('data'));
    }
}
