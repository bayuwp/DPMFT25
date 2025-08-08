@extends('layouts.admin')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-purple-800 mb-10">Halaman Agenda</h2>
        <p class="text-center text-gray-600 mb-12">Pilih agenda yang ingin Anda kelola</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Agenda Pengawasan -->
            <a href="{{ url('/admin/pengawasan') }}"
               class="block p-6 border border-gray-300 rounded-lg shadow hover:shadow-md hover:bg-purple-50 transition duration-300">
                <h3 class="text-xl font-semibold text-purple-700 mb-2 text-center">Pengawasan</h3>
                <p class="text-sm text-gray-600 text-center">Dokumentasi dan pengawasan terhadap HMP dan lembaga kemahasiswaan di FT.</p>
            </a>

            <!-- Agenda Pengawasan PKKMB -->
            <a href="{{ url('/admin/pengawasan-pkkmb') }}"
               class="block p-6 border border-gray-300 rounded-lg shadow hover:shadow-md hover:bg-purple-50 transition duration-300">
                <h3 class="text-xl font-semibold text-purple-700 mb-2 text-center">Pengawasan PKKMB</h3>
                <p class="text-sm text-gray-600 text-center">Tindak lanjut hasil pengawasan kegiatan PKKMB Fakultas Teknik.</p>
            </a>
        </div>
    </div>
</section>
@endsection
