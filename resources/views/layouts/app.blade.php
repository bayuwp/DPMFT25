<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dewan Perwakilan Mahasiswa</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon-16x16.png') }}" type="image/x-icon" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins">

    @include('layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <div id="wa-button"
        class="fixed bottom-8 right-8 bg-green-500 text-white rounded-full p-4 shadow-lg cursor-pointer hover:bg-green-600 transition z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .5C5.7.5.5 5.7.5 12c0 2 .5 3.9 1.5 5.6L.5 23.5l6-1.6C8.1 22.5 10 23 12 23c6.3 0 11.5-5.2 11.5-11.5S18.3.5 12 .5zM12 21c-1.9 0-3.7-.5-5.3-1.4l-.4-.2-3.6 1 1-3.5-.2-.4C2.5 15.7 2 13.9 2 12 2 6.5 6.5 2 12 2s10 4.5 10 10-4.5 9-10 9zm5.2-6.8c-.3-.1-1.6-.8-1.8-.9-.2-.1-.4-.1-.6.1-.2.3-.7.9-.8 1-.1.1-.3.2-.6.1-.3-.1-1.1-.4-2-1.3-.7-.7-1.3-1.6-1.4-1.9-.1-.3 0-.4.1-.5.1-.1.3-.3.4-.4.1-.1.2-.2.3-.4.1-.1 0-.3 0-.4 0-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.4 0-.6.3-.2.3-.8.8-.8 2 0 1.2.9 2.4 1 2.6.1.2 1.8 3 4.3 4.2.6.3 1 .4 1.3.5.6.2 1.2.2 1.6.1.5-.1 1.6-.7 1.9-1.4.2-.7.2-1.2.1-1.4-.1-.1-.2-.2-.5-.3z"/>
        </svg>
    </div>

    <!-- Popup Chat -->
    <div id="chat-popup" class="hidden fixed bottom-24 right-8 bg-white rounded-xl shadow-xl w-72 z-50">
        <div class="bg-green-500 text-white rounded-t-xl px-4 py-2 flex justify-between items-center">
            <span class="text-sm">Dewan Perwakilan Mahasiswa</span>
            <button id="close-popup" class="text-white font-bold">×</button>
        </div>
        <div class="p-4">
            <p class="text-gray-700">Hello<br>Ada yang bisa kami bantu ?</p>
            <button onclick="window.open('https://wa.me/6285755897617','_blank')"
                    class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 w-full flex items-center justify-center gap-2">
                Open chat
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 .5C5.7.5.5 5.7.5 12c0 2 .5 3.9 1.5 5.6L.5 23.5l6-1.6C8.1 22.5 10 23 12 23c6.3 0 11.5-5.2 11.5-11.5S18.3.5 12 .5zM12 21c-1.9 0-3.7-.5-5.3-1.4l-.4-.2-3.6 1 1-3.5-.2-.4C2.5 15.7 2 13.9 2 12 2 6.5 6.5 2 12 2s10 4.5 10 10-4.5 9-10 9zm5.2-6.8c-.3-.1-1.6-.8-1.8-.9-.2-.1-.4-.1-.6.1-.2.3-.7.9-.8 1-.1.1-.3.2-.6.1-.3-.1-1.1-.4-2-1.3-.7-.7-1.3-1.6-1.4-1.9-.1-.3 0-.4.1-.5.1-.1.3-.3.4-.4.1-.1.2-.2.3-.4.1-.1 0-.3 0-.4 0-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.4 0-.6.3-.2.3-.8.8-.8 2 0 1.2.9 2.4 1 2.6.1.2 1.8 3 4.3 4.2.6.3 1 .4 1.3.5.6.2 1.2.2 1.6.1.5-.1 1.6-.7 1.9-1.4.2-.7.2-1.2.1-1.4-.1-.1-.2-.2-.5-.3z"/>
                </svg>
            </button>
        </div>
    </div>


    <!-- AOS JS & Init -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Tailwind CDN (opsional jika sudah pakai Vite) -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    {{-- <script src="https://unpkg.com/feather-icons"></script> --}}

    <!-- Script untuk Hamburger Menu -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            feather.replace();

            const btn = document.getElementById('hamburger-menu');
            const menu = document.getElementById('mobile-menu');
            const icon = btn.querySelector('i');

            if (btn && menu) {
                btn.addEventListener('click', function () {
                    menu.classList.toggle('hidden');
                    if (menu.classList.contains('hidden')) {
                        icon.setAttribute('data-feather', 'menu');
                    } else {
                        icon.setAttribute('data-feather', 'x');
                    }
                    feather.replace();
                });
            }

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 768) {
                    menu.classList.add('hidden');
                    icon.setAttribute('data-feather', 'menu');
                    feather.replace();
                }
            });
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const waButton = document.getElementById('wa-button');
        const chatPopup = document.getElementById('chat-popup');
        const closePopup = document.getElementById('close-popup');

        waButton.addEventListener('click', () => {
            chatPopup.classList.toggle('hidden');
        });

        closePopup.addEventListener('click', () => {
            chatPopup.classList.add('hidden');
        });

        // Munculkan balon chat otomatis setelah 2 detik
        setTimeout(() => {
            chatPopup.classList.remove('hidden');
        }, 2000);
    });
</script>
@stack('styles')
</body>
</html>
