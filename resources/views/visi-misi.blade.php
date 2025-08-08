@extends('layouts.app')

@section('content')
<!-- Section Visi Misi -->
<section class="py-16 bg-gradient-to-br from-blue-100 to-blue-200">
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
@endsection
