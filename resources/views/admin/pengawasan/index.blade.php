@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    <!-- Judul -->
    <div class="text-center mb-12">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-purple-900 mb-4">Pilih HMP</h2>
        <p class="text-gray-600 text-lg sm:text-xl max-w-2xl mx-auto">Lihat detail pengawasan setiap HMP di Fakultas Teknik</p>
    </div>

    <!-- Grid Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($programs as $program)
        <a href="{{ route('admin.pengawasan.show', $program->slug) }}"
           class="group relative overflow-hidden bg-white border border-gray-200 rounded-2xl shadow-md
                  hover:shadow-xl hover:-translate-y-1 transform transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-purple-300">

            <!-- Bagian Atas dengan Background Warna -->
            <div class="bg-gradient-to-tr from-purple-200 to-purple-100 h-32 flex items-center justify-center">
                @if($program->logo_cabinet)
                    <img src="{{ asset('storage/' . $program->logo_cabinet) }}"
                         alt="Logo {{ $program->nama_cabinet }}"
                         class="w-20 h-20 object-contain group-hover:scale-110 transition-transform duration-300">
                @else
                    <img src="{{ asset('img/default-logo.png') }}"
                         alt="Default Logo"
                         class="w-20 h-20 object-contain group-hover:scale-110 transition-transform duration-300">
                @endif
            </div>

            <!-- Bagian Konten -->
            <div class="p-6 text-center">
                <h3 class="text-xl font-semibold text-purple-800 group-hover:text-purple-900 transition-colors duration-300">
                    {{ $program->nama_cabinet }}
                </h3>
                <p class="text-sm text-gray-500 mt-2">Klik untuk melihat pengawasan</p>
            </div>

            <!-- Efek Hover Glow -->
            <div class="pointer-events-none absolute inset-0 rounded-2xl ring-0 group-hover:ring-4 group-hover:ring-purple-300 transition-all duration-300"></div>
        </a>
        @endforeach
    </div>
</div>
@endsection
