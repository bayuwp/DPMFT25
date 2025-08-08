@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-10 max-w-3xl">
    <h2 class="text-3xl font-bold mb-6 text-center">
        Edit Deskripsi Proker: {{ $proker->nama_proker }}
    </h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('teknik-vision.update-deskripsi', [$slug, $proker->id]) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="deskripsi_proker" class="block font-semibold mb-2">Deskripsi Proker</label>

        <!-- Hidden textarea untuk menyimpan HTML -->
        <textarea id="deskripsi_proker" name="deskripsi_proker" class="hidden">
            {{ old('deskripsi_proker', $proker->deskripsi_proker ?? '') }}
        </textarea>

        <!-- Editor Quill -->
        <div id="editor" class="bg-white border rounded p-3" style="height: 300px;"></div>

        @error('deskripsi_proker')
            <p class="text-red-600 mt-2">{{ $message }}</p>
        @enderror

        <button type="submit"
                class="mt-4 bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 w-full">
            💾 Simpan Deskripsi
        </button>
    </form>
</div>
@endsection

@push('scripts')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<style>
    .ql-font-times-new-roman { font-family: 'Times New Roman', Times, serif; }
    .ql-font-futura { font-family: 'Futura', sans-serif; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const Font = Quill.import('formats/font');
    Font.whitelist = ['sans-serif', 'serif', 'monospace', 'times-new-roman', 'futura'];
    Quill.register(Font, true);

    // ✅ Tambahkan di sini
    const AlignStyle = Quill.import('attributors/style/align');
    const FontStyle = Quill.import('attributors/style/font');
    Quill.register(AlignStyle, true);
    Quill.register(FontStyle, true);

    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                [{ font: Font.whitelist }, { size: [] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'sub' }, { script: 'super' }],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ align: [] }], // ✅ align aktif
                ['blockquote', 'code-block'],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    // Set data lama
    quill.root.innerHTML = document.getElementById('deskripsi_proker').value;

    // Upload image handler
    quill.getModule('toolbar').addHandler('image', () => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = () => {
            const file = input.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', '{{ csrf_token() }}');

                fetch("{{ route('teknik-vision.upload-image') }}", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        const range = quill.getSelection();
                        quill.insertEmbed(range.index, 'image', result.url);
                    } else {
                        alert(result.error);
                    }
                })
                .catch(() => alert('Upload gagal.'));
            }
        };
    });

    // Saat submit form
    document.querySelector('form').addEventListener('submit', () => {
        document.getElementById('deskripsi_proker').value = quill.root.innerHTML;
    });
});
</script>
@endpush
