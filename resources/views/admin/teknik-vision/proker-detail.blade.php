@extends('layouts.admin')

@section('content')
@php
    if (!function_exists('renderEmbed')) {
        function renderEmbed($content) {
            // Embed YouTube short link
            $content = preg_replace(
                '/<oembed url="https:\/\/youtu\.be\/([^"]+)"><\/oembed>/',
                '<iframe width="560" height="315" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
                $content
            );

            // Embed YouTube full link
            $content = preg_replace(
                '/<oembed url="https:\/\/www\.youtube\.com\/watch\?v=([^"]+)"><\/oembed>/',
                '<iframe width="560" height="315" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
                $content
            );

            return $content;
        }
    }
@endphp

<div class="container mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold text-center mb-8">
        Detail Proker - {{ ucwords($proker->nama_proker) }}
    </h2>

    <div class="bg-white shadow-md rounded-lg p-6 space-y-4">
        <p><strong>Ketupel:</strong> {{ $proker->ketupel }}</p>
        <p><strong>Instrumen Materi:</strong>
            @if($proker->instrumen_materi)
                <a href="{{ asset('storage/'.$proker->instrumen_materi) }}" target="_blank" class="text-blue-600 underline">📂 Lihat</a>
            @else
                <span class="text-gray-500">-</span>
            @endif
        </p>
        <p><strong>Deskripsi:</strong></p>
        <div class="border p-3 rounded bg-gray-50 space-y-4">
            {!! renderEmbed($proker->deskripsi_proker) !!}
        </div>
        <p><strong>Tanggal Pelaksanaan:</strong>
            {{ $proker->tanggal ? \Carbon\Carbon::parse($proker->tanggal)->format('d M Y') : '-' }}
        </p>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('teknik-vision.show', $slug) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            ⬅️ Kembali
        </a>
    </div>
</div>
@endsection
