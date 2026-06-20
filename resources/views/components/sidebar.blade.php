<div x-data="{ mobileOpen: false }" class="lg:block">
    <!-- Sidebar Overlay (Mobile) -->
    <div x-show="mobileOpen" 
         @click="mobileOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-75 z-40 lg:hidden"
         style="display: none;"></div>

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 shadow-lg lg:translate-x-0 transform transition-transform duration-300 ease-in-out flex flex-col"
           :class="{ '-translate-x-full': !mobileOpen }">
        
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-16 px-6 bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 border-b border-gray-200 flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="HROC RDC Logo" class="h-8 w-auto">
                <span class="ml-3 text-lg font-bold text-white">HROC RDC</span>
            </a>
            <button @click="mobileOpen = false" class="lg:hidden text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto py-4 min-h-0">
            <div class="px-3 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    {{ __('Dashboard') }}
                </a>

                <!-- Settings -->
                <a href="{{ route('settings.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('settings.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ __('Settings') }}
                </a>

                <!-- Réalisations -->
                <a href="{{ route('admin.realisations.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.realisations.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    {{ __('Réalisations') }}
                </a>

                <!-- Domaines -->
                <a href="{{ route('admin.domains.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.domains.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    {{ __('Domaines') }}
                </a>

                <!-- Approches -->
                <a href="{{ route('admin.approaches.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.approaches.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    {{ __('Approches') }}
                </a>

                <!-- Objectifs -->
                <a href="{{ route('admin.objectives.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.objectives.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ __('Objectifs') }}
                </a>

                <!-- Entreprise -->
                <a href="{{ route('admin.company.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.company.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    {{ __('Entreprise') }}
                </a>

                <!-- Sliders -->
                <a href="{{ route('admin.sliders.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.sliders.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ __('Sliders') }}
                </a>

                <!-- Partenaires -->
                <a href="{{ route('admin.partners.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.partners.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    {{ __('Partenaires') }}
                </a>

                <!-- Rapports -->
                <a href="{{ route('admin.reports.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.reports.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    {{ __('Nos rapports') }}
                </a>

                <!-- Blog Posts -->
                <a href="{{ route('admin.blog-posts.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.blog-posts.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    {{ __('Articles de blog') }}
                </a>

                <!-- Gallery Images -->
                <a href="{{ route('admin.gallery-images.index') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.gallery-images.*') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ __('Galerie') }}
                </a>

                <!-- Menu items can be added here -->
                <!-- Example:
                <a href="{{ route('example') }}" 
                   class="flex items-center px-4 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('example') ? 'bg-blue_green-50 text-blue_green-600' : 'text-deep_twilight-500 hover:bg-blue_green-50 hover:text-blue_green-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M..."></path>
                    </svg>
                    Example Menu
                </a>
                -->
            </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="border-t border-gray-200 p-4 flex-shrink-0">
            <div class="flex items-center px-4 py-2">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </div>
                <div class="ml-3 flex-1 min-w-0">
                    <p class="text-sm font-medium text-deep_twilight-500 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Sidebar Toggle Button (Mobile) -->
    <button @click="mobileOpen = !mobileOpen" 
            class="lg:hidden fixed bottom-4 right-4 z-40 p-3 bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white rounded-full shadow-lg hover:from-deep_twilight-600 hover:to-french_blue-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
</div>
