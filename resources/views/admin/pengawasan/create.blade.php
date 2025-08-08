@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Data Pengawasan HMP</h2>

    <form action="{{ route('admin.pengawasan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 shadow-md rounded-lg">
        @csrf

        {{-- Nama HMP --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama HMP</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded px-3 py-2 @error('nama') border-red-500 @enderror" required>
            @error('nama') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2 @error('deskripsi') border-red-500 @enderror" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Logo --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Logo HMP</label>
            <input type="file" name="logo" class="w-full border rounded px-3 py-2 @error('logo') border-red-500 @enderror" accept="image/*" required>
            @error('logo') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Foto Dokumentasi Proker --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Foto Dokumentasi Proker</label>
            <input type="file" name="foto_proker" class="w-full border rounded px-3 py-2 @error('foto_proker') border-red-500 @enderror" accept="image/*" required>
            @error('foto_proker') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-3">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-2 rounded">
                Simpan
            </button>
            <a href="{{ route('admin.pengawasan.index') }}" class="text-gray-700 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
