@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Proker untuk {{ $pengawasan->nama }}</h2>

    {{-- Perbaikan penting: tambahkan enctype --}}
    <form action="{{ route('admin.proker.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pengawasan_id" value="{{ $pengawasan->id }}">

        {{-- Input Nama Proker --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nama Proker</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border px-4 py-2 rounded @error('nama') border-red-500 @enderror" required>
            @error('nama')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Upload Berita --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Upload Berita</label>
            <input type="file" name="berita" class="w-full border rounded px-3 py-2 @error('berita') border-red-500 @enderror" accept=".pdf,.doc,.docx,.txt">
            @error('berita')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            {{-- Jika berita lama ada, tampilkan link --}}
            @if (isset($proker) && $proker->berita)
                <p class="mt-2 text-sm text-blue-700">
                    <a href="{{ asset('storage/' . $proker->berita) }}" target="_blank" class="underline">Lihat Berita Lama</a>
                </p>
            @endif
        </div>

        {{-- Select Terlaksana --}}
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Terlaksana</label>
            <select name="terlaksana" class="w-full border px-4 py-2 rounded @error('terlaksana') border-red-500 @enderror">
                <option value="1" {{ old('terlaksana') == '1' ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ old('terlaksana') == '0' ? 'selected' : '' }}>Tidak</option>
            </select>
            @error('terlaksana')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
