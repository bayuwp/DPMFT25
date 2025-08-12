@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-extrabold text-purple-800 mb-4 text-center sm:text-left">Pengawasan PKKMB Fakultas Teknik</h2>
    <p class="mb-6 text-gray-700 text-center sm:text-left">Berisi laporan kegiatan dan dokumentasi dari kegiatan PKKMB FT.</p>

    <div class="flex justify-center sm:justify-end mb-6">
        <a href="{{ route('admin.pengawasan-pkkmb.create') }}"
           class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-md font-semibold transition">
           + Tambah Data
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md text-center sm:text-left">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-purple-700 text-white">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wide">No</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wide">Tanggal</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wide">Berita</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wide">Dokumentasi</th>
                    <th scope="col" class="px-4 py-3 text-center text-sm font-semibold uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($items as $i => $item)
                <tr class="hover:bg-purple-50 transition-colors">
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $i + 1 }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                        @if($item->berita)
                            <a href="{{ asset('storage/' . $item->berita) }}" target="_blank" class="text-purple-600 underline hover:text-purple-800">
                                Lihat
                            </a>
                        @else
                            <span class="text-gray-400 italic">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                        @if($item->dokumentasi)
                            <a href="{{ $item->dokumentasi }}" target="_blank" class="text-purple-600 underline hover:text-purple-800">
                                Lihat Dokumentasi
                            </a>
                        @else
                            <span class="text-gray-400 italic">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-center text-sm space-x-4">
                        <a href="{{ route('admin.pengawasan-pkkmb.edit', $item->id) }}"
                           class="text-yellow-600 hover:text-yellow-800 font-semibold">Edit</a>

                        <form action="{{ route('admin.pengawasan-pkkmb.destroy', $item->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($items->isEmpty())
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500 italic">Data tidak tersedia.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
