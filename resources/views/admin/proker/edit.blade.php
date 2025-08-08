@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Program Kerja</h2>

    @if(isset($proker))
    <form action="{{ route('admin.proker.update', $proker->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama Proker --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Nama Proker</label>
            <input type="text" name="nama" value="{{ old('nama', $proker->nama) }}"
                class="w-full border rounded px-3 py-2 @error('nama') border-red-500 @enderror" required>
            @error('nama')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Berita --}}
        {{-- Berita (File Upload) --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Upload Berita</label>
            <input type="file" name="berita" class="w-full border rounded px-3 py-2 @error('berita') border-red-500 @enderror" accept=".pdf,.doc,.docx,.txt">
            @error('berita')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            @if (isset($proker) && $proker->berita)
                <p class="mt-2 text-sm text-blue-700">
                    <a href="{{ asset('storage/' . $proker->berita) }}" target="_blank" class="underline">Lihat Berita Lama</a>
                </p>
            @endif
        </div>


        {{-- Terlaksana --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Terlaksana</label>
            <select name="terlaksana" class="w-full border rounded px-3 py-2 @error('terlaksana') border-red-500 @enderror">
                <option value="1" {{ old('terlaksana', $proker->terlaksana) == 1 ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ old('terlaksana', $proker->terlaksana) == 0 ? 'selected' : '' }}>Tidak</option>
            </select>
            @error('terlaksana')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-3">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Simpan Perubahan
            </button>
            <a href="{{ url()->previous() }}" class="text-gray-700 hover:underline">Batal</a>
        </div>
    </form>
    @else
        <p class="text-red-600">Data Proker tidak ditemukan.</p>
    @endif
</div>
@endsection
