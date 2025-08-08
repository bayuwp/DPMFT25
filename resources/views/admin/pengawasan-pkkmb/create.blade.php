@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-purple-700">Tambah Data Pengawasan PKKMB</h2>

    <form action="{{ route('admin.pengawasan-pkkmb.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Tanggal --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="w-full border px-4 py-2 rounded" required>
            @error('tanggal')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Upload Berita --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Upload Berita (PDF, DOC, TXT)</label>
            <input type="file" name="berita" class="w-full border px-4 py-2 rounded" accept=".pdf,.doc,.docx,.txt">
            @error('berita')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Upload Dokumentasi --}}
        {{-- Dokumentasi (URL) --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Link Dokumentasi (Google Drive, Imgur, dll)</label>
            <input type="url" name="dokumentasi" class="w-full border px-4 py-2 rounded" placeholder="https://">
            @error('dokumentasi')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>


        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('admin.pengawasan-pkkmb.index') }}" class="ml-3 text-gray-600">Batal</a>
    </form>
</div>
@endsection
