<div>
    <nav class="flex gap-5 w-screen bg-slate-300 shadow-lg py-4 items-center fixed z-50">

        {{-- Logo --}}
        <div class="px-10 w-96 mr-96">
            <a href="{{ route('home.show') }}">
                <div class="flex items-center">
                    <h1 class="text-red-600 text-4xl  font-black hover:opacity-80">AES<span class="text-black">256</span>
                    </h1>
                    <dotlottie-player src="https://lottie.host/d35028d2-f7b8-45fd-94b3-6cf8d39f5595/EtLa69FkG2.json"
                        background="transparent" speed="1" style="width: 50px; height: 50px;" loop
                        autoplay></dotlottie-player>
                </div>
            </a>
        </div>

        {{-- Nav Data --}}
        <div>
            <a href="{{ route('data.show') }}">
                <h2 class="font-bold text-orange-500 hover:text-orange-700">Data</h2>
            </a>
        </div>

        {{-- Button Converter --}}
        <div class="absolute right-60 z-10">
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <div>
                    <button @click="open = !open" type="button"
                        class="inline-flex justify-center w-full rounded-md border text-white  border-gray-300 shadow-sm px-4 py-2 bg-orange-500 text-sm font-medium  hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-orange-500"
                        id="options-menu" aria-haspopup="true" aria-expanded="true">
                        Converter
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.04.02L10 10.94l3.73-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0l-4.25-4.25a.75.75 0 01.02-1.04z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div x-show="open" @click.away="open = false"
                    class="origin-top-right absolute right-0 mt-2 w-28 rounded-md shadow-lg bg-orange-100 ring-1 ring-black ring-opacity-5 z-10"
                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1 z-10" role="none">
                        <!-- Dropdown menu links -->
                        <a href="{{ route('text-encrypt.show') }}"
                            class="block px-4 py-2 text-sm text-orange-500 hover:text-orange-700 hover:bg-orange-200 "
                            role="menuitem">Text</a>
                        <a href="{{ route('file-encrypt.show') }}"
                            class="block px-4 py-2 text-sm text-orange-500 hover:text-orange-700 hover:bg-orange-200 "
                            role="menuitem">File</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profil --}}
        <div class="absolute right-16">
            <div x-data="{ open: false }" >
                <div>
                    <button @click="open = !open" type="button" id="options-profile" aria-haspopup="true" aria-expanded="true">
                        <figure class="w-10 h-10">
                            <img src="{{ asset('assets/img/icon_profile.png') }}" alt="">
                        </figure>
                    </button>
                </div>
                <div x-show="open" @click.away="open = false"
                    class="origin-top-right absolute right-0 mt-2 w-28 rounded-md shadow-lg bg-red-100 ring-1 ring-black ring-opacity-5 z-10"
                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1 z-10" role="none">
                        <!-- Dropdown menu links -->
                        <a href="{{ route('auth') }}"
                            class="block px-4 py-2 text-sm text-red-600 hover:text-red-800 hover:bg-red-200 "
                            role="menuitem">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
