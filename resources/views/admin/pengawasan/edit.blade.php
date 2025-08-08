@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Edit Data Pengawasan HMP</h2>

    <form action="{{ route('admin.pengawasan.update', $pengawasan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Nama HMP</label>
            <input type="text" name="nama" value="{{ $pengawasan->nama }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded px-3 py-2" rows="3" required>{{ $pengawasan->deskripsi }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Logo HMP</label>
            <input type="file" name="logo" class="w-full border rounded px-3 py-2">
            <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah logo.</small>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold">Foto Proker</label>
            <input type="file" name="foto_proker" class="w-full border rounded px-3 py-2">
            <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah foto proker.</small>
        </div>

        <hr class="my-6">

        <h3 class="text-lg font-bold mb-4">Program Kerja</h3>
        <div id="proker-container">
            @foreach ($pengawasan->prokers as $proker)
            <div class="mb-4 proker-item">
                <input type="hidden" name="proker_id[]" value="{{ $proker->id }}">
                <label class="block text-gray-700">Nama Proker</label>
                <input type="text" name="proker_nama[]" value="{{ $proker->nama }}" class="w-full border rounded px-3 py-2 mb-2" required>

                <label class="block text-gray-700">Berita</label>
                <input type="text" name="proker_berita[]" value="{{ $proker->berita }}" class="w-full border rounded px-3 py-2 mb-2" required>

                <label class="block text-gray-700">Terlaksana</label>
                <select name="proker_terlaksana[]" class="w-full border rounded px-3 py-2 mb-4">
                    <option value="Ya" {{ $proker->terlaksana == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ $proker->terlaksana == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
                <hr class="my-4">
            </div>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Update</button>
    </form>
</div>
@endsection
