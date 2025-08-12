@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Komisi 1</h2>

    {{-- ✅ Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ Validasi error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ Form Tambah / Edit --}}
    <form action="{{ isset($editData) ? route('admin.komisi1.update', $editData->id) : route('admin.komisi1.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="mb-6 space-y-3">
        @csrf
        @if(isset($editData))
            @method('PUT')
        @endif

        <input type="text" name="nama" placeholder="Nama"
               value="{{ old('nama', $editData->nama ?? '') }}"
               class="border p-2 w-full rounded focus:ring focus:ring-blue-200">
        <input type="text" name="jabatan" placeholder="Jabatan"
               value="{{ old('jabatan', $editData->jabatan ?? '') }}"
               class="border p-2 w-full rounded focus:ring focus:ring-blue-200">
        <input type="file" name="foto"
               class="border p-2 w-full rounded focus:ring focus:ring-blue-200">

        @if(isset($editData) && $editData->foto)
            <img src="{{ asset('storage/'.$editData->foto) }}" class="w-32 aspect-[4/5] object-cover rounded mt-2 shadow">
        @endif

        <div class="flex gap-2">
            <button type="submit"
                    class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded shadow">
                {{ isset($editData) ? 'Update' : 'Tambah' }}
            </button>
            @if(isset($editData))
                <a href="{{ route('admin.komisi1.index') }}"
                   class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded shadow">
                    Batal
                </a>
            @endif
        </div>
    </form>

    {{-- ✅ Tabel Data --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-sm">
            <thead class="bg-purple-600 text-white px-4 py-2 text-gray-700">
                <tr>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Jabatan</th>
                    <th class="border px-4 py-2">Foto</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $item->nama }}</td>
                        <td class="border px-4 py-2">{{ $item->jabatan }}</td>
                        <td class="border px-4 py-2 text-center">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" class="w-20 aspect-[4/5] object-cover mx-auto rounded shadow">
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center space-x-2">
                            <a href="{{ route('admin.komisi1.edit', $item->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow">Edit</a>
                            <form action="{{ route('admin.komisi1.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                  class="inline">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">
                            Belum ada data Komisi 1.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
