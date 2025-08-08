<?php

namespace App\Http\Controllers;

use App\Models\Komisi4;
use Illuminate\Http\Request;

class PublicKomisi4Controller extends Controller
{
    public function index()
    {
        $data = Komisi4::all();
        return view('tentang-kami.komisi4', compact('data'));
    }
}
