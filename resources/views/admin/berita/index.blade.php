@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-purple-800">Daftar Berita</h2>
        <a href="{{ route('admin.berita.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded">
            + Tambah Berita
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto divide-y divide-purple-200">
            <thead class="bg-purple-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Gambar</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Judul</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Deskripsi</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-purple-200">
                @forelse($beritas as $berita)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar" class="w-24 rounded shadow">
                    </td>
                    <td class="px-4 py-3 text-gray-800 font-semibold">{{ $berita->judul }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ Str::limit($berita->deskripsi, 100) }}</td>
                    <td class="px-4 py-3 space-x-2">
                        <a href="{{ route('admin.berita.edit', $berita) }}"
                           class="inline-block bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded text-sm">
                            Edit
                        </a>
                        <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                        Tidak ada data berita.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
