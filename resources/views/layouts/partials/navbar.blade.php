@php
    $menuItems = [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Ruang Cakra', 'url' => '/Ruang_Cakra'],
        ['label' => 'Struktur', 'url' => '/struktur'],
        ['label' => 'Arsip', 'url' => '/arsip'],
        ['label' => 'Agenda', 'url' => '/agenda'],
        ['label' => 'PPL-FT', 'url' => '/ppl-ft'],
    ];

    $tentangKamiItems = [
        ['label' => 'Parlemen', 'url' => '/tentang-kami/parlemen'],
        ['label' => 'BPH', 'url' => '/tentang-kami/bph'],
        ['label' => 'Komisi 1', 'url' => '/tentang-kami/komisi-1'],
        ['label' => 'Komisi 2', 'url' => '/tentang-kami/komisi-2'],
        ['label' => 'Komisi 3', 'url' => '/tentang-kami/komisi-3'],
        ['label' => 'Komisi 4', 'url' => '/tentang-kami/komisi-4'],
    ];
@endphp

<nav class="bg-gradient-to-r from-blue-800 to-blue-500 shadow-md fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('img/logo_DPM-removebg-preview (1).png') }}"
                     alt="Logo DPM"
                     class="w-12 h-12 drop-shadow-lg">
                <div>
                    <a href="{{ url('/') }}"
                       class="text-xl font-extrabold text-white tracking-wide">
                        DPM<span class="text-yellow-400"> FT</span>
                    </a>
                    <p class="text-xs text-gray-200 leading-tight">Universitas Negeri Surabaya</p>
                </div>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex space-x-6 items-center">
                @foreach($menuItems as $item)
                    <a href="{{ url($item['url']) }}"
                    class="relative text-gray-100 hover:text-yellow-300 font-medium transition duration-300 group">
                        {{ $item['label'] }}
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                @endforeach

                <!-- Dropdown Tentang Kami -->
                <div class="relative group">
                    <!-- Tombol -->
                    <div class="flex items-center cursor-pointer text-gray-100 hover:text-yellow-300 font-medium">
                        <!-- Ikon Rumah -->
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 9.75L12 4l9 5.75V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9.75z" />
                        </svg>
                        Tentang Kami
                    </div>

                    <!-- Dropdown -->
                    <div class="absolute left-0 top-full mt-0 w-40 bg-blue-600 rounded shadow-lg
                                opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                transition-all duration-200 z-50">
                        @foreach($tentangKamiItems as $item)
                            <a href="{{ url($item['url']) }}"
                            class="block px-4 py-2 text-white hover:bg-blue-700">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>


            <!-- Hamburger -->
            <div class="md:hidden">
                <button id="hamburger-menu" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" id="menu-icon" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden flex-col bg-blue-500 mt-2 rounded-lg shadow-lg p-3 space-y-2">
            @foreach($menuItems as $item)
                <a href="{{ url($item['url']) }}"
                class="block text-white hover:bg-blue-600 hover:border hover:border-yellow-300 px-3 py-2 rounded transition duration-200">
                    {{ $item['label'] }}
                </a>
            @endforeach

            <!-- Dropdown Tentang Kami (Klik) -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open"
                        class="w-full text-left relative text-gray-100 hover:text-yellow-300 font-medium
                            transition duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 9.75L12 4l9 5.75V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9.75z" />
                    </svg>
                    Tentang Kami
                </button>


                <!-- Dropdown Menu -->
                <div x-show="open"
                    x-transition
                    class="mt-2 bg-blue-400 rounded shadow-lg z-50 w-full">
                    <a href="{{ url('/tentang-kami/bph') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">BPH</a>
                    <a href="{{ url('/tentang-kami/komisi-1') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Komisi 1</a>
                    <a href="{{ url('/tentang-kami/komisi-2') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Komisi 2</a>
                    <a href="{{ url('/tentang-kami/komisi-3') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Komisi 3</a>
                    <a href="{{ url('/tentang-kami/komisi-4') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Komisi 4</a>
                </div>
            </div>
        </div>

</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btn = document.getElementById('hamburger-menu');
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');

        btn.addEventListener('click', function () {
            menu.classList.toggle('hidden');

            if (!menu.classList.contains('hidden')) {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                menu.classList.add('hidden');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
            }
        });
    });
</script>
<script src="//unpkg.com/alpinejs" defer></script>
