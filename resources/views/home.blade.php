@extends('layouts.app')

@section('content')

@include('layouts.partials.hero')

<!-- pengertian dpm start -->
<section id="dpm" class=" bg-gradient-to-tr from-blue-200 to-blue-100 py-12 opacity-0 translate-y-10 transition-all duration-700" data-observe>
    <div class="max-w-7xl mx-auto px-4 text-center">
        {{-- <h2 class="text-4xl font-bold text-blue-700">Dewan Perwakilan Mahasiswa</h2> --}}
        <div class="w-full px-8 md:px-8 lg:px-8 py-10">
            <div class="bg-white p-8 rounded-xl shadow-xl w-full border border-gray-300 hover:border-blue-500 transition duration-300">

                <!-- Judul -->
                <h2 class="text-4xl font-extrabold bg-gradient-to-r from-blue-500 to-blue-800 bg-clip-text text-transparent
                    tracking-wider drop-shadow-lg mb-6 uppercase text-center">
                    Dewan Perwakilan Mahasiswa
                </h2>
                <h2 class="text-3xl font-extrabold bg-gradient-to-r from-blue-500 to-blue-800 bg-clip-text text-transparent
                    tracking-wider drop-shadow-lg mb-6 uppercase text-center">
                    Fakultas Teknik
                </h2>

                <!-- Konten -->
                <div class="flex flex-col md:flex-row items-center gap-10">

                    <!-- Logo -->
                    <div class="md:w-1/3 flex flex-col items-center" data-aos="zoom-in">
                        <img src="{{ asset('img/logo_DPM-removebg-preview (1).png') }}"
                            alt="Logo DPM FT"
                            class="w-48 md:w-56 object-contain drop-shadow-lg transition-transform transform hover:scale-105 duration-300">
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:w-2/3 space-y-6 text-justify">
                        <p class="text-gray-700 text-lg leading-relaxed"
                        data-aos="fade-right"
                        data-aos-duration="1000"
                        data-aos-delay="100">
                            Dewan Perwakilan Mahasiswa Fakultas Teknik merupakan sebuah organisasi mahasiswa di tingkat fakultas
                            yang berperan sebagai lembaga legislatif mahasiswa. DPM FT memiliki tugas utama yaitu menyusun
                            Peraturan Daerah (Perda) Fakultas Teknik, menyediakan layanan advokasi bagi mahasiswa, mewakili aspirasi mahasiswa,
                            melakukan SOP Pengawasan pada lembaga eksekutif, serta memastikan bahwa segala kebijakan yang diambil
                            oleh lembaga eksekutif mahasiswa (BEM dan HMP) berjalan sesuai dengan kepentingan mahasiswa Fakultas Teknik.
                            Tugas-tugas DPM FT dibagi melalui berbagai komisi yang ada,
                            DPM Fakultas Teknik berusaha untuk menjaga keseimbangan antara kebutuhan mahasiswa
                            dan kebijakan yang diterapkan di tingkat fakultas.
                        </p>

                        <p class="text-gray-700 text-lg leading-relaxed"
                        data-aos="fade-left"
                        data-aos-duration="1000"
                        data-aos-delay="300">
                            DPM FT terdiri dari perwakilan mahasiswa yang dipilih melalui Pemilihan Raya (Pemira)
                            di tingkat fakultas dan staf ahli yang dipilih melalui open recruitment.
                            Struktur organisasi ini mirip dengan parlemen, dimana anggota DPM bertindak sebagai wakil mahasiswa.
                            DPM FT memiliki struktur organisasi yaitu BPH, Komisi Legislasi,
                            Komisi Pengawasan dan Audit, Komisi Advokesma, Komisi Humas dan Medinfo.
                        </p>
                    </div>

                </div>
            </div>
        </div>




    </div>
</section>
<!-- pengertian dpm end -->

<!-- berita acara -->
<section class="bg-gradient-to-br from-blue-200 to-blue-100 py-12" id="berita">
    <div class="max-w-6xl mx-auto px-4" data-aos="fade-up" data-aos-duration="800">
        <div class="flex justify-center">
            <h2 class="relative text-3xl sm:text-4xl font-extrabold text-center bg-gradient-to-r from-blue-900 to-blue-500
                bg-clip-text text-transparent mt-10 mb-6 border-4 border-blue-500 rounded-xl px-8 py-3 shadow-lg
                transition-transform duration-500 hover:scale-105">
                Berita Acara
                <span class="absolute inset-0 border-4 border-blue-300 rounded-xl blur-md -z-10"></span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($beritas as $berita)
            <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition-all duration-700 opacity-0 translate-y-10 hover:-translate-y-1 hover:shadow-2xl" data-observe>
                <div class="overflow-hidden">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                        class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 text-gray-800 hover:text-blue-600 transition-colors duration-300">
                        {{ $berita->judul }}
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $berita->deskripsi }}</p>
                    <a href="#" class="inline-block text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- JavaScript Scroll Observer -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('[data-observe]').forEach(el => {
            observer.observe(el);
        });
    });
</script>

@endsection
