@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Daftar Proker - {{ ucfirst($slug) }}</h2>

    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Nama Proker</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Permintaan Edit</th>
                <th class="px-4 py-2">Berita</th> {{-- ✅ Tambah kolom berita --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($prokers as $proker)
            <tr>
                <td class="px-4 py-2">{{ $proker->nama_proker }}</td>
                <td class="px-4 py-2">{{ $proker->status ?? '-' }}</td>
                <td class="px-4 py-2">
                    @if ($proker->edit_request_status === 'pending')
                        <form action="{{ route('admin.pengawasan.approve', [$slug, $proker->id]) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Setujui</button>
                        </form>
                        <form action="{{ route('admin.pengawasan.reject', [$slug, $proker->id]) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Tolak</button>
                        </form>
                    @elseif ($proker->edit_request_status === 'approved')
                        <span class="text-green-600">Disetujui</span>
                    @elseif ($proker->edit_request_status === 'rejected')
                        <span class="text-red-600">Ditolak</span>
                    @else
                        <span class="text-gray-400 italic">Tidak ada permintaan</span>
                    @endif
                </td>
                {{-- ✅ Tambahkan kolom upload berita --}}
                <td class="px-4 py-2">
                    @if ($proker->berita)
                        <div class="flex flex-col space-y-1">
                            <a href="{{ asset('storage/' . $proker->berita) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                            <form action="{{ route('admin.pengawasan.uploadBerita', [$slug, $proker->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="berita" class="text-xs w-full mb-1" required>
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs py-1 px-2 rounded">
                                    Ganti File
                                </button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('admin.pengawasan.uploadBerita', [$slug, $proker->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="berita" class="text-xs w-full mb-1" required>
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs py-1 px-2 rounded">
                                Upload
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
