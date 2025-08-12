@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold text-purple-800 mb-6">Edit Cabinet</h2>

    <form action="{{ route('admin.cabinets.update', $cabinet->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

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
            <input type="text" name="nama_cabinet" value="{{ old('nama_cabinet', $cabinet->nama_cabinet) }}" class="w-full border rounded p-2">
            @error('nama_cabinet') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Deskripsi Jurusan</label>
            <textarea name="deskripsi_jurusan" class="w-full border rounded p-2">{{ old('deskripsi_jurusan', $cabinet->deskripsi_jurusan) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Logo Cabinet</label>
            @if($cabinet->logo_cabinet)
                <img src="{{ asset('storage/'.$cabinet->logo_cabinet) }}" alt="Logo" class="h-12 mb-2">
            @endif
            <input type="file" name="logo_cabinet" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Foto Fungsionaris</label>
            @if($cabinet->foto_fungsionaris)
                <img src="{{ asset('storage/'.$cabinet->foto_fungsionaris) }}" alt="Foto" class="h-12 mb-2">
            @endif
            <input type="file" name="foto_fungsionaris" class="w-full border rounded p-2">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('admin.cabinets.index') }}" class="ml-2 bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Batal</a>
        </div>
    </form>
</div>
@endsection
