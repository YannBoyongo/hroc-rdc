<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="HROC RDC - Dashboard Administrateur">

        <title>@yield('title', 'Dashboard - ' . config('app.name', 'HROC RDC'))</title>

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
        <div class="min-h-screen flex flex-col lg:flex-row">
            <!-- Sidebar -->
            <x-sidebar />

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col lg:ml-64">
                <!-- Top Navigation Bar -->
                <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-30">
                    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                        <!-- Page Title / Breadcrumb -->
                        <div class="flex-1">
                            @isset($header)
                                <h1 class="text-xl font-semibold text-deep_twilight-500">
                                    {{ $header }}
                                </h1>
                            @else
                                <h1 class="text-xl font-semibold text-deep_twilight-500">
                                    @yield('title', 'Dashboard')
                                </h1>
                            @endisset
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center space-x-4">
                            <!-- View Website Link -->
                            <a href="{{ route('home') }}" 
                               class="hidden sm:flex items-center px-4 py-2 text-sm font-medium text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 rounded-lg transition-colors"
                               target="_blank">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                {{ __('View Website') }}
                            </a>

                            <!-- User Dropdown -->
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-deep_twilight-500 bg-white border border-gray-200 rounded-lg hover:bg-blue_green-50 hover:text-blue_green-600 focus:outline-none transition-colors">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 flex items-center justify-center mr-2">
                                                <span class="text-white font-semibold text-xs">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                            </div>
                                            <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                                        </div>
                                        <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
