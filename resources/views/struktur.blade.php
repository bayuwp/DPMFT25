@extends('layouts.app')

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="w-full px-4 text-center">
            <div class="flex justify-center">
            <h2 class="relative text-3xl font-bold text-center bg-gradient-to-r from-blue-900 to-blue-500
                bg-clip-text text-transparent mt-10 mb-8 px-6 py-2 border-4 border-blue-500 rounded-xl shadow-lg
                transition-transform duration-500 hover:scale-105">
                Struktur Organisasi DPM FT 2025
                <span class="absolute inset-0 border-4 border-blue-300 rounded-xl blur-md -z-10"></span>
            </h2>
        </div>
            <div class="overflow-x-auto">
                <img src="{{ asset('img/struktur_dpm.png') }}"
                    alt="Struktur DPM FT 2025"
                    class="mx-auto w-full max-w-6xl shadow-lg rounded-lg">
            </div>
        </div>
    </section>
@endsection
