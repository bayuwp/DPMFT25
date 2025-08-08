<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Admin - DPM FT</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon-16x16.png') }}" type="image/x-icon" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

</head>
<body class="font-poppins bg-gray-100 min-h-screen">

<!-- Navbar Admin -->
<nav class="bg-pink shadow mb-8">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-lg font-bold text-blue-800">Admin DPM FT</div>
        <ul class="flex space-x-6 items-center">
            <li>
                <a href="{{ url('/admin/berita') }}" class="text-blue-700 hover:text-purple-600 font-medium">Berita</a>
            </li>
            <li>
                <a href="{{ url('/admin/agenda') }}" class="text-blue-700 hover:text-purple-600 font-medium">Agenda</a>
            </li>
            <li>
                <a href="{{ url('/admin/pengawasan-pkkmb') }}" class="text-blue-700 hover:text-purple-600 font-medium">Pengawasan PKKMB</a>
            </li>
            <li>
                <a href="{{ url('/admin/ppl-ft') }}" class="text-blue-700 hover:text-purple-600 font-medium">PPL-FT</a>
            </li>
            <li>
                <a href="{{ url('/admin/teknik-vision') }}" class="text-blue-700 hover:text-purple-600 font-medium">Teknik Vision</a>
            </li>
            <li>
                <a href="{{ route('admin.cabinets.index') }}" class="text-blue-700 hover:text-purple-600 font-medium">Cabinet</a>
            </li>

            <li class="relative group">
                <!-- Tombol Dropdown -->
                <button class="flex items-center text-blue-700 hover:text-purple-600 font-medium focus:outline-none">
                    Tentang Kami
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Menu Dropdown -->
                <ul class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg
                        opacity-0 invisible group-hover:opacity-100 group-hover:visible
                        transition-all duration-200 flex flex-col z-50">
                    <li>
                        <a href="{{ url('/admin/tentang-kami/bph') }}"
                        class="block px-4 py-2 text-blue-700 hover:bg-purple-100">BPH</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/tentang-kami/komisi-1') }}"
                        class="block px-4 py-2 text-blue-700 hover:bg-purple-100">Komisi 1</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/tentang-kami/komisi-2') }}"
                        class="block px-4 py-2 text-blue-700 hover:bg-purple-100">Komisi 2</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/tentang-kami/komisi-3') }}"
                        class="block px-4 py-2 text-blue-700 hover:bg-purple-100">Komisi 3</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/tentang-kami/komisi-4') }}"
                        class="block px-4 py-2 text-blue-700 hover:bg-purple-100">Komisi 4</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>

<!-- Main Content -->
<main class="px-4">
    @yield('content')
</main>
@stack('scripts')
</body>
</html>
