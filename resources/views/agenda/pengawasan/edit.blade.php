@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h2 class="text-2xl font-bold text-blue-800 mt-14 mb-6">Edit Program Kerja</h2>

    <form action="{{ route('pengawasan.update', ['slug' => $slug, 'id' => $proker->id]) }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nama Proker --}}
        <div>
            <label for="nama_proker" class="block text-sm font-medium text-gray-700">Nama Proker</label>
            <input type="text" name="nama_proker" id="nama_proker"
                   value="{{ old('nama_proker', $proker->nama_proker ?? '') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            @error('nama_proker')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Ketupel --}}
        <div>
            <label for="ketupel" class="block text-sm font-medium text-gray-700">Ketupel</label>
            <input type="text" name="ketupel" id="ketupel"
                   value="{{ old('ketupel', $proker->ketupel ?? '') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            @error('ketupel')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Nomor WhatsApp --}}
        <div>
            <label for="nomor_wa" class="block text-sm font-medium text-gray-700">Nomor WhatsApp (Gunakan 62 untuk 0)</label>
            <input type="text" name="nomor_wa" id="nomor_wa"
                   value="{{ old('nomor_wa', $proker->nomor_wa ?? '') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            @error('nomor_wa')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal"
                   value="{{ old('tanggal', $proker->tanggal ?? '') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            @error('tanggal')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Kategori --}}
        <div>
            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
            <input type="text" name="kategori" id="kategori"
                   value="{{ old('kategori', $proker->kategori ?? '') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            @error('kategori')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Upload Berita --}}
        <div>
            <label for="berita" class="block text-sm font-medium text-gray-700">Upload Berita (PDF/JPG/PNG)</label>
            <input type="file" name="berita" id="berita"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            @if(!empty($proker->berita))
                <p class="text-sm text-gray-500 mt-1">
                    File saat ini:
                    <a href="{{ asset('storage/' . $proker->berita) }}" target="_blank" class="text-blue-600 underline">Lihat Berita</a>
                </p>
            @endif
            @error('berita')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-4">
            <a href="{{ route('pengawasan.show', $slug) }}"
               class="px-4 py-2 bg-gray-400 text-white rounded-md">Batal</a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
