@extends('layouts.app')

@section('content')
<section class="py-16 bg-gradient-to-br from-blue-100 to-blue-150">
    <div class="container mx-auto px-4">
        <!-- Heading -->
        <div class="flex justify-center">
            <h2 class="relative text-3xl sm:text-4xl font-extrabold text-center bg-gradient-to-r from-blue-900 to-blue-500
                bg-clip-text text-transparent mt-10 mb-6 border-4 border-blue-500 rounded-xl px-8 py-3 shadow-lg
                transition-transform duration-500 hover:scale-105">
                Dokumen Arsip DPM FT
                <span class="absolute inset-0 border-4 border-blue-300 rounded-xl blur-md -z-10"></span>
            </h2>
        </div>

        <p class="text-center text-gray-600 text-lg mb-12 max-w-3xl mx-auto">
            Berikut adalah Permawa dan Perda DPM Fakultas Teknik Universitas Negeri Surabaya.
        </p>

        <!-- Grid Arsip Responsif -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @php
                $arsips = [
                    ['title' => 'UU REMA 2015 AMANDEMEN I', 'link' => 'https://drive.google.com/file/d/1RHlE8GmeORg4kfjePdMiBaUksjV3HL0N/view?usp=drivesdk'],
                    ['title' => 'Tata Tertib DPM FT', 'link' => 'https://drive.google.com/drive/folders/1Qw4QX_F0RX5geSWaeC9DulVxtTOcgtfc'],
                    ['title' => 'Kode Etik DPM FT', 'link' => 'https://drive.google.com/file/d/1REAygDCCTH9eLIgHhagqORv8mx_rJvJi/view?usp=drivesdk'],
                    ['title' => 'UU PKKMB FT', 'link' => 'https://drive.google.com/file/d/1Q4xzZWyneEWDuyEjKn3RgmiYzmFDLNcq/view?usp=drivesdk'],
                    ['title' => 'SOP Pengawasan PKKMB FT', 'link' => 'https://drive.google.com/file/d/1RW8X1yxzIqBtCZDLLBxhD7iLPjdCa-6H/view?usp=drivesdk'],
                    ['title' => 'Peraturan Pemira Fakultas Teknik', 'link' => '#'],
                ];
            @endphp

            @foreach ($arsips as $arsip)
                <a href="{{ $arsip['link'] }}" target="_blank"
                   data-aos="fade-up"
                   data-aos-delay="{{ $loop->index * 100 }}"
                   class="group block p-6 border border-gray-200 rounded-2xl shadow-md bg-white
                          transition-all duration-300 hover:shadow-lg hover:scale-105 hover:bg-blue-50
                          {{ $arsip['link'] === '#' ? 'pointer-events-none opacity-50' : 'hover:border-blue-400' }}">
                    <h3 class="text-lg font-bold text-blue-700 mb-2 text-center group-hover:text-blue-900">
                        {{ $arsip['title'] }}
                    </h3>
                    <p class="text-sm text-gray-600 text-center">
                        {{ $arsip['link'] === '#' ? 'Dokumen belum tersedia' : 'Klik untuk membuka dokumen' }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
