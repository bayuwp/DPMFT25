@extends('layouts.app')

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-800 mb-10">Pengawasan DPM FT</h2>
            <p class="text-center text-gray-600 mb-12">Berikut adalah daftar program studi dan organisasi kemahasiswaan yang berada di bawah pengawasan DPM Fakultas Teknik Unesa.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $programs = [
                        ['name' => 'Teknik Mesin', 'slug' => 'teknik-mesin'],
                        ['name' => 'Pendidikan Teknik Mesin', 'slug' => 'pendidikan-teknik-mesin'],
                        ['name' => 'Pendidikan Tata Boga', 'slug' => 'pendidikan-tata-boga'],
                        ['name' => 'Pendidikan Tata Busana', 'slug' => 'pendidikan-tata-busana'],
                        ['name' => 'Pendidikan Tata Rias', 'slug' => 'pendidikan-tata-rias'],
                        ['name' => 'Teknik Informatika', 'slug' => 'teknik-informatika'],
                        ['name' => 'Pendidikan Teknik Informatika', 'slug' => 'pendidikan-teknik-informatika'],
                        ['name' => 'Sistem Informasi', 'slug' => 'sistem-informasi'],
                        ['name' => 'Teknik Elektro', 'slug' => 'teknik-elektro'],
                        ['name' => 'Pendidikan Teknik Elektro', 'slug' => 'pendidikan-teknik-elektro'],
                        ['name' => 'Teknik Sipil', 'slug' => 'teknik-sipil'],
                        ['name' => 'Pendidikan Teknik Bangunan', 'slug' => 'pendidikan-teknik-bangunan'],
                        ['name' => 'Perencanaan Wilayah dan Kota', 'slug' => 'pwk'],
                        ['name' => 'Badan Eksekutif Mahasiswa', 'slug' => 'bem'],
                    ];
                @endphp

                @foreach($programs as $prodi)
                    <a href="{{ url('/agenda/pengawasan/' . $prodi['slug']) }}"
                        class="block p-6 border border-gray-300 rounded-lg shadow hover:shadow-md bg-white text-center transition duration-300">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $prodi['name'] }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
