@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Pilih HMP untuk Melihat Pengawasan</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($programs as $program)
        <a href="{{ route('admin.pengawasan.show', $program['slug']) }}"
            class="block p-6 border border-gray-300 rounded-lg shadow hover:bg-blue-50 transition duration-300">
            <h3 class="text-lg font-semibold text-blue-800">{{ $program['name'] }}</h3>
        </a>
        @endforeach
    </div>
</div>
@endsection
