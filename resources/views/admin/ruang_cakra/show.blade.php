@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h2 class="text-3xl text-purple-800 font-bold text-center mb-8">
        Daftar Proker - {{ ucwords(str_replace('-', ' ', $slug)) }}
    </h2>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-purple-700 text-white">
                <tr>
                    <th class="p-3 border border-purple-600 text-left">Nama Proker</th>
                    <th class="p-3 border border-purple-600 text-left">Ketupel</th>
                    <th class="p-3 border border-purple-600 text-center">Instrumen Materi</th>
                    <th class="p-3 border border-purple-600 text-left max-w-xs">Deskripsi</th>
                    <th class="p-3 border border-purple-600 text-center">Tanggal Pelaksanaan</th>
                    <th class="p-3 border border-purple-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prokers as $proker)
                <tr class="hover:bg-purple-50 transition-colors">
                    <td class="p-3 border border-gray-200 font-semibold whitespace-normal">{{ $proker->nama_proker }}</td>
                    <td class="p-3 border border-gray-200 whitespace-normal">{{ $proker->ketupel }}</td>
                    <td class="p-3 border border-gray-200 text-center">
                        @if($proker->instrumen_materi)
                            <a href="{{ asset('storage/' . $proker->instrumen_materi) }}"
                               target="_blank"
                               class="text-blue-600 hover:underline">
                               Lihat
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="p-3 border border-gray-200 max-w-xs truncate whitespace-normal" title="{{ strip_tags($proker->deskripsi_proker) }}">
                        {!! \Illuminate\Support\Str::limit(strip_tags($proker->deskripsi_proker), 100, '...') ?: '-' !!}
                    </td>
                    <td class="p-3 border border-gray-200 text-center whitespace-nowrap">
                        {{ $proker->tanggal ? \Carbon\Carbon::parse($proker->tanggal)->format('d M Y') : '-' }}
                    </td>
                    <td class="p-3 border border-gray-200 text-center space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.ruang_cakra.detail', [$slug, $proker->id]) }}"
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded transition">
                           Detail
                        </a>
                        <a href="{{ route('admin.ruang_cakra.edit-deskripsi', [$slug, $proker->id]) }}"
                           class="inline-block bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-1 rounded transition">
                           Edit Deskripsi
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-6">Tidak ada proker tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
