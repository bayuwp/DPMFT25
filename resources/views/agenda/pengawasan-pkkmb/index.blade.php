@extends('layouts.app')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-blue-700 mt-10 mb-8">Laporan Pengawasan PKKMB Fakultas Teknik</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-200 to-blue-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-800 border-r">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-800 border-r">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-800 border-r">Berita Acara</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-800">Dokumentasi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($data as $index => $item)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3 border-r text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 border-r text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                            <td class="px-4 py-3 border-r">
                                @if ($item->berita)
                                    <a href="{{ asset('storage/' . $item->berita) }}" target="_blank" class="text-blue-600 hover:underline">
                                        📄 Lihat Berita
                                    </a>
                                @else
                                    <span class="text-gray-500 italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($item->dokumentasi)
                                    <a href="{{ $item->dokumentasi }}" target="_blank" class="text-blue-600 hover:underline">
                                        🖼️ Lihat Dokumentasi
                                    </a>
                                @else
                                    <span class="text-gray-500 italic">Tidak ada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada data pengawasan PKKMB.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
