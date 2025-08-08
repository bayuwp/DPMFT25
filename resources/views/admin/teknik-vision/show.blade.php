@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold text-center mb-8">
        Daftar Proker - {{ ucwords(str_replace('-', ' ', $slug)) }}
    </h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-3 border">Nama Proker</th>
                    <th class="p-3 border">Ketupel</th>
                    <th class="p-3 border">Instrumen Materi</th>
                    <th class="p-3 border">Deskripsi</th>
                    <th class="p-3 border">Tanggal Pelaksanaan</th>
                    <th class="p-3 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prokers as $proker)
                <tr class="hover:bg-gray-100 transition">
                    <td class="p-3 border font-semibold">{{ $proker->nama_proker }}</td>
                    <td class="p-3 border">{{ $proker->ketupel }}</td>
                    <td class="p-3 border text-center">
                        @if($proker->instrumen_materi)
                            <a href="{{ asset('storage/' . $proker->instrumen_materi) }}"
                               target="_blank"
                               class="text-blue-600 hover:underline">
                               📂 Lihat
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="p-3 border max-w-xl truncate" title="{{ strip_tags($proker->deskripsi_proker) }}">
                        {!! \Illuminate\Support\Str::limit($proker->deskripsi_proker, 100, '...') ?: '-' !!}
                    </td>
                    <td class="p-3 border text-center">
                        {{ $proker->tanggal ? \Carbon\Carbon::parse($proker->tanggal)->format('d M Y') : '-' }}
                    </td>
                    <td class="p-3 border text-center space-x-2">
                        <a href="{{ route('teknik-vision.detail', [$slug, $proker->id]) }}"
                           class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">
                           🔍 Detail
                        </a>
                        <a href="{{ route('teknik-vision.edit-deskripsi', [$slug, $proker->id]) }}"
                           class="bg-yellow-400 text-black px-4 py-1 rounded hover:bg-yellow-500">
                           ✏️ Edit Deskripsi
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada proker tersedia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
