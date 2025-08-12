@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8">

    <h2 class="text-3xl font-extrabold text-purple-800 mb-8 text-center sm:text-left">
        Daftar Jurusan PPL-FT
    </h2>

    <ul class="space-y-4">
        @foreach($jurusans as $j)
            <li>
                <a href="{{ route('admin.ppl-ft.show', $j['slug']) }}"
                   class="block w-full px-6 py-4 bg-purple-50 rounded-lg border border-transparent hover:border-purple-400 hover:bg-purple-100 transition
                          text-purple-800 font-semibold shadow-sm
                          focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-1">
                    {{ $j['name'] }}
                </a>
            </li>
        @endforeach
    </ul>

</div>
@endsection
