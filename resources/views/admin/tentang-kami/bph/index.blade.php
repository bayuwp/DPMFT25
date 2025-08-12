@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">BPH</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah / Edit --}}
    <form action="{{ isset($editData) ? route('admin.bph.update', $editData->id) : route('admin.bph.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-3">
        @csrf
        @if(isset($editData))
            @method('PUT')
        @endif

        <input type="text" name="nama" placeholder="Nama Lengkap"
               value="{{ old('nama', $editData->nama ?? '') }}"
               class="w-full border p-2 rounded" required>
        <input type="text" name="jabatan" placeholder="Jabatan"
               value="{{ old('jabatan', $editData->jabatan ?? '') }}"
               class="w-full border p-2 rounded" required>

        <input type="file" name="foto" class="w-full border p-2 rounded">
        @if(isset($editData) && $editData->foto)
            <img src="{{ asset('storage/' . $editData->foto) }}" class="h-12 mt-2">
        @endif

        <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white px-4 py-2 rounded">
            {{ isset($editData) ? 'Update' : 'Tambah' }}
        </button>
        @if(isset($editData))
            <a href="{{ route('admin.bph.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</a>
        @endif
    </form>

    {{-- Table Data --}}
<table class="w-full mt-6 border border-blue-200">
    <thead class="bg-purple-600 text-white px-4 py-2 rounded">
        <tr>
            <th class="p-2 border">Foto</th>
            <th class="p-2 border">Nama</th>
            <th class="p-2 border">Jabatan</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td class="p-2 border text-center">
                    @if($item->foto)
                        <div class="flex justify-center">
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                 class="w-24 h-24 rounded-full object-cover border-2 border-gray-300 shadow">
                        </div>
                    @endif
                </td>
                <td class="p-2 border">{{ $item->nama }}</td>
                <td class="p-2 border">{{ $item->jabatan }}</td>
                <td class="p-2 border text-center space-x-2">
                    <a href="{{ route('admin.bph.edit', $item->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                    <form action="{{ route('admin.bph.destroy', $item->id) }}"
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
