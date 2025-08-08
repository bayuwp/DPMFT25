@extends('layouts.app')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <!-- Judul -->
        <div class="flex justify-center">
            <h2 class="relative text-3xl sm:text-4xl font-extrabold text-center
                bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent
                mt-10 mb-6 px-8 py-3 border-4 border-blue-400 rounded-xl shadow-lg
                transition-transform duration-500 hover:scale-105 opacity-0 animate-fadeIn">
                Parlemen Cakra Adhikara - Komisi 2
                <span class="absolute inset-0 border-4 border-blue-300 rounded-xl blur-md -z-10"></span>
            </h2>
        </div>
        <p class="text-gray-600 max-w-2xl mx-auto mb-14 opacity-0 animate-subtitle">
            Komisi 2 bertanggung jawab dalam bidang pengawasan dan hubungan eksternal organisasi.
        </p>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">
            @foreach($data as $index => $item)
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden flex flex-col
                            transform transition duration-500 ease-in-out hover:scale-105
                            opacity-0 animate-card" style="animation-delay: {{ $index * 0.2 }}s;">

                    <!-- Foto -->
                    <div class="relative group bg-gray-100 aspect-[4/5] overflow-hidden">
                        <img src="{{ asset('storage/'.$item->foto) }}"
                             alt="{{ $item->nama }}"
                             class="w-full h-full object-cover rounded-t-3xl transition-transform duration-500 group-hover:scale-110">

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

<style>
    @keyframes slideFadeUp {
        0% { opacity: 0; transform: translateY(30px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    .animate-title {
        animation: slideFadeUp 0.9s ease forwards;
    }

    .animate-subtitle {
        animation: slideFadeUp 1s ease forwards;
        animation-delay: 0.3s;
    }

    .animate-card {
        animation: slideFadeUp 0.8s ease forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 1s ease-out forwards;
    }
</style>
@endsection
