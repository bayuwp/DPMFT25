import feather from 'feather-icons';
import ClassicEditorBase from '@ckeditor/ckeditor5-build-classic';
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment';
import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter';

// ✅ Extend CKEditor dengan plugin tambahan (Alignment + Upload)
class ClassicEditor extends ClassicEditorBase {}

ClassicEditor.builtinPlugins = [
    ...ClassicEditorBase.builtinPlugins,
    Alignment,
    SimpleUploadAdapter // Image plugin sudah ada default, tidak perlu diulang
];

ClassicEditor.defaultConfig = {
    toolbar: [
        'heading', '|',
        'bold', 'italic', 'link', '|',
        'bulletedList', 'numberedList', '|',
        'blockQuote', '|',
        'alignment', '|',          // ✅ gunakan 'alignment' saja
        'insertTable', 'uploadImage', 'mediaEmbed', '|',
        'undo', 'redo'
    ],
    alignment: {
        options: ['left', 'center', 'right', 'justify']
    },
    image: {
        toolbar: [
            'imageTextAlternative',
            '|',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side'
        ]
    },
    simpleUpload: {
        uploadUrl: '/admin/teknik-vision/upload-image',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    }
};


const initCKEditor = (element) => {
    if (!element.classList.contains('ck-editor-initialized')) {
        ClassicEditor.create(element)
            .then(editor => {
                console.log('✅ CKEditor berhasil diinisialisasi', editor);
                element.classList.add('ck-editor-initialized');
            })
            .catch(error => {
                console.error('❌ CKEditor gagal diinisialisasi:', error);
            });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    feather.replace();

    const menuBtn = document.getElementById('hamburger-menu');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    document.querySelectorAll('.ckeditor').forEach(initCKEditor);

    const observer = new MutationObserver(() => {
        document.querySelectorAll('.ckeditor').forEach(initCKEditor);
    });
    observer.observe(document.body, { childList: true, subtree: true });
});
