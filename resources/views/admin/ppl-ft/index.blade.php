@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-6">
    <h2 class="text-2xl font-bold text-blue-800 mb-6"> Daftar Jurusan PPL-FT</h2>

    <ul class="space-y-3">
        @foreach($jurusans as $j)
            <li>
                <a href="{{ route('admin.ppl-ft.show', $j['slug']) }}"
                    class="block px-4 py-3 bg-gray-100 rounded-md hover:bg-blue-100 transition-all text-blue-700 font-medium shadow-sm">
                    {{ $j['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
