<?php

namespace App\Http\Controllers;

use App\Models\PengawasanPKKMB;
use Illuminate\Http\Request;

class PengawasanPKKMBPublicController extends Controller
{
    public function index()
    {
        $data = \App\Models\PengawasanPKKMB::latest()->get();
        return view('agenda.pengawasan-pkkmb.index', compact('data'));
    }
}
