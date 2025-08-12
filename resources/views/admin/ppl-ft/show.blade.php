@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl text-center font-bold mb-6 text-blue-800 border-b pb-2">
        Admin Panel - Jurusan: {{ ucwords(str_replace('-', ' ', $slug)) }}
    </h2>


    {{-- Tabel Proker --}}
<div class="mb-10">
    <h3 class="text-xl font-semibold mb-4 text-blue-700">Daftar Program Kerja</h3>
    <div class="overflow-x-auto border border-blue-300 rounded-lg shadow-sm">
        <table class="min-w-full text-sm bg-white divide-y divide-blue-200 whitespace-nowrap">
            <thead class="bg-blue-100 text-gray-700">
                <tr>
                    @foreach ([
                        'No', 'Kategori', 'Nama Proker', 'Ketupel', 'Tanggal',
                        'Proposal', 'Status Proposal', 'LPJ', 'Status LPJ',
                        'LPA', 'Manajemen Risiko',
                        'Link GForm Panitia', 'Link GForm Peserta'
                    ] as $head)
                        <th class="px-4 py-3 text-left font-semibold">{{ $head }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-blue-100">
                @forelse($prokers as $index => $proker)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">{{ $proker->kategori }}</td>
                        <td class="px-4 py-3 max-w-xs truncate" title="{{ $proker->nama_proker }}">{{ $proker->nama_proker }}</td>
                        <td class="px-4 py-3">{{ $proker->ketupel }}</td>
                        <td class="px-4 py-3">{{ $proker->tanggal }}</td>

                        <td class="px-4 py-3">
                            @if ($proker->proposal)
                                <a href="{{ asset('storage/' . $proker->proposal) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                            @else
                                <span class="italic text-gray-400">Belum ada</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <form action="{{ route('admin.ppl-ft.proker.updateStatus', ['slug' => $slug, 'id' => $proker->id]) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="field" value="status_proposal">
                                <select name="value" class="text-sm border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-400">
                                    @foreach (['Pending', 'Valid'] as $option)
                                        <option value="{{ $option }}" {{ $proker->status_proposal === $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="text-xs text-blue-600 hover:underline">Update</button>
                            </form>
                        </td>

                        <td class="px-4 py-3">
                            @if ($proker->lpj)
                                <a href="{{ asset('storage/' . $proker->lpj) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                            @else
                                <span class="italic text-gray-400">Belum ada</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <form action="{{ route('admin.ppl-ft.proker.updateStatus', ['slug' => $slug, 'id' => $proker->id]) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="field" value="status_lpj">
                                <select name="value" class="text-sm border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-400">
                                    @foreach (['Pending', 'Validasi DPM', 'Validasi Pembina'] as $option)
                                        <option value="{{ $option }}" {{ $proker->status_lpj === $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="text-xs text-blue-600 hover:underline" type="submit">Update</button>
                            </form>
                        </td>

                        <td class="px-4 py-3 max-w-xs whitespace-normal">
                            @if ($proker->lpa)
                                <a href="{{ asset('storage/' . $proker->lpa) }}" target="_blank" class="text-purple-600 hover:underline block mb-1">Lihat</a>
                            @endif
                            <form action="{{ route('ppl-ft.proker.updateDokumen', ['slug' => $slug, 'id' => $proker->id, 'field' => 'lpa']) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="text-xs mb-1 w-full border border-gray-300 rounded px-2 py-1" required>
                                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white text-xs py-1 px-2 rounded w-full">Upload</button>
                            </form>
                        </td>

                        <td class="px-4 py-3 max-w-xs whitespace-normal">
                            @if ($proker->manajemen_resiko)
                                <a href="{{ asset('storage/' . $proker->manajemen_resiko) }}" target="_blank" class="text-indigo-600 hover:underline block mb-1">Lihat</a>
                            @endif
                            <form action="{{ route('ppl-ft.proker.updateDokumen', ['slug' => $slug, 'id' => $proker->id, 'field' => 'manajemen_resiko']) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="text-xs mb-1 w-full border border-gray-300 rounded px-2 py-1" required>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs py-1 px-2 rounded w-full">Upload</button>
                            </form>
                        </td>

                        <td class="px-4 py-3 max-w-xs whitespace-normal">
                            <form action="{{ route('admin.ppl-ft.proker.updateLink', ['slug' => $slug, 'id' => $proker->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="field" value="link_gform_panitia">
                                <input type="url" name="link" value="{{ $proker->link_gform_panitia }}" placeholder="https://..." class="text-xs mb-1 w-full border border-gray-300 rounded px-2 py-1">
                                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white text-xs py-1 px-2 rounded w-full">Simpan</button>
                            </form>
                        </td>

                        <td class="px-4 py-3 max-w-xs whitespace-normal">
                            <form action="{{ route('admin.ppl-ft.proker.updateLink', ['slug' => $slug, 'id' => $proker->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="field" value="link_gform_peserta">
                                <input type="url" name="link" value="{{ $proker->link_gform_peserta }}" placeholder="https://..." class="text-xs mb-1 w-full border border-gray-300 rounded px-2 py-1">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs py-1 px-2 rounded w-full">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center py-6 text-gray-500 italic">Belum ada data proker.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


{{-- Tabel Dokumen Tambahan --}}
<div class="mb-12">
    <h3 class="text-xl font-semibold mb-4 text-blue-700">Dokumen Tambahan</h3>
    <div class="overflow-x-auto border border-blue-300 rounded-lg shadow-sm">
        <table class="min-w-full text-sm bg-white divide-y divide-gray-200 whitespace-nowrap">
            <thead class="bg-blue-100 text-gray-700">
                <tr>
                    @foreach (['No', 'Nama Proker', 'Rundown', 'Absensi Panitia', 'Absensi Peserta', 'Absensi Tamu Undangan', 'Instrumen Materi', 'Dokumentasi', 'Time Stap'] as $head)
                        <th class="px-4 py-3 text-left font-semibold">{{ $head }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-100">
                @foreach ($prokers as $index => $proker)
                    <tr class="hover:bg-gray-50 align-top">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 max-w-xs truncate" title="{{ $proker->nama_proker }}">{{ $proker->nama_proker }}</td>

                        {{-- Kolom selain dokumentasi & time stap --}}
                        @foreach (['rundown_kegiatan', 'absensi_panitia', 'absensi_peserta', 'absensi_tamu_undangan', 'instrumen_materi'] as $field)
                            <td class="px-4 py-3 align-top">
                                @if ($proker->$field)
                                    <a href="{{ asset('storage/' . $proker->$field) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                                @else
                                    <form action="{{ route('ppl-ft.proker.updateDokumen', [$slug, $proker->id, $field]) }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
                                        @csrf
                                        <input type="file" name="file" class="text-xs mb-1 w-full border border-gray-300 rounded px-2 py-1" required>
                                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white text-xs py-1 px-2 rounded w-full">Upload</button>
                                    </form>
                                @endif
                            </td>
                        @endforeach

                        {{-- Kolom Dokumentasi pakai link --}}
                        <td class="px-4 py-3 align-top max-w-xs whitespace-normal">
                            @if ($proker->dokumentasi)
                                <a href="{{ $proker->dokumentasi }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                            @else
                                <form action="{{ route('ppl-ft.proker.updateLinkDokumen', [$slug, $proker->id, 'dokumentasi']) }}" method="POST" class="flex flex-col">
                                    @csrf
                                    <input type="url" name="link" placeholder="Masukkan link dokumentasi" required
                                        class="text-xs mb-1 w-full border border-gray-300 rounded px-2 py-1">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs py-1 px-2 rounded w-full">Simpan</button>
                                </form>
                            @endif
                        </td>

                        {{-- Kolom Time Stap pakai link --}}
                        <td class="px-4 py-3 align-top max-w-xs whitespace-normal">
                            @if ($proker->time_stap)
                                <a href="{{ $proker->time_stap }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                            @else
                                <form action="{{ route('ppl-ft.proker.updateLinkDokumen', [$slug, $proker->id, 'time_stap']) }}" method="POST" class="flex flex-col">
                                    @csrf
                                    <input type="url" name="link" placeholder="Masukkan link time stap" required
                                        class="text-xs mb-1 w-full border border-gray-300 rounded px-2 py-1">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs py-1 px-2 rounded w-full">Simpan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Chat Box --}}
    <div class="mb-16">
        <h3 class="text-xl font-semibold mt-6 mb-4 text-blue-700">💬 Chat Admin & User</h3>

        <div class="border border-blue-300 rounded p-4 bg-gray-50 h-64 overflow-y-auto shadow mb-4">
            @forelse($chats as $chat)
                <div class="mb-3">
                    <div><strong>{{ $chat->sender }}:</strong> {{ $chat->message }}</div>
                    <div class="text-xs text-gray-500">{{ $chat->created_at->diffForHumans() }}</div>
                </div>
            @empty
                <p class="text-gray-500 italic">Belum ada pesan.</p>
            @endforelse
        </div>

        <form method="POST" action="{{ route('admin.ppl-ft.chat.send', $slug) }}" class="flex items-center gap-2">
            @csrf
            <input type="text" name="message" required placeholder="Ketik pesan..."
                class="flex-grow px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Kirim
            </button>
        </form>
    </div>
</div>


</div>
@endsection
