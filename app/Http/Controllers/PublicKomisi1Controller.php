<?php

namespace App\Http\Controllers;

use App\Models\Komisi1;
use Illuminate\Http\Request;

class PublicKomisi1Controller extends Controller
{
    public function index()
    {
        $data = Komisi1::all();
        return view('tentang-kami.komisi1', compact('data'));
    }
}
