@extends('layouts.app')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <!-- Judul -->
        <div class="flex justify-center">
            <h2 class="relative text-3xl sm:text-4xl font-extrabold text-center
                bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent
                mt-10 mb-6 px-8 py-3 border-4 border-blue-400 rounded-xl shadow-lg
                animate-title">
                Parlemen Cakra Adhikara - Komisi 4
                <span class="absolute inset-0 border-4 border-blue-300 rounded-xl blur-md -z-10"></span>
            </h2>
        </div>

        <!-- Subtitle -->
        <p class="text-gray-600 max-w-2xl mx-auto mb-14 animate-subtitle">
            Komisi 4 bertanggung jawab dalam bidang hubungan masyarakat, komunikasi publik, dan pengembangan jaringan eksternal organisasi.
        </p>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">
            @foreach($data as $index => $item)
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden flex flex-col
                            transform transition duration-500 ease-in-out hover:scale-105
                            animate-card" style="animation-delay: {{ $index * 0.2 }}s;">

                    <!-- Foto -->
                    <div class="relative group bg-gray-100 aspect-[4/5] overflow-hidden">
                        <img src="{{ asset('storage/'.$item->foto) }}"
                             alt="{{ $item->nama }}"
                             class="w-full h-full object-cover rounded-t-3xl swing-animation transition-transform duration-500 group-hover:scale-110">

                        <!-- Overlay Hover -->
                        <div class="absolute inset-0 bg-black bg-opacity-60 opacity-0
                                    group-hover:opacity-100 flex flex-col items-center
                                    justify-center text-white px-3 text-center transition-opacity duration-500">
                            <h3 class="text-lg font-bold">{{ $item->nama }}</h3>
                            <p class="text-sm mt-1">{{ $item->jabatan }}</p>
                        </div>
                    </div>

                    <!-- Nama & Jabatan -->
                    <div class="bg-white py-5 rounded-b-3xl">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $item->nama }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $item->jabatan }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ✅ Section Hubungi Kami -->
<section class="py-6 bg-gradient-to-r from-blue-500 to-blue-600 mt-16">
    <div class="max-w-5xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between text-white">
        <h2 class="text-2xl md:text-2xl font-bold text-center md:text-left mb-6 md:mb-0">
            Butuh informasi Humas dan Medinfo? Hubungi Kami
        </h2>
        <a href="https://wa.me/6282139537331" target="_blank"
           class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full shadow-lg text-lg transition transform hover:scale-105">
            Narahubung
        </a>
    </div>
</section>

<style>
    @keyframes slideFadeUp {
        0% { opacity: 0; transform: translateY(30px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes fadeInZoom {
        0% { opacity: 0; transform: scale(0.8); }
        100% { opacity: 1; transform: scale(1); }
    }
    @keyframes swing {
        20% { transform: rotate3d(0, 0, 1, 15deg); }
        40% { transform: rotate3d(0, 0, 1, -10deg); }
        60% { transform: rotate3d(0, 0, 1, 5deg); }
        80% { transform: rotate3d(0, 0, 1, -5deg); }
        100% { transform: rotate3d(0, 0, 1, 0deg); }
    }

    .animate-title {
        opacity: 0;
        animation: fadeInZoom 0.9s ease forwards;
    }
    .animate-subtitle {
        opacity: 0;
        animation: slideFadeUp 0.9s ease forwards;
        animation-delay: 0.3s;
    }
    .animate-card {
        opacity: 0;
        animation: slideFadeUp 0.8s ease forwards;
    }
    .swing-animation {
        animation: swing 1s ease;
        transform-origin: top center;
    }
    .group:hover .swing-animation {
        animation: swing 1s ease;
    }
</style>
@endsection
