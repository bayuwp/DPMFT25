import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: path.resolve(__dirname, '../public_html/build'), // simpan langsung di public_html/build
        emptyOutDir: true, // hapus isi lama sebelum build baru
    },
});
