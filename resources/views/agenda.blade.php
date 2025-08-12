@extends('layouts.app')

@section('content')
<section class="py-16 bg-gradient-to-br from-blue-100 to-blue-150" data-aos="fade-up" data-aos-duration="800">
    <div class="container mx-auto px-4">
        <!-- Heading -->
        <div class="flex justify-center">
            <h2 class="relative text-3xl sm:text-4xl font-extrabold text-center bg-gradient-to-r from-blue-900 to-blue-500
                bg-clip-text text-transparent mt-10 mb-6 border-4 border-blue-500 rounded-xl px-8 py-3 shadow-lg
                transition-transform duration-500 hover:scale-105">
                Agenda DPM FT
                <span class="absolute inset-0 border-4 border-blue-300 rounded-xl blur-md -z-10"></span>
            </h2>
        </div>

        <!-- Deskripsi -->
        <p class="text-center text-gray-600 text-lg mb-12 max-w-2xl mx-auto"
           data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
            Berikut merupakan agenda dan layanan yang disediakan oleh DPM Fakultas Teknik Universitas Negeri Surabaya.
        </p>

        <!-- Grid Agenda -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
            @php
                $agendas = [
                    ['title' => 'Pengawasan', 'desc' => 'Dokumentasi dan tindak lanjut kegiatan pengawasan oleh DPM FT.', 'link' => url('/agenda/pengawasan')],
                    ['title' => 'Pengawasan PKKMB FT', 'desc' => 'Laporan dan evaluasi pelaksanaan PKKMB di lingkungan Fakultas Teknik.', 'link' => url('/agenda/pengawasan-pkkmb')],
                    ['title' => 'Aspirasi Mahasiswa FT', 'desc' => 'Salurkan aspirasi Anda demi perbaikan lingkungan akademik FT Unesa.', 'link' => 'https://bit.ly/AspirasiMahasiswaFT2025', 'target' => '_blank'],
                    ['title' => 'Pengaduan PKKMB FT', 'desc' => 'Laporkan penyimpangan atau kendala selama kegiatan PKKMB berlangsung.', 'link' => 'https://bit.ly/LaporanPengaduanPKKMBFT2025', 'target' => '_blank'],
                ];
            @endphp

            @foreach ($agendas as $index => $agenda)
                <a href="{{ $agenda['link'] }}"
                   target="{{ $agenda['target'] ?? '_self' }}"
                   class="group block p-6 bg-white border border-gray-300 rounded-lg shadow transition-all duration-300
                          hover:shadow-md hover:bg-blue-50 hover:border-blue-400"
                   data-aos="zoom-in" data-aos-delay="{{ ($index+1) * 100 }}" data-aos-duration="600">
                    <h3 class="text-lg font-bold text-blue-700 mb-2 text-center group-hover:text-blue-900">
                        {{ $agenda['title'] }}
                    </h3>
                    <p class="text-sm text-gray-600 text-center">{{ $agenda['desc'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
