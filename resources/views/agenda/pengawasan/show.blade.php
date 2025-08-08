@extends('layouts.app')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <img src="{{ $data['logo'] }}" alt="Logo HMP" class="mx-auto w-32 mb-4">
            <h2 class="text-3xl font-bold text-blue-800">{{ $data['nama'] }}</h2>
            <p class="text-gray-700 mt-4">{{ $data['deskripsi'] }}</p>
        </div>

        <div class="mb-12">
            <img src="{{ $data['foto_proker'] }}" alt="Foto Proker" class="rounded-lg mx-auto shadow-lg w-full max-w-2xl">
            <p class="mt-6 text-center text-gray-600">Dokumentasi kegiatan program kerja HMP.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">No</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Nama Proker</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Berita</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Terlaksana</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data['prokers'] as $index => $proker)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $proker['nama'] }}</td>
                        <td class="px-4 py-2">
                            @if ($proker['berita'])
                                <a href="{{ asset('storage/' . $proker['berita']) }}" target="_blank" class="text-blue-600 underline">
                                    Lihat Berita
                                </a>
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $proker['terlaksana'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
