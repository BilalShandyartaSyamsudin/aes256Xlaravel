<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="flex justify-center items-center bg-white h-[450px] shadow-md rounded-md gap-5">
            <div class="pl-10">
                <dotlottie-player src="https://lottie.host/dd3d87ca-a0a7-448f-b5dd-869bfcc402da/s4G3jZgwb5.json"
                background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                autoplay></dotlottie-player>
            </div>
            <div class="pr-10">
                {{ $slot }}
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</body>

</html>
