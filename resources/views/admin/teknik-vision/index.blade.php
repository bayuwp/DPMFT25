@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold text-center  mb-8">Daftar Jurusan Fakultas Teknik</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($jurusans as $jurusan)
            <a href="{{ route('teknik-vision.show', $jurusan['slug']) }}"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition flex items-center justify-center text-lg font-semibold text-blue-700">
               {{ $jurusan['name'] }}
            </a>
        @endforeach
    </div>
</div>
@endsection
