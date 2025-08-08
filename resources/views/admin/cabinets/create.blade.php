@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold text-blue-800 mb-6">Tambah Cabinet</h2>

    <form action="{{ route('admin.cabinets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <select name="slug" class="w-full border rounded p-2">
                @foreach($jurusanList as $slug => $nama)
                    <option value="{{ $slug }}"
                        {{ old('slug', $cabinet->slug ?? '') == $slug ? 'selected' : '' }}>
                        {{ $nama }} ({{ $jurusanEmails[$slug] ?? '' }})
                    </option>
                @endforeach
            </select>
            @error('slug')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Cabinet</label>
            <input type="text" name="nama_cabinet" value="{{ old('nama_cabinet') }}" class="w-full border rounded p-2">
            @error('nama_cabinet') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Deskripsi Jurusan</label>
            <textarea name="deskripsi_jurusan" class="w-full border rounded p-2">{{ old('deskripsi_jurusan') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Logo Cabinet</label>
            <input type="file" name="logo_cabinet" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Foto Fungsionaris</label>
            <input type="file" name="foto_fungsionaris" class="w-full border rounded p-2">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
            <a href="{{ route('admin.cabinets.index') }}" class="ml-2 bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Batal</a>
        </div>
    </form>
</div>
@endsection
