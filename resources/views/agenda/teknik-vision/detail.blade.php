@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <article class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden">

        <!-- Header Judul -->
        <header class="px-6 py-4 border-b">
            <h1 class="text-4xl font-bold text-gray-900 text-center leading-tight mb-2 pt-6">
                {{ $proker->nama_proker }}
            </h1>
            <p class="text-gray-600 text-sm">
                <strong>Ketua:</strong> {{ $proker->ketupel ?? 'Belum ada' }}
            </p>
        </header>

        <!-- Konten Deskripsi -->
        <section class="px-6 py-8">
            <div class="ql-editor max-w-none">
                {!! $proker->deskripsi_proker !!}
            </div>
        </section>
    </article>
</div>
@endsection

@push('styles')
<style>
    /* Override typography bawaan Tailwind */
    .ql-editor {
        font-size: 18px !important; /* contoh ukuran */
        line-height: 1.8 !important;
        color: #333 !important;
        font-family: 'Georgia', serif;
    }

    /* Ukuran font Quill */
    .ql-editor .ql-size-small {
        font-size: 0.75em;
    }
    .ql-editor .ql-size-large {
        font-size: 1.5em;
    }
    .ql-editor .ql-size-huge {
        font-size: 2.5em;
    }


    /* Header dalam deskripsi */
    .ql-editor h1, .ql-editor h2, .ql-editor h3 {
        font-weight: bold;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }

    /* Paragraf */
    .ql-editor p {
        margin-bottom: 1rem;
    }

    /* ✅ Alignment */
    .ql-editor .ql-align-center { text-align: center; }
    .ql-editor .ql-align-right { text-align: right; }
    .ql-editor .ql-align-justify { text-align: justify; }

    /* ✅ Gambar lebih rapi */
    .ql-editor img {
        display: block;
        margin: 20px auto;
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    /* ✅ List style */
    .ql-editor ol {
        list-style-type: decimal !important;
        padding-left: 2rem;
    }

    .ql-editor ul {
        list-style-type: disc !important;
        padding-left: 2rem;
    }

    .ql-editor li {
        margin-bottom: 8px;
    }

    /* ✅ Blockquote lebih elegan */
    .ql-editor blockquote {
        border-left: 5px solid #3b82f6;
        background: #f0f7ff;
        margin: 20px 0;
        padding: 10px 15px;
        color: #1e40af;
        font-style: italic;
    }

    /* ✅ Tabel jika ada */
    .ql-editor table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .ql-editor th, .ql-editor td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .ql-editor th {
        background-color: #f9fafb;
        font-weight: bold;
    }
</style>
@endpush
