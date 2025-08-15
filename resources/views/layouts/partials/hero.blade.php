<!-- Tambahkan di <head> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section class="relative h-screen">
    <!-- Slider container -->
    <div class="swiper h-full">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide relative bg-cover bg-center" style="background-image: url('{{ asset('img/Gedung_FT.jpg') }}');">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white px-4" data-aos="zoom-in">
                        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">
                            Selamat Datang di Website<br>
                            Dewan Perwakilan Mahasiswa Fakultas Teknik<br>
                            Universitas Negeri Surabaya
                        </h1>
                        <p class="mt-4 text-lg md:text-xl font-semibold text-yellow-400">DPM FT! Viva Legislatif!</p>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide relative bg-cover bg-center" style="background-image: url('{{ asset('img/Gedung_FT.jpg') }}');">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h1 class="leading-relaxed">
                            <span class="block text-6xl md:text-7xl font-extrabold text-yellow-400 drop-shadow-lg" data-aos="zoom-in" data-aos-delay="100">Unesa!</span>
                            <span class="block text-3xl md:text-4xl font-semibold tracking-wide" data-aos="fade-up" data-aos-delay="300">Satu Langkah di Depan</span>

                            <span class="block text-6xl md:text-7xl font-extrabold text-yellow-400 drop-shadow-lg mt-6" data-aos="zoom-in" data-aos-delay="500">Unesa!</span>
                            <span class="block text-3xl md:text-4xl font-semibold tracking-wide" data-aos="fade-up" data-aos-delay="700">Bersama Bisa Bekerjasama</span>

                            <span class="block text-6xl md:text-7xl font-extrabold text-yellow-400 drop-shadow-lg mt-6" data-aos="zoom-in" data-aos-delay="900">Unesa!</span>
                            <span class="block text-3xl md:text-4xl font-semibold tracking-wide" data-aos="fade-up" data-aos-delay="1100">Untuk Indonesia Emas Tahun 2045</span>
                        </h1>
                        <p class="mt-8 text-lg md:text-xl font-bold text-yellow-300 uppercase tracking-widest" data-aos="fade-up" data-aos-delay="1300">
                            Jargon Unesa
                        </p>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide relative bg-cover bg-center" style="background-image: url('{{ asset('img/Gedung_FT.jpg') }}');">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white px-4" data-aos="zoom-in">
                        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">
                            Aksi Nyata<br>
                            Untuk Fakultas Teknik
                        </h1>
                        <p class="mt-4 text-lg md:text-xl font-semibold text-yellow-400">Solidaritas Tanpa Batas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- Tambahkan di akhir body -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
        loop: true,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
</script>
