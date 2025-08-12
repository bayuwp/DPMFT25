@extends('layouts.admin')

@section('content')
<section class="py-16 bg-gradient-to-b from-purple-50 to-purple-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Judul Halaman -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-purple-900 mb-4">Halaman Agenda</h2>
            <p class="text-lg text-gray-700">Pilih agenda yang ingin Anda kelola</p>
        </div>

        <!-- Grid Menu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

            <!-- Card Pengawasan -->
            <a href="{{ url('/admin/pengawasan') }}"
               class="group block p-8 bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 hover:-translate-y-1">
                <div class="flex flex-col items-center text-center">
                    <div class="bg-purple-100 p-4 rounded-full mb-4 group-hover:bg-purple-200 transition">
                        <img src="{{ asset('img/LOGO_PARLEMEN_CAKRA_ADHIKARA_DPM_FT-removebg-preview.png') }}"
                             alt="Logo DPM FT" class="w-16 h-16 object-contain">
                    </div>
                    <h3 class="text-2xl font-semibold text-purple-800 mb-2">Pengawasan</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Dokumentasi dan pengawasan terhadap HMP dan lembaga kemahasiswaan di FT.
                    </p>
                </div>
            </a>

            <!-- Card Pengawasan PKKMB -->
            <a href="{{ url('/admin/pengawasan-pkkmb') }}"
               class="group block p-8 bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 hover:-translate-y-1">
                <div class="flex flex-col items-center text-center">
                    <div class="bg-purple-100 p-4 rounded-full mb-4 group-hover:bg-purple-200 transition">
                        <img src="{{ asset('img/LOGO_PARLEMEN_CAKRA_ADHIKARA_DPM_FT-removebg-preview.png') }}"
                             alt="Logo DPM FT" class="w-16 h-16 object-contain">
                    </div>
                    <h3 class="text-2xl font-semibold text-purple-800 mb-2">Pengawasan PKKMB</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Tindak lanjut hasil pengawasan kegiatan PKKMB Fakultas Teknik.
                    </p>
                </div>
            </a>

        </div>
    </div>
</section>
@endsection
