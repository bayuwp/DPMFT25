@extends('layouts.admin')

@section('content')
<section class="relative h-screen bg-cover bg-center"
         style="background-image: url('{{ asset('img/Gedung_FT.jpg') }}');">
    <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <div class="text-center text-white px-4" data-aos="zoom-in">
            <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">
                Selamat Datang di Halaman Admin<br>
                Dewan Perwakilan Mahasiswa Fakultas Teknik<br>
                Universitas Negeri Surabaya
            </h1>
            <p class="mt-4 text-lg md:text-xl font-semibold text-yellow-400">
                DPM FT! Viva Legislatif!
            </p>
        </div>
    </div>
</section>
@endsection
