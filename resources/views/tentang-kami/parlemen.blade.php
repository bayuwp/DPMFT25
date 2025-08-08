@extends('layouts.app')

@section('content')
<section class="py-16 bg-gradient-to-b from-blue-50 to-blue-100 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-lg rounded-xl p-8 md:p-10 max-w-6xl mx-auto flex flex-col md:flex-row items-center md:items-start space-y-8 md:space-y-0 md:space-x-10">

            <!-- Logo Parlemen -->
            <div class="flex-shrink-0 text-center">
                <h2 class="text-3xl font-bold text-orange-600 mb-4">SWARA MAHARDIKA</h2>
                <img src="{{ asset('img/parlemen-logo.png') }}" alt="Logo Parlemen"
                     class="w-44 h-auto mx-auto">
            </div>

            <!-- Deskripsi -->
            <div class="text-gray-700 space-y-6 leading-relaxed">
                <p>
                    Ini mencakup konsep tentang kekuatan dan kepemimpinan yang dapat diperoleh melalui suara atau tindakan.
                    Filosofi Swara Mahardika mencakup berbagai aspek, seperti budi luhur, organisasi, dan kekuasaan besar dari suara.
                    Ini menjadi dasar bagi setiap individu dalam berbagi kehidupan dan mencapai tujuan yang berhubungan dengan kekuatan.
                    Warna-warna yang digunakan dapat merepresentasikan prodi yang ada di dalam fakultas teknik.
                </p>

                <div>
                    <h3 class="text-lg font-bold text-blue-900">Singa</h3>
                    <p>Singa merupakan hewan yang dipercaya memiliki kekuasaan dan kemampuan untuk berkuasa di dalam ekosistem. Singa dapat diartikan lambang kekuasaan.</p>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-blue-900">Tangan Mengais</h3>
                    <p>Tangan mengais dapat dilihat sebagai cara untuk menguatkan badan dan mengurangi masalah fisikal, sambil menjaga nilai-nilai moral dan luhur yang penting dalam hidup sehari-hari.</p>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-blue-900">Padi dan Kapas</h3>
                    <p>Padi dan kapas berarti keadilan dan kemakmuran. Padi dan kapas yang berada di mulut singa, berarti keputusan yang diterapkan harus adil dan bertujuan untuk kemakmuran.</p>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-blue-900">Kepakan Sayap</h3>
                    <p>Organisasi memiliki kepak sayap yang menjadi penopang dan bantuan bagi bangsa Indonesia, serta digunakan untuk mengatur informasi dan perlindungan dari penipuan.</p>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-blue-900">Warna</h3>
                    <p>Energi dan vitalitas: merah sering dikaitkan dengan energi, keberanian, dan vitalitas. Orange adalah warna yang menggambarkan semangat, kegembiraan, dan kreativitas. Kuning adalah warna optimisme dan kebahagiaan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
