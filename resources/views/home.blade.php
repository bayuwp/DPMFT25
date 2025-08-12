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

<!-- Section Visi Misi -->
<section class="py-16 bg-gradient-to-r from-blue-200 to-blue-100 min-h-screen">
  <div class="max-w-7xl mx-auto px-4">
    <!-- Heading -->
    <div class="flex justify-center">
        <h2 class="relative text-4xl font-bold text-center mt-10 mb-10 text-blue-900 drop-shadow-md
            border-4 border-blue-500 rounded-xl px-8 py-3 shadow-xl transition-transform duration-500
            hover:scale-105 hover:shadow-2xl">
            Visi & Misi
            <span class="absolute inset-0 border-4 border-blue-300 rounded-xl blur-md -z-10"></span>
        </h2>
    </div>

    <!-- Container -->
    <div class="flex flex-col md:flex-row items-center gap-10 bg-white p-8 rounded-xl shadow-xl">

        <!-- Logo + Nama Parlemen -->
        <div class="md:w-1/3 flex flex-col items-center" data-aos="zoom-in" data-aos-duration="700">
            <h3 class="text-3xl font-extrabold bg-gradient-to-r from-yellow-500 to-orange-600 bg-clip-text
                text-transparent tracking-wider drop-shadow-lg mb-4 uppercase text-center">
                Cakra Adhikara
            </h3>

            <img src="{{ asset('img/LOGO_PARLEMEN_CAKRA_ADHIKARA_DPM_FT-removebg-preview.png') }}"
                alt="Logo DPM FT"
                class="w-64 object-contain drop-shadow-lg mx-auto"
            >
        </div>

        <!-- Visi & Misi -->
        <div class="md:w-2/3 space-y-10">

            <!-- Visi -->
            <div data-aos="fade-up" data-aos-duration="600">
                <h3 class="text-2xl font-bold mb-3 text-blue-800">Visi</h3>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Menjadikan DPM FT UNESA sebagai lembaga legislatif
                    yang transparan, responsif, dan inovatif dalam memperjuangkan hak serta kesejahteraan
                    mahasiswa melalui kebijakan yang inklusif, demokratis, dan berintegritas.
                </p>
            </div>

            <!-- Misi -->
            <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                <h3 class="text-2xl font-bold mb-3 text-blue-800">Misi</h3>
                <ol class="list-decimal ml-6 text-gray-700 text-lg space-y-3 leading-relaxed">
                    <li data-aos="fade-right" data-aos-delay="200">Meningkatkan keterlibatan mahasiswa Fakultas Teknik dalam pengambilan keputusan dan pengawalan kebijakan.</li>
                    <li data-aos="fade-right" data-aos-delay="300">Memfasilitasi komunikasi yang efektif antara mahasiswa dan pihak kampus demi kesejahteraan mahasiswa FT UNESA.</li>
                    <li data-aos="fade-right" data-aos-delay="400">Mengembangkan layanan advokasi yang responsif terhadap kebutuhan Mahasiswa Fakultas Teknik.</li>
                    <li data-aos="fade-right" data-aos-delay="500">Membangun dan memperkuat komunikasi yang efektif antar organisasi mahasiswa, baik di lingkungan internal maupun eksternal, guna menciptakan sinergi dan kolaborasi yang positif.</li>
                </ol>
            </div>
        </div>
    </div>
  </div>
</section>
<!-- end Section Visi Misi -->

<!-- Berita Acara -->
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
                @php
                    $gambarList = json_decode($berita->gambar, true);
                @endphp

                <div class="bg-white shadow-lg rounded-xl overflow-hidden p-4" data-observe>
                    @if(!empty($gambarList))
                        <div id="slider-{{ $berita->id }}" class="splide" aria-label="Slider Berita {{ $berita->judul }}">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach($gambarList as $gambar)
                                        <li class="splide__slide">
                                            <img src="{{ asset('storage/' . $gambar) }}" alt="Gambar Berita"
                                                class="w-full aspect-[4/5] object-cover rounded-lg" />
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                    @else
                        <div class="bg-gray-200 flex items-center justify-center h-[240px] rounded-lg text-gray-500">
                            Tidak ada gambar
                        </div>
                    @endif

                    <h3 class="text-xl font-bold mt-4 text-gray-800">
                        {{ $berita->judul }}
                    </h3>

                    <p class="text-gray-600">
                        {{ \Illuminate\Support\Str::limit($berita->deskripsi, 100) }}
                    </p>
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

<!-- DearFlip Init -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @foreach($beritas as $berita)
            var el = document.getElementById('slider-{{ $berita->id }}');
            if(el){
                new Splide(el, {
                    type: 'loop',
                    perPage: 1,
                    autoplay: true,
                    pauseOnHover: true,
                    pagination: true,
                    arrows: true,
                }).mount();
            }
        @endforeach
    });
</script>



@endsection
