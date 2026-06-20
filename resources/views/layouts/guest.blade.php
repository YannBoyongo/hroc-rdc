<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Healing and Rebuilding Our Communities (HROC RDC) - Organisation non gouvernementale œuvrant pour la paix, les droits de l'homme, la gouvernance et le développement durable en RDC.">

        <title>@yield('title', 'HROC RDC - ' . config('app.name', 'Laravel'))</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if(config('app.env') === 'production')
            @php
                $manifestPath = public_path('build/manifest.json');
                $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
            @endphp
            @if($manifest)
                @if(isset($manifest['resources/css/app.css']))
                    <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
                @endif
                @if(isset($manifest['resources/js/app.js']))
                    <script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>
                @endif
            @else
                {{-- Fallback si le manifest n'existe pas --}}
                <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
                <script type="module" src="{{ asset('build/assets/app.js') }}"></script>
            @endif
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-light_cyan-500">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="HROC RDC Logo" class="h-16 w-auto">
                    <span class="ml-3 text-2xl font-bold text-deep_twilight-500">HROC RDC</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl border border-gray-200 overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
