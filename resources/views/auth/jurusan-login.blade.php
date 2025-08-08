@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-cover bg-center"
     style="background-image: url('{{ asset('img/dddd.png') }}');">
    <div class="w-full max-w-md bg-white/20 backdrop-blur-xl shadow-2xl rounded-2xl p-10 relative animate-fade-in">

        {{-- Icon User --}}
        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 bg-blue-700 p-5 rounded-full shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15c2.5 0 4.795.915 6.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-center text-white mt-8 mb-6">
            Login: {{ ucwords(str_replace('-', ' ', $slug)) }}
        </h2>

        @if($errors->any())
            <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 border border-red-300 rounded">
                @foreach($errors->all() as $error)
                    <p>- {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('jurusan.login', $slug) }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.94 6.94a8 8 0 1111.314 11.314A8 8 0 012.94 6.94zM9 10h2v5H9v-5zm0-4h2v2H9V6z" />
                    </svg>
                </span>
                <input type="text"
                       value="{{ $slug }}@ft.unesa.ac.id"
                       disabled
                       class="w-full pl-10 pr-3 py-2 bg-white/30 text-white placeholder-white rounded-lg border border-white focus:ring-2 focus:ring-blue-300 focus:outline-none" />
                <input type="hidden" name="email" value="{{ $slug }}@ft.unesa.ac.id">
            </div>

            {{-- Password --}}
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.104-.896-2-2-2s-2 .896-2 2v2h4v-2z" />
                    </svg>
                </span>
                <input type="password"
                       name="password"
                       placeholder="Masukkan password"
                       class="w-full pl-10 pr-3 py-2 bg-white/30 text-white placeholder-white rounded-lg border border-white focus:ring-2 focus:ring-blue-300 focus:outline-none"
                       required />
                @error('password')
                    <div class="text-red-200 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Button --}}
            <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-lg shadow-md transition duration-200">
                LOGIN
            </button>
        </form>


    </div>
</div>

{{-- Animasi Fade-in --}}
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
</style>
@endsection
