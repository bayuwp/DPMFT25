@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Berita</h2>

        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div class="mb-4">
                <label for="judul" class="block text-gray-700 font-medium mb-2">Judul</label>
                <input type="text" id="judul" name="judul"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('judul') border-red-500 @enderror"
                    value="{{ old('judul', $berita->judul) }}" required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="5"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('deskripsi') border-red-500 @enderror"
                        required>{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar --}}
            <div class="mb-6">
                <label for="gambar" class="block text-gray-700 font-medium mb-2">Gambar (biarkan kosong jika tidak diubah)</label>
                <input type="file" id="gambar" name="gambar"
                    class="w-full px-3 py-2 border rounded-lg @error('gambar') border-red-500 @enderror" accept="image/*">
                @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                {{-- Preview gambar lama --}}
                <div class="mt-4">
                    <p class="text-sm text-gray-600 mb-1">Gambar Saat Ini:</p>
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-40 rounded shadow">
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg">
                    Update
                </button>
                <a href="{{ route('admin.berita.index') }}"
                class="text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
@endsection
