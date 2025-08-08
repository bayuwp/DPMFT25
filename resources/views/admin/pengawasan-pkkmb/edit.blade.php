@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-purple-700">Edit Data Pengawasan PKKMB</h2>

    <form action="{{ route('admin.pengawasan-pkkmb.update', $pkkmb->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tanggal --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="w-full border px-4 py-2 rounded"
                   value="{{ old('tanggal', $pkkmb->tanggal) }}" required>
            @error('tanggal')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Berita --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Upload Berita (PDF, DOC, TXT)</label>
            <input type="file" name="berita" class="w-full border px-4 py-2 rounded" accept=".pdf,.doc,.docx,.txt">
            @error('berita')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            @if ($pkkmb->berita)
                <p class="mt-2 text-sm text-purple-700">
                    <a href="{{ asset('storage/' . $pkkmb->berita) }}" target="_blank" class="underline">
                        Lihat Berita Lama
                    </a>
                </p>
            @endif
        </div>

        {{-- Dokumentasi (URL) --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Link Dokumentasi</label>
            <input type="url" name="dokumentasi" class="w-full border px-4 py-2 rounded"
                value="{{ old('dokumentasi', $pkkmb->dokumentasi) }}">
            @error('dokumentasi')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            @if ($pkkmb->dokumentasi)
                <p class="mt-2">
                    <a href="{{ $pkkmb->dokumentasi }}" target="_blank" class="text-purple-600 underline">Lihat Dokumentasi</a>
                </p>
            @endif
        </div>


        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Perbarui</button>
        <a href="{{ route('admin.pengawasan-pkkmb.index') }}" class="ml-3 text-gray-600">Batal</a>
    </form>
</div>
@endsection
