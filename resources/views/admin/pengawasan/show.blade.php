@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="text-2xl text-purple-800 font-bold mb-6">
        📋 Daftar Proker - {{ ucfirst($slug) }}
    </h2>

    <!-- Wrapper agar tabel responsif di HP -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200 text-sm">
            <thead class="bg-purple-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Nama Proker</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Permintaan Edit</th>
                    <th class="px-4 py-3 text-left">Berita</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($prokers as $proker)
                <tr class="hover:bg-gray-50 transition">
                    <!-- Nama Proker -->
                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $proker->nama_proker }}
                    </td>

                    <!-- Status -->
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.pengawasan.updateStatus', [$slug, $proker->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="text-xs border rounded px-2 py-1">
                                <option value="belum terisi" {{ $proker->status === 'belum terisi' ? 'selected' : '' }}>Belum Terisi</option>
                                <option value="terisi" {{ $proker->status === 'terisi' ? 'selected' : '' }}>Terisi</option>
                                <option value="terlaksana" {{ $proker->status === 'terlaksana' ? 'selected' : '' }}>Terlaksana</option>
                            </select>
                        </form>
                    </td>



                    <!-- Permintaan Edit -->
                    <td class="px-4 py-3">
                        @if ($proker->edit_request_status === 'pending')
                            <div class="flex gap-2">
                                <form action="{{ route('admin.pengawasan.approve', [$slug, $proker->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.pengawasan.reject', [$slug, $proker->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        @elseif ($proker->edit_request_status === 'approved')
                            <span class="text-green-600 font-semibold text-xs"> Disetujui</span>
                        @elseif ($proker->edit_request_status === 'rejected')
                            <span class="text-red-600 font-semibold text-xs"> Ditolak</span>
                        @else
                            <span class="text-gray-400 italic text-xs">Tidak ada permintaan</span>
                        @endif
                    </td>

                    <!-- Upload/Lihat Berita -->
                    <td class="px-4 py-3">
                        @if ($proker->berita)
                            <div class="flex flex-col gap-2">
                                <a href="{{ asset('storage/' . $proker->berita) }}" target="_blank"
                                   class="text-blue-600 hover:underline text-xs">
                                    Lihat File
                                </a>
                                <form action="{{ route('admin.pengawasan.uploadBerita', [$slug, $proker->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="berita" class="text-xs w-full border p-1 rounded" required>
                                    <button type="submit" class="mt-1 bg-yellow-500 hover:bg-yellow-600 text-white text-xs py-1 px-2 rounded">
                                        Ganti File
                                    </button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('admin.pengawasan.uploadBerita', [$slug, $proker->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="berita" class="text-xs w-full border p-1 rounded" required>
                                <button type="submit" class="mt-1 bg-green-500 hover:bg-green-600 text-white text-xs py-1 px-2 rounded">
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
</div>
@endsection
