@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-gradient-to-br from-blue-200 via-white to-blue-200 rounded-xl shadow-inner">
    <!-- Heading -->
    <div class="flex justify-center">
        <h2 class="relative text-3xl font-bold text-center bg-gradient-to-r from-blue-900 to-blue-500
            bg-clip-text text-transparent mt-14 mb-10 px-8 py-3 border-4 border-blue-500 rounded-xl shadow-lg
            transition-transform duration-500 hover:scale-105"
            data-aos="fade-down" data-aos-duration="800">
            Pilih Jurusan untuk Akses Agenda Pengawasan
            <span class="absolute inset-0 border-4 border-blue-300 rounded-xl blur-md -z-10"></span>
        </h2>
    </div>

    <!-- Grid Jurusan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($programs as $index => $jurusan)
            <a href="{{ route('jurusan.login', ['slug' => $jurusan['slug']]) }}"
               class="group bg-white/80 border border-gray-200 rounded-2xl shadow
                      hover:shadow-lg hover:border-blue-400 transition-transform duration-300
                      p-6 flex flex-col items-center text-center hover:-translate-y-1 backdrop-blur-sm"
               data-aos="zoom-in"
               data-aos-delay="{{ $index * 100 }}"
               data-aos-duration="600">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600 group-hover:text-blue-800 transition-colors"
                         fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 group-hover:text-blue-800">
                    {{ $jurusan['name'] }}
                </h3>
            </a>
        @endforeach
    </div>
</div>
@endsection
