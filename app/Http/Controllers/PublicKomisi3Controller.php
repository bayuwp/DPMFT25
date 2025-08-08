<?php

namespace App\Http\Controllers;

use App\Models\Komisi3;
use Illuminate\Http\Request;

class PublicKomisi3Controller extends Controller
{
    public function index()
    {
        $data = Komisi3::all();
        return view('tentang-kami.komisi3', compact('data'));
    }
}
