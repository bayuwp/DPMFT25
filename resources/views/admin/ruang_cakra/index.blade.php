@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h2 class="text-3xl text-purple-800 font-extrabold text-center mb-10">Daftar Jurusan Fakultas Teknik</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($jurusans as $jurusan)
            <a href="{{ route('admin.ruang_cakra.show', ['slug' => $jurusan['slug']]) }}"
               class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition duration-300 flex items-center justify-center text-lg font-semibold text-purple-700
                      focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2">
               {{ $jurusan['name'] }}
            </a>
        @endforeach
    </div>
</div>
@endsection
