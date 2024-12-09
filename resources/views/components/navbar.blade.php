<div>
    <nav class="flex gap-5 w-screen bg-slate-300 shadow-lg py-4 items-center fixed z-50">
        <!-- Logo -->
        <div class="px-10 w-96 mr-96">
            <a href="{{ route('home.show') }}">
                <div class="flex items-center">
                    <h1 class="text-red-600 text-4xl  font-black hover:opacity-80">AES<span class="text-black">256</span>
                    </h1>
                    <!-- Logo animasi -->
                    <dotlottie-player src="https://lottie.host/d35028d2-f7b8-45fd-94b3-6cf8d39f5595/EtLa69FkG2.json"
                        background="transparent" speed="1" style="width: 50px; height: 50px;" loop
                        autoplay></dotlottie-player>
                </div>
            </a>
        </div>

        <!-- Nav Data -->
        <div>
            <a href="{{ route('data.show') }}">
                <h2 class="font-bold text-orange-500 hover:text-orange-700">Data</h2>
            </a>
        </div>

        <!-- User Profile and Logout -->
        @auth
            <div class="absolute right-0 flex gap-5">
                <div class="relative">
                    <button class="inline-flex items-center text-gray-700 hover:text-gray-900">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.04.02L10 10.94l3.73-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0l-4.25-4.25a.75.75 0 01.02-1.04z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <a href="{{ route('profile.show') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
