@extends('layouts.app')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        {{-- HEADER --}}
        <div class="text-center mt-14 mb-10">
            @if (!empty($data['logo']))
                <img src="{{ $data['logo'] }}" alt="Logo HMP" class="mx-auto w-32 mb-4">
            @endif
            <h2 class="text-3xl font-bold text-blue-800">{{ $proker['nama_proker'] ?? $proker['nama'] ?? '-' }}</h2>
            <p class="text-gray-700 mt-4">{{ $data['deskripsi'] }}</p>
        </div>

        {{-- FOTO PROKER --}}
        @if (!empty($data['foto_proker']))
            <div class="mb-12">
                <img src="{{ $data['foto_proker'] }}" alt="Foto Proker" class="rounded-lg mx-auto shadow-lg w-full max-w-2xl">
                <p class="mt-6 text-center text-gray-600">Dokumentasi kegiatan program kerja HMP.</p>
            </div>
        @endif

        {{-- TABEL PROKER --}}
        <div class="overflow-x-auto mb-12">
            <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-blue-500 text-white text-left">
                        <th class="px-6 py-3 text-sm font-semibold uppercase">No</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Nama Proker</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Kategori</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Status</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Berita</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Edit</th>
                        <th class="px-6 py-3 text-sm font-semibold uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data['prokers'] as $index => $proker)
                    <tr class="hover:bg-blue-50 transition duration-200">
                        {{-- No --}}
                        <td class="px-6 py-3 text-gray-700 font-medium">{{ $index + 1 }}</td>

                        {{-- Nama Proker --}}
                        <td class="px-6 py-3 text-gray-700">{{ $proker['nama_proker'] ?? '-' }}</td>

                        {{-- Tanggal --}}
                        <td class="px-6 py-3 text-gray-600">
                            @if (!empty($proker['tanggal']))
                                {{ \Carbon\Carbon::parse($proker['tanggal'])->translatedFormat('d F Y') }}
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>

                        {{-- Kategori --}}
                        <td class="px-6 py-3 text-gray-700">{{ $proker['kategori'] ?? '-' }}</td>

                        {{-- Status dengan Badge --}}
                        <td class="px-6 py-3">
                            @php
                                $badgeClasses = match($proker['status']) {
                                    'Belum Terisi' => 'bg-yellow-100 text-yellow-700',
                                    'Terisi' => 'bg-blue-100 text-blue-700',
                                    'Terlaksana' => 'bg-green-100 text-green-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $badgeClasses }}">
                                {{ $proker['status'] }}
                            </span>
                        </td>

                        {{-- Berita --}}
                        <td class="px-6 py-3 text-gray-700">
                            @if (!empty($proker['berita']))
                                <a href="{{ asset('storage/' . $proker['berita']) }}"
                                target="_blank"
                                class="text-blue-600 hover:underline">
                                    Lihat Berita
                                </a>
                            @else
                                <span class="italic text-gray-400">Belum ada</span>
                            @endif
                        </td>

                        {{-- Edit --}}
                        <td class="px-6 py-3">
                            @php
                                $canEdit = isset($proker['created_at']) && \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($proker['created_at'])) <= 14;
                            @endphp

                            @if ($canEdit)
                                <a href="{{ route('proker.edit', ['slug' => $data['slug'], 'id' => $proker['id']]) }}"
                                class="inline-flex items-center gap-1 bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-medium hover:bg-blue-200 transition">
                                     Edit
                                </a>
                            @else
                                @if ($proker['edit_request_status'] === 'none')
                                    <form action="{{ route('proker.requestEdit', ['slug' => $data['slug'], 'id' => $proker['id']]) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium hover:bg-yellow-200 transition">
                                             Minta Persetujuan
                                        </button>
                                    </form>
                                @elseif ($proker['edit_request_status'] === 'pending')
                                    <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-medium">
                                         Menunggu Persetujuan
                                    </span>
                                @elseif ($proker['edit_request_status'] === 'approved')
                                    <a href="{{ route('proker.edit', ['slug' => $data['slug'], 'id' => $proker['id']]) }}"
                                    class="inline-flex items-center gap-1 bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium hover:bg-green-200 transition">
                                         Edit (Disetujui)
                                    </a>
                                @elseif ($proker['edit_request_status'] === 'rejected')
                                    <span class="inline-flex items-center gap-1 bg-red-100 text-red-500 px-3 py-1 rounded-full text-xs font-medium">
                                         Permintaan Ditolak
                                    </span>
                                @endif
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-3">
                            <a href="{{ route('ppl-ft.proker.validasiStatus', ['slug' => $data['slug'] ?? $slug, 'id' => $proker['id']]) }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs shadow">
                                Validasi
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tombol Tambah --}}
        <div class="text-right">
            <button id="openModal" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Tambah Proker
            </button>
        </div>
    </div>
</section>

{{-- MODAL TAMBAH --}}
<div id="modalForm" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">✕</button>
        <h3 class="text-xl font-semibold mb-4 text-blue-700">Tambah Proker Baru</h3>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('proker.store', ['slug' => $data['slug'] ?? $slug]) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-medium">Nama Proker</label>
                <input type="text" name="nama_proker" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Ketua Pelaksana (Ketupel)</label>
                <input type="text" name="ketupel" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Nomor WhatsApp (Gunakan 62 untuk 0)</label>
                <input type="text" name="nomor_wa" class="w-full border px-3 py-2 rounded" placeholder="Contoh: 081234567890" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Kategori</label>
                <select name="kategori" class="w-full border px-3 py-2 rounded" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Pelaksanaan Seminar/Workshop/Pelatihan Mahasiswa">Pelaksanaan Seminar/Workshop/Pelatihan Mahasiswa</option>
                    <option value="Penyelenggaraan Lomba Tingkat Nasional">Penyelenggaraan Lomba Tingkat Nasional</option>
                    <option value="Pemilihan Umum Raya (Pemira)">Pemilihan Umum Raya (Pemira)</option>
                    <option value="Diskusi Mahasiswa">Diskusi Mahasiswa</option>
                    <option value="Penyusunan Proker Ormawa">Penyusunan Proker Ormawa</option>
                    <option value="FT Fair">FT Fair</option>
                    <option value="Studi Banding Mahasiswa">Studi Banding Mahasiswa</option>
                    <option value="Upgrading Mahasiswa">Upgrading Mahasiswa</option>
                    <option value="Pembinaan Kerohanian Mahasiswa">Pembinaan Kerohanian Mahasiswa</option>
                    <option value="Latihan Kepemimpinan Manajerial Mahasiswa">Latihan Kepemimpinan Manajerial Mahasiswa</option>
                    <option value="Persiapan Pengenalan Kehidupan Kampus Mahasiswa Baru">Persiapan Pengenalan Kehidupan Kampus Mahasiswa Baru</option>
                </select>
            </div>

            {{-- Upload Instrumen Materi --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">Upload Instrumen Materi</label>
                <input type="file" name="instrumen_materi" class="w-full">
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan Proker
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');
        const modal = document.getElementById('modalForm');

        openModal.addEventListener('click', () => modal.classList.remove('hidden'));
        closeModal.addEventListener('click', () => modal.classList.add('hidden'));

        // Klik di luar modal untuk menutup
        window.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });
    });
</script>
@endsection
