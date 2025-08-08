<footer class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-12 shadow-inner">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12">

        <!-- Kiri: Logo & Informasi -->
        <div>
            <div class="flex items-center gap-5 mb-6">
                <img src="{{ asset('img/Logo_Universitas_Negeri_Surabaya_Terbaru-removebg-preview (1).png') }}"
                     alt="UNESA" class="w-14 h-14 object-contain hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('img/logo_DPM-removebg-preview (1).png') }}"
                     alt="DPM" class="w-14 h-14 object-contain hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('img/LOGO_PARLEMEN_CAKRA_ADHIKARA_DPM_FT-removebg-preview.png') }}"
                     alt="Parlemen" class="w-14 h-14 object-contain hover:scale-105 transition-transform duration-300">
            </div>
            <h3 class="text-lg font-extrabold bg-gradient-to-r from-yellow-300 to-yellow-500 bg-clip-text text-transparent ">
                Cakra Adhikara
            </h3>
            <p class="font-semibold text-lg">Dewan Perwakilan Mahasiswa</p>
            <p class="text-gray-300">Fakultas Teknik - Universitas Negeri Surabaya</p>
            <p class="mt-2 text-gray-400 text-sm">Periode 2025</p>
        </div>

        <!-- Kanan: Kontak & Sosial Media -->
        <div>
            <ul class="space-y-2 text-gray-200">
                <li><span class="font-semibold">Alamat:</span> Kampus Ketintang Surabaya, Jawa Timur 60231</li>
                <li><span class="font-semibold">Sekretariat:</span> Gedung Ormawa Fakultas Teknik A11.02.02</li>
                <li><span class="font-semibold">Email:</span>
                    <a href="mailto:dpmft@unesa.ac.id" class="underline hover:text-yellow-400 transition">dpmft@unesa.ac.id</a>
                </li>
                <li><span class="font-semibold">Instagram:</span>
                    <a href="https://www.instagram.com/dpmft_unesa/" target="_blank" class="underline hover:text-yellow-400 transition">@dpmft_unesa</a>
                </li>
                <li><span class="font-semibold">TikTok:</span>
                    <a href="https://www.tiktok.com/@dpmft.unesa" target="_blank" class="underline hover:text-yellow-400 transition">@dpmft.unesa</a>
                </li>
            </ul>

            <div class="flex space-x-5 mt-5">
                <a href="https://www.instagram.com/dpmft_unesa/" target="_blank" class="hover:scale-110 transition-transform duration-300">
                    <img src="{{ asset('img/ig_1-removebg-preview.png') }}" alt="Instagram" class="w-9 h-9">
                </a>
                <a href="mailto:dpmft@unesa.ac.id" target="_blank" class="hover:scale-110 transition-transform duration-300">
                    <img src="{{ asset('img/email_1-removebg-preview.png') }}" alt="Email" class="w-7 h-7">
                </a>
                <a href="https://www.tiktok.com/@dpmft.unesa" target="_blank" class="hover:scale-110 transition-transform duration-300">
                    <img src="{{ asset('img/tiktok 1.png') }}" alt="TikTok" class="w-8 h-8">
                </a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="mt-10 text-center text-sm border-t border-white/20 pt-4 text-gray-300">
        © 2025 <span class="font-semibold text-white">DPMFT</span>. All Rights Reserved.
    </div>
</footer>
