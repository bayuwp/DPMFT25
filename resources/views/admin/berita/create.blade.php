@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Berita</h2>

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white shadow-md rounded-lg p-6">
        @csrf

        {{-- Judul --}}
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-medium mb-2">Judul</label>
            <input type="text" id="judul" name="judul"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('judul') border-red-500 @enderror"
                   value="{{ old('judul') }}" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="5"
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('deskripsi') border-red-500 @enderror"
                      required>{{ old('deskripsi') }}</textarea>
        </div>

        {{-- Upload gambar --}}
        <div class="mb-6">
            <label for="gambar" class="block text-gray-700 font-medium mb-2">Gambar</label>
            <input type="file" id="gambar" name="gambar[]" multiple
                class="w-full px-3 py-2 border rounded-lg @error('gambar.*') border-red-500 @enderror"
                accept="image/*" required>
            <small class="text-gray-500">Bisa pilih lebih dari satu gambar.</small>
        </div>

        {{-- Tombol --}}
        <div class="flex items-center space-x-3">
            <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded-lg">
                Simpan
            </button>
            <a href="{{ route('admin.berita.index') }}"
               class="text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
