@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mt-14 mb-6 text-blue-800 border-b pb-2
                text-center animate-fadeInDown">
            Jurusan: {{ ucwords(str_replace('-', ' ', $slug)) }}
        </h2>



    {{-- ✅ Template Dokumen --}}
    @php
        $templates = [
            ['name' => 'Proposal', 'folder' => 'proposal', 'color' => 'bg-blue-600 hover:bg-blue-700'],
            ['name' => 'Laporan Pertanggung Jawaban', 'folder' => 'laporan', 'color' => 'bg-green-600 hover:bg-green-700'],
            ['name' => 'Instrumen Materi', 'folder' => 'instrumen', 'color' => 'bg-blue-600 hover:bg-blue-700'],
        ];
    @endphp

    @foreach ($templates as $tpl)
        <div class="mb-12">
            <h3 class="text-xl font-semibold mb-4 text-gray-700">📄 Template {{ $tpl['name'] }}</h3>
            @php
                $files = glob(public_path("{$tpl['folder']}/*.pdf"));
            @endphp

            @if (count($files) > 0)
                @foreach ($files as $file)
                    @php
                        $filePath = str_replace(public_path(), '', $file);
                        $fileName = basename($file);
                    @endphp
                    <div class="mb-4 w-3/4 mx-auto rounded-lg overflow-hidden shadow-md border">
                        <embed src="{{ $filePath }}" type="application/pdf" class="w-full h-[450px]" />
                    </div>

                    <a href="{{ $filePath }}" target="_blank" rel="noopener noreferrer"
                       class="inline-block px-5 py-2 {{ $tpl['color'] }} text-white font-semibold rounded shadow transition">
                        📥 Download {{ $fileName }}
                    </a>
                @endforeach
            @else
                <p class="text-red-600 italic">📌 Template {{ $tpl['name'] }} belum tersedia.</p>
            @endif
        </div>
    @endforeach

    {{-- ✅ Tabel Program Kerja --}}
    <div class="mb-12">
        <h3 class="text-xl font-semibold mb-4 text--700">📋 Daftar Program Kerja</h3>
        <div class="overflow-x-auto border rounded shadow">
            <table class="min-w-full text-sm bg-white border border-blue-300">
                <thead class="bg-blue-200 text-blue-700 text-center">
                    <tr class="divide-x divide-gray-300">
                        @foreach ([
                            'No', 'Kategori', 'Nama Proker', 'Ketupel', 'Tanggal',
                            'Proposal', 'Upload Proposal', 'Status Proposal',
                            'LPJ', 'Upload LPJ', 'Status LPJ',
                            'LPA', 'Manajemen Resiko',
                            'Link GForm Peserta', 'Link GForm Panitia'
                        ] as $head)
                            <th class="px-4 py-3 font-semibold border-b border-blue-300 whitespace-nowrap">
                                {{ $head }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-center divide-y divide-gray-200">
                    @forelse($prokers as $index => $proker)
                        <tr class="hover:bg-blue-50 divide-x divide-blue-200">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td>{{ $proker->kategori ?? '-' }}</td>
                            <td class="font-medium">{{ $proker->nama_proker }}</td>
                            <td>{{ $proker->ketupel }}</td>
                            <td>{{ $proker->tanggal }}</td>

                            {{-- Proposal --}}
                            <td>
                                @if ($proker->proposal)
                                    <a href="{{ asset('storage/' . $proker->proposal) }}"
                                    target="_blank"
                                    class="text-blue-600 hover:underline">Lihat</a>
                                @else
                                    <span class="italic text-gray-400">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST"
                                    action="{{ route('ppl-ft.proker.updateProposal', [$slug, $proker->id]) }}"
                                    enctype="multipart/form-data"
                                    class="flex flex-col items-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="proposal" accept="application/pdf"
                                        class="text-xs mb-2 border rounded p-1">
                                    <button type="submit"
                                            class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                                        Upload
                                    </button>
                                </form>
                            </td>
                            @php
                                $status = strtolower(trim($proker->status_proposal ?? ''));
                            @endphp

                            <td>
                                <span
                                    @class([
                                        'px-2 py-1 rounded text-white text-xs',
                                        'bg-green-500' => in_array($status, ['disetujui', 'valid']),
                                        'bg-orange-500' => in_array($status, ['pending', 'upload', 'diupload']),
                                        'bg-gray-400' => !in_array($status, ['disetujui', 'valid', 'pending', 'upload', 'diupload']),
                                    ])>
                                    {{ $proker->status_proposal ?? '-' }}
                                </span>
                            </td>

                            {{-- LPJ --}}
                            <td>
                                @if ($proker->lpj)
                                    <a href="{{ asset('storage/' . $proker->lpj) }}"
                                    target="_blank"
                                    class="text-blue-600 hover:underline">Lihat</a>
                                @else
                                    <span class="italic text-gray-400">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST"
                                    action="{{ route('ppl-ft.proker.updateLpj', [$slug, $proker->id]) }}"
                                    enctype="multipart/form-data"
                                    class="flex flex-col items-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="lpj" accept="application/pdf"
                                        class="text-xs mb-2 border rounded p-1">
                                    <button type="submit"
                                            class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                                        Upload
                                    </button>
                                </form>
                            </td>
                            @php
                                $statusLpj = strtolower(trim($proker->status_lpj ?? ''));
                            @endphp

                            <td>
                                <span
                                    @class([
                                        'px-2 py-1 rounded text-white text-xs',
                                        'bg-green-500' => $statusLpj === 'validasi pembina',
                                        'bg-yellow-500' => $statusLpj === 'validasi dpm',
                                        'bg-orange-500' => $statusLpj === 'pending',
                                        'bg-orange-400' => !in_array($statusLpj, ['validasi pembina', 'validasi dpm', 'pending']),
                                    ])>
                                    {{ $proker->status_lpj ?? '-' }}
                                </span>
                            </td>



                            {{-- LPA --}}
                            <td>
                                @if ($proker->lpa)
                                    <a href="{{ asset('storage/' . $proker->lpa) }}"
                                    target="_blank"
                                    class="text-blue-600 hover:underline">Lihat</a>
                                @else
                                    <span class="italic text-gray-400">Belum ada</span>
                                @endif
                            </td>

                            {{-- Manajemen Resiko --}}
                            <td>
                                @if ($proker->manajemen_resiko)
                                    <a href="{{ asset('storage/' . $proker->manajemen_resiko) }}"
                                    target="_blank"
                                    class="text-indigo-600 hover:underline">Lihat</a>
                                @else
                                    <span class="italic text-gray-400">Belum ada</span>
                                @endif
                            </td>

                            {{-- Links --}}
                            <td>
                                @if ($proker->link_gform_peserta)
                                    <a href="{{ $proker->link_gform_peserta }}"
                                    target="_blank"
                                    class="text-blue-500 hover:underline">Buka</a>
                                @else
                                    <span class="italic text-gray-400">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                @if ($proker->link_gform_panitia)
                                    <a href="{{ $proker->link_gform_panitia }}"
                                    target="_blank"
                                    class="text-blue-500 hover:underline">Buka</a>
                                @else
                                    <span class="italic text-gray-400">Belum ada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="text-center py-4 text-blue-500">
                                Belum ada data program kerja.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    {{-- ✅ Tabel Dokumen Tambahan --}}
    <div class="mb-12">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">📁 Dokumen Tambahan Proker</h3>
        <div class="overflow-x-auto border rounded shadow">
            <table class="min-w-full text-sm bg-white divide-y divide-gray-200">
                <thead class="bg-blue-200 text-blue-700 text-center">
                    <tr>
                        @foreach (['No', 'Nama Proker', 'Rundown', 'Absensi Panitia', 'Absensi Peserta', 'Absensi Tamu Undangan', 'Instrumen Materi', 'Dokumentasi', 'Time Stap'] as $head)
                            <th class="px-4 py-3 font-semibold">{{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y text-center">
                    @forelse($prokers as $index => $proker)
                        <tr class="hover:bg-gray-50 align-top">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 font-medium">{{ $proker->nama_proker }}</td>

                            @foreach (['rundown_kegiatan','absensi_panitia','absensi_peserta','absensi_tamu_undangan','instrumen_materi','dokumentasi','time_stap'] as $field)
                                <td class="px-4 py-2">
                                    @if ($field === 'instrumen_materi')
                                        @if ($proker->instrumen_materi)
                                            <a href="{{ asset('storage/' . $proker->instrumen_materi) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                                        @else
                                            <span class="italic text-gray-400">Belum ada</span>
                                        @endif
                                    @else
                                        @if ($proker->$field)
                                            <div class="flex flex-col items-center space-y-2">
                                                <a href="{{ asset('storage/' . $proker->$field) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                                                <form action="{{ route('ppl-ft.proker.updateDokumen', ['slug' => $slug, 'id' => $proker->id, 'field' => $field]) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="file" class="text-xs mb-1">
                                                    <button type="submit" class="px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-xs">Ganti</button>
                                                </form>
                                            </div>
                                        @else
                                            <form action="{{ route('ppl-ft.proker.updateDokumen', ['slug' => $slug, 'id' => $proker->id, 'field' => 'time_stap']) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="files[]" accept="image/*" multiple class="text-xs mb-1 w-full" required>
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs py-1 px-2 rounded">Upload</button>
                                            </form>

                                        @endif
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Belum ada dokumen tambahan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ✅ Chat Box --}}
    <div class="mb-16">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">💬 Chat Admin & User</h3>
        <div class="border rounded-lg p-4 bg-gray-50 h-64 overflow-y-auto shadow-inner mb-4">
            @forelse($chats as $chat)
                <div class="mb-3 p-2 rounded {{ $chat->sender === 'Admin' ? 'bg-blue-100 text-blue-700' : 'bg-gray-200 text-gray-700' }}">
                    <div><strong>{{ $chat->sender }}:</strong> {{ $chat->message }}</div>
                    <div class="text-xs text-gray-500">{{ $chat->created_at->diffForHumans() }}</div>
                </div>
            @empty
                <p class="text-gray-500 text-center">Belum ada pesan.</p>
            @endforelse
        </div>

        <form method="POST" action="{{ route('ppl-ft.chat.send', $slug) }}" class="flex gap-2">
            @csrf
            <input type="text" name="message" required placeholder="Ketik pesan..."
                class="flex-grow px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Kirim
            </button>
        </form>
    </div>
</div>

@endsection

<style>
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fadeInDown {
    animation: fadeInDown 0.8s ease-out forwards;
}
</style>
