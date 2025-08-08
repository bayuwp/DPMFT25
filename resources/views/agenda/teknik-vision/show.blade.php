@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-br from-blue-200 to-blue-100 py-12">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mt-10 mb-10">
            <img src="{{ $fotoFungsionaris }}"
                alt="Foto Fungsionaris {{ $namaKabinet }}"
                class="mx-auto max-h-80 w-auto object-contain shadow-lg mb-6">
            <h2 class="text-4xl font-bold text-blue-900">
                {{ $namaKabinet }}
            </h2>
            <p class="text-gray-600 mt-4 mx-auto lg:w-5/5 text-justify">{{ $deskripsi }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($prokers as $proker)
                @php
                    preg_match('/<img.*?src=["\'](.*?)["\']/', $proker->deskripsi_proker ?? '', $matches);
                    $imageUrl = !empty($matches[1])
                        ? asset(ltrim($matches[1], '/'))
                        : asset('img/default.jpg');
                @endphp
                <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition-all duration-700 opacity-0 translate-y-10 hover:-translate-y-1 hover:shadow-2xl" data-observe>
                    <div class="overflow-hidden">
                        <img src="{{ $imageUrl }}" alt="{{ $proker->nama_proker }}"
                            class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-800 hover:text-blue-600 transition-colors duration-300">
                            {{ $proker->nama_proker ?? 'Tanpa Nama' }}
                        </h3>
                        <p class="text-gray-600 mb-2">
                            <strong>Ketua:</strong> {{ $proker->ketupel ?? 'Belum ada' }}
                        </p>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {!! \Illuminate\Support\Str::limit(strip_tags($proker->deskripsi_proker ?? ''), 100) !!}
                        </p>
                        <a href="{{ route('agenda.teknik-vision.detail', [$slug, $proker->id]) }}"
                        class="inline-block text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('[data-observe]').forEach(card => {
            observer.observe(card);
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('[data-observe]').forEach(card => {
            observer.observe(card);
        });
    });
</script>
