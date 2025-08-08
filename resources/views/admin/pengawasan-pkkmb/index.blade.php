@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-10">
    <h2 class="text-2xl text-purple-800 font-bold mb-6">Pengawasan PKKMB Fakultas Teknik</h2>
    <p class="mb-6 text-gray-700">Berisi laporan kegiatan dan dokumentasi dari kegiatan PKKMB FT.</p>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.pengawasan-pkkmb.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded">+ Tambah Data</a>
    </div>

    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full border border-gray-300">
        <thead class="bg-purple-100">
            <tr>
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Berita</th>
                <th class="px-4 py-2">Dokumentasi</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $item)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $i+1 }}</td>
                <td class="px-4 py-2">{{ $item->tanggal }}</td>
                <td class="px-4 py-2">
                    @if($item->berita)
                        <a href="{{ asset('storage/' . $item->berita) }}" target="_blank" class="text-purple-600 underline">Lihat</a>
                    @else
                        <span class="text-gray-400 italic">-</span>
                    @endif
                </td>
                <td class="px-4 py-2">
                    @if($item->dokumentasi)
                        <a href="{{ $item->dokumentasi }}" target="_blank" class="text-purple-600 underline">Lihat Dokumentasi</a>
                    @else
                        <span class="text-gray-400 italic">-</span>
                    @endif
                </td>

                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('admin.pengawasan-pkkmb.edit', $item->id) }}" class="text-yellow-600">Edit</a>
                    <form action="{{ route('admin.pengawasan-pkkmb.destroy', $item->id) }}" method="POST" class="inline"
                        onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
