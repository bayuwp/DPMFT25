@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold mb-8 text-purple-700 text-center sm:text-left">Tambah Data Pengawasan PKKMB</h2>

    <form action="{{ route('admin.pengawasan-pkkmb.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Tanggal --}}
        <div>
            <label for="tanggal" class="block font-semibold text-gray-700 mb-2">Tanggal <span class="text-red-500">*</span></label>
            <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal') }}"
                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                   required>
            @error('tanggal')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Upload Berita --}}
        <div>
            <label for="berita" class="block font-semibold text-gray-700 mb-2">Upload Berita (PDF, DOC, TXT)</label>
            <input id="berita" type="file" name="berita" accept=".pdf,.doc,.docx,.txt"
                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('berita')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-gray-500 text-sm mt-1">Format file yang diterima: PDF, DOC, DOCX, TXT.</p>
        </div>

        {{-- Upload Dokumentasi --}}
        <div>
            <label for="dokumentasi" class="block font-semibold text-gray-700 mb-2">Link Dokumentasi (Google Drive, Imgur, dll)</label>
            <input id="dokumentasi" type="url" name="dokumentasi" placeholder="https://example.com"
                   value="{{ old('dokumentasi') }}"
                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('dokumentasi')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded-md transition">
                Simpan
            </button>
            <a href="{{ route('admin.pengawasan-pkkmb.index') }}"
               class="text-gray-600 hover:text-gray-800 font-medium transition">
               Batal
            </a>
        </div>
    </form>
</div>
@endsection
