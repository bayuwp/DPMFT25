@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-gradient-to-br from-blue-50 via-white to-blue-100 rounded-xl shadow-inner">
    <!-- Heading -->
    <div class="flex justify-center">
        <h2 class="relative text-3xl font-bold text-center bg-gradient-to-r from-blue-900 to-blue-500
            bg-clip-text text-transparent mt-14 mb-10 px-8 py-3 border-4 border-blue-500 rounded-xl shadow-lg
            transition-transform duration-500 hover:scale-105">
            Pilih Jurusan untuk Akses Ruang Cakra
            <span class="absolute inset-0 border-4 border-blue-300 rounded-xl blur-md -z-10"></span>
        </h2>
    </div>

    <!-- Grid Jurusan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($jurusans as $index => $jurusan)
            <a href="{{ route('ruang_cakra.show', $jurusan['slug']) }}"
               id="{{ $jurusan['slug'] }}"
               class="jurusan-card group opacity-0 translate-y-4 transition-all duration-700 ease-out
                      bg-white/90 border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg hover:border-blue-400
                      p-6 flex flex-col items-center text-center backdrop-blur-sm"
               data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}" data-aos-duration="600">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4
                            transition-transform group-hover:rotate-12 overflow-hidden">
                    @php
                        // Cek jika jurusan punya logo kabinet
                        $logo = !empty($jurusan['logo_cabinet'])
                            ? asset('storage/' . $jurusan['logo_cabinet'])
                            : null;
                    @endphp

                    @if($logo)
                        <img src="{{ $logo }}" alt="{{ $jurusan['name'] }}" class="object-contain w-full h-full">
                    @else
                        <svg class="w-8 h-8 text-blue-600 group-hover:text-blue-800 transition-colors"
                             fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif
                </div>

                <h3 class="text-lg font-semibold text-gray-700 group-hover:text-blue-800">
                    {{ $jurusan['name'] }}
                </h3>
            </a>
        @endforeach
    </div>
</div>

{{-- Animasi fade-in --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll(".jurusan-card");
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.remove("opacity-0", "translate-y-4");
                        entry.target.classList.add("opacity-100", "translate-y-0");
                    }, index * 120);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        cards.forEach(card => observer.observe(card));
    });
</script>

{{-- Efek hover shake --}}
<style>
    .jurusan-card:hover {
        animation: shake 0.4s ease-in-out;
    }
    @keyframes shake {
        0%, 100% { transform: translateY(-4px); }
        25% { transform: translateY(-2px); }
        50% { transform: translateY(-6px); }
        75% { transform: translateY(-2px); }
    }
</style>
@endsection
