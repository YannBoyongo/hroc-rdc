<nav class="bg-white text-deep_twilight-500 shadow-md sticky top-0 z-50" 
     x-data="{ 
         open: false, 
         aboutOpen: false, 
         actionsOpen: false, 
         searchOpen: false,
         currentLang: 'fr',
        getCurrentLanguage() {
            // Check if Google Translate cookie exists
            const cookieValue = document.cookie.match(/googtrans=([^;]+)/);
            if (cookieValue) {
                const parts = cookieValue[1].split('/');
                const langCode = parts[parts.length - 1];
                // Only return 'en' if explicitly 'en', otherwise default to 'fr'
                if (langCode === 'en') {
                    return 'en';
                }
            }
            return 'fr';
        },
         changeLanguage(lang) {
             const langMap = { 'fr': 'fr', 'en': 'en' };
             const targetLang = langMap[lang];
             this.currentLang = targetLang;
             
             // Use global helper function if available, otherwise use local implementation
             if (typeof window.triggerGoogleTranslate === 'function') {
                 window.triggerGoogleTranslate(targetLang);
             } else {
                 // Fallback implementation
                 document.cookie = `googtrans=/auto/${targetLang};path=/;max-age=31536000`;
                 
                 const findAndTriggerSelect = () => {
                     const selectElement = document.querySelector('#google_translate_element select');
                     if (selectElement && selectElement.options) {
                         const options = Array.from(selectElement.options);
                         let targetIndex = targetLang === 'fr' ? 0 : -1;
                         
                         if (targetIndex === -1) {
                             for (let i = 0; i < options.length; i++) {
                                 if (options[i].value && options[i].value.includes(targetLang)) {
                                     targetIndex = i;
                                     break;
                                 }
                             }
                         }
                         
                         if (targetIndex >= 0) {
                             selectElement.selectedIndex = targetIndex;
                             selectElement.dispatchEvent(new Event('change', { bubbles: true }));
                             return true;
                         }
                     }
                     return false;
                 };
                 
                 if (!findAndTriggerSelect()) {
                     setTimeout(() => {
                         if (!findAndTriggerSelect()) {
                             window.location.reload();
                         }
                     }, 300);
                 }
             }
         }
     }"
     x-init="
         // Initialize current language
         currentLang = getCurrentLanguage();
         
         // Update language display when Google Translate cookie changes
         const checkLanguage = () => {
             const newLang = getCurrentLanguage();
             if (newLang !== currentLang) {
                 currentLang = newLang;
             }
         };
         
         // Check periodically for cookie changes
         setInterval(checkLanguage, 1000);
         
         // Also check when page becomes visible
         document.addEventListener('visibilitychange', checkLanguage);
     ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="HROC RDC Logo" class="h-12 w-auto">
                    <span class="ml-3 text-xl font-bold text-deep_twilight-500">HROC RDC</span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                <a href="{{ route('home') }}" class="relative px-5 py-3 rounded-lg text-base font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-all duration-200 {{ request()->routeIs('home') ? 'text-blue_green-600' : '' }}">
                    <span class="relative z-10">Accueil</span>
                    @if(request()->routeIs('home'))
                        <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue_green-600 rounded-full"></span>
                    @endif
                </a>

                <!-- À propos Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="relative px-5 py-3 rounded-lg text-base font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-all duration-200 flex items-center {{ request()->routeIs('about.*') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">À propos</span>
                        @if(request()->routeIs('about.*'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue_green-600 rounded-full"></span>
                        @endif
                        <svg class="ml-1 h-5 w-5 transition-transform duration-200 relative z-10" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-100 z-50 overflow-hidden">
                        <div class="py-2">
                            <a href="{{ route('about.qui-sommes-nous') }}" class="relative block px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('about.qui-sommes-nous') ? 'text-blue_green-600' : '' }}">
                                <span class="relative z-10">Qui sommes-nous ?</span>
                                @if(request()->routeIs('about.qui-sommes-nous'))
                                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600"></span>
                                @endif
                            </a>
                            <a href="{{ route('about.notre-mission') }}" class="relative block px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('about.notre-mission') ? 'text-blue_green-600' : '' }}">
                                <span class="relative z-10">Notre mission</span>
                                @if(request()->routeIs('about.notre-mission'))
                                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600"></span>
                                @endif
                            </a>
                            <a href="{{ route('about.notre-vision') }}" class="relative block px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('about.notre-vision') ? 'text-blue_green-600' : '' }}">
                                <span class="relative z-10">Notre vision</span>
                                @if(request()->routeIs('about.notre-vision'))
                                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600"></span>
                                @endif
                            </a>
                            <a href="{{ route('about.nos-objectifs') }}" class="relative block px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('about.nos-objectifs') ? 'text-blue_green-600' : '' }}">
                                <span class="relative z-10">Nos objectifs</span>
                                @if(request()->routeIs('about.nos-objectifs'))
                                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600"></span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Nos actions Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="relative px-5 py-3 rounded-lg text-base font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-all duration-200 flex items-center {{ request()->routeIs('actions.*') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Nos actions</span>
                        @if(request()->routeIs('actions.*'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue_green-600 rounded-full"></span>
                        @endif
                        <svg class="ml-1 h-5 w-5 transition-transform duration-200 relative z-10" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-100 z-50 overflow-hidden">
                        <div class="py-2">
                            <a href="{{ route('actions.domaines-intervention') }}" class="relative block px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.domaines-intervention') ? 'text-blue_green-600' : '' }}">
                                <span class="relative z-10">Domaines d'intervention</span>
                                @if(request()->routeIs('actions.domaines-intervention'))
                                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600"></span>
                                @endif
                            </a>
                            <a href="{{ route('actions.nos-approches') }}" class="relative block px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.nos-approches') ? 'text-blue_green-600' : '' }}">
                                <span class="relative z-10">Nos approches</span>
                                @if(request()->routeIs('actions.nos-approches'))
                                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600"></span>
                                @endif
                            </a>
                            <a href="{{ route('actions.nos-realisations') }}" class="relative block px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.nos-realisations') ? 'text-blue_green-600' : '' }}">
                                <span class="relative z-10">Nos réalisations</span>
                                @if(request()->routeIs('actions.nos-realisations'))
                                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600"></span>
                                @endif
                            </a>
                            <a href="{{ route('actions.nos-rapports') }}" class="relative block px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.nos-rapports') ? 'text-blue_green-600' : '' }}">
                                <span class="relative z-10">Nos rapports</span>
                                @if(request()->routeIs('actions.nos-rapports'))
                                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600"></span>
                                @endif
                            </a>
                            <a href="{{ route('actions.gallery') }}" class="relative block px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.gallery') ? 'text-blue_green-600' : '' }}">
                                <span class="relative z-10">Galerie</span>
                                @if(request()->routeIs('actions.gallery'))
                                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600"></span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('blog') }}" class="relative px-5 py-3 rounded-lg text-base font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-all duration-200 {{ request()->routeIs('blog') ? 'text-blue_green-600' : '' }}">
                    <span class="relative z-10">Blog</span>
                    @if(request()->routeIs('blog'))
                        <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue_green-600 rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('contact') }}" class="relative px-5 py-3 rounded-lg text-base font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-all duration-200 {{ request()->routeIs('contact') ? 'text-blue_green-600' : '' }}">
                    <span class="relative z-10">Contact</span>
                    @if(request()->routeIs('contact'))
                        <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue_green-600 rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('donation') }}" class="relative px-5 py-3 rounded-lg text-base font-semibold bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 hover:from-deep_twilight-600 hover:to-french_blue-600 text-white transition-all duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span class="relative z-10">Donation</span>
                </a>

                <!-- Language Selector -->
                <div class="relative ml-4" x-data="{ langOpen: false }">
                    <button @click="langOpen = !langOpen" @click.away="langOpen = false" class="px-4 py-2 rounded-lg text-base font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-all duration-200 flex items-center gap-2">
                        <span x-text="currentLang === 'en' ? 'EN' : 'FR'">FR</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': langOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="langOpen" 
                         x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 translate-y-1" 
                         x-transition:enter-end="opacity-100 translate-y-0" 
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 translate-y-0" 
                         x-transition:leave-end="opacity-0 translate-y-1" 
                         class="absolute top-full right-0 mt-2 w-32 bg-white rounded-lg shadow-xl border border-gray-100 z-50 overflow-hidden">
                        <div class="py-2">
                            <button @click="changeLanguage('fr'); langOpen = false" 
                                    class="w-full text-left px-4 py-2 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium flex items-center justify-between"
                                    :class="{ 'text-blue_green-600 bg-blue_green-50': currentLang === 'fr' }">
                                <span>Français</span>
                                <svg x-show="currentLang === 'fr'" class="w-4 h-4 text-blue_green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button @click="changeLanguage('en'); langOpen = false" 
                                    class="w-full text-left px-4 py-2 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium flex items-center justify-between"
                                    :class="{ 'text-blue_green-600 bg-blue_green-50': currentLang === 'en' }">
                                <span>English</span>
                                <svg x-show="currentLang === 'en'" class="w-4 h-4 text-blue_green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Search Icon -->
                <button @click="searchOpen = true" class="ml-4 p-2 rounded-lg text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu button and search -->
            <div class="md:hidden flex items-center gap-2">
                <button @click="searchOpen = true" class="p-2 rounded-lg text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <button @click="open = !open" class="p-2 rounded-lg text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors">
                    <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition class="md:hidden bg-white border-t border-gray-200 shadow-lg">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="relative block px-4 py-3 rounded-lg text-lg font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors {{ request()->routeIs('home') ? 'text-blue_green-600' : '' }}">
                <span class="relative z-10">Accueil</span>
                @if(request()->routeIs('home'))
                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                @endif
            </a>

            <div>
                <button @click="aboutOpen = !aboutOpen" class="relative w-full text-left px-4 py-3 rounded-lg text-lg font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors flex items-center justify-between {{ request()->routeIs('about.*') ? 'text-blue_green-600' : '' }}">
                    <span class="relative z-10">À propos</span>
                    @if(request()->routeIs('about.*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                    @endif
                    <svg class="h-5 w-5 transition-transform duration-200 relative z-10" :class="{ 'rotate-180': aboutOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="aboutOpen" x-transition class="pl-4 space-y-1 mt-1">
                    <a href="{{ route('about.qui-sommes-nous') }}" class="relative block px-4 py-3 rounded-lg text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('about.qui-sommes-nous') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Qui sommes-nous ?</span>
                        @if(request()->routeIs('about.qui-sommes-nous'))
                            <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                        @endif
                    </a>
                    <a href="{{ route('about.notre-mission') }}" class="relative block px-4 py-3 rounded-lg text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('about.notre-mission') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Notre mission</span>
                        @if(request()->routeIs('about.notre-mission'))
                            <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                        @endif
                    </a>
                    <a href="{{ route('about.notre-vision') }}" class="relative block px-4 py-3 rounded-lg text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('about.notre-vision') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Notre vision</span>
                        @if(request()->routeIs('about.notre-vision'))
                            <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                        @endif
                    </a>
                    <a href="{{ route('about.nos-objectifs') }}" class="relative block px-4 py-3 rounded-lg text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('about.nos-objectifs') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Nos objectifs</span>
                        @if(request()->routeIs('about.nos-objectifs'))
                            <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                        @endif
                    </a>
                </div>
            </div>

            <div>
                <button @click="actionsOpen = !actionsOpen" class="relative w-full text-left px-4 py-3 rounded-lg text-lg font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors flex items-center justify-between {{ request()->routeIs('actions.*') ? 'text-blue_green-600' : '' }}">
                    <span class="relative z-10">Nos actions</span>
                    @if(request()->routeIs('actions.*'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                    @endif
                    <svg class="h-5 w-5 transition-transform duration-200 relative z-10" :class="{ 'rotate-180': actionsOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="actionsOpen" x-transition class="pl-4 space-y-1 mt-1">
                    <a href="{{ route('actions.domaines-intervention') }}" class="relative block px-4 py-3 rounded-lg text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.domaines-intervention') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Domaines d'intervention</span>
                        @if(request()->routeIs('actions.domaines-intervention'))
                            <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                        @endif
                    </a>
                    <a href="{{ route('actions.nos-approches') }}" class="relative block px-4 py-3 rounded-lg text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.nos-approches') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Nos approches</span>
                        @if(request()->routeIs('actions.nos-approches'))
                            <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                        @endif
                    </a>
                    <a href="{{ route('actions.nos-realisations') }}" class="relative block px-4 py-3 rounded-lg text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.nos-realisations') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Nos réalisations</span>
                        @if(request()->routeIs('actions.nos-realisations'))
                            <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                        @endif
                    </a>
                    <a href="{{ route('actions.nos-rapports') }}" class="relative block px-4 py-3 rounded-lg text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.nos-rapports') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Nos rapports</span>
                        @if(request()->routeIs('actions.nos-rapports'))
                            <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                        @endif
                    </a>
                    <a href="{{ route('actions.gallery') }}" class="relative block px-4 py-3 rounded-lg text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium {{ request()->routeIs('actions.gallery') ? 'text-blue_green-600' : '' }}">
                        <span class="relative z-10">Galerie</span>
                        @if(request()->routeIs('actions.gallery'))
                            <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                        @endif
                    </a>
                </div>
            </div>

            <a href="{{ route('blog') }}" class="relative block px-4 py-3 rounded-lg text-lg font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors {{ request()->routeIs('blog') ? 'text-blue_green-600' : '' }}">
                <span class="relative z-10">Blog</span>
                @if(request()->routeIs('blog'))
                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                @endif
            </a>

            <a href="{{ route('contact') }}" class="relative block px-4 py-3 rounded-lg text-lg font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors {{ request()->routeIs('contact') ? 'text-blue_green-600' : '' }}">
                <span class="relative z-10">Contact</span>
                @if(request()->routeIs('contact'))
                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-blue_green-600 rounded-r"></span>
                @endif
            </a>

            <a href="{{ route('donation') }}" class="relative block px-4 py-3 rounded-lg text-lg font-semibold bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 hover:from-deep_twilight-600 hover:to-french_blue-600 text-white transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <span class="relative z-10">Donation</span>
            </a>

            <!-- Language Selector Mobile -->
            <div class="relative" x-data="{ langOpen: false }">
                <button @click="langOpen = !langOpen" @click.away="langOpen = false" class="relative w-full block px-4 py-3 rounded-lg text-lg font-semibold text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-all duration-200 flex items-center justify-between">
                    <span x-text="currentLang === 'en' ? 'EN' : 'FR'">FR</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': langOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="langOpen" 
                     x-transition:enter="transition ease-out duration-200" 
                     x-transition:enter-start="opacity-0 translate-y-1" 
                     x-transition:enter-end="opacity-100 translate-y-0" 
                     x-transition:leave="transition ease-in duration-150" 
                     x-transition:leave-start="opacity-100 translate-y-0" 
                     x-transition:leave-end="opacity-0 translate-y-1" 
                     class="mt-2 w-full bg-white rounded-lg shadow-xl border border-gray-100 overflow-hidden">
                    <div class="py-2">
                        <button @click="changeLanguage('fr'); langOpen = false" 
                                class="w-full text-left px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium flex items-center justify-between"
                                :class="{ 'text-blue_green-600 bg-blue_green-50': currentLang === 'fr' }">
                            <span>Français</span>
                            <svg x-show="currentLang === 'fr'" class="w-4 h-4 text-blue_green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <button @click="changeLanguage('en'); langOpen = false" 
                                class="w-full text-left px-4 py-3 text-base text-deep_twilight-500 hover:text-blue_green-600 hover:bg-blue_green-50 transition-colors font-medium flex items-center justify-between"
                                :class="{ 'text-blue_green-600 bg-blue_green-50': currentLang === 'en' }">
                            <span>English</span>
                            <svg x-show="currentLang === 'en'" class="w-4 h-4 text-blue_green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div x-show="searchOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.away="searchOpen = false"
         @keydown.escape.window="searchOpen = false"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
        
        <!-- Modal -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-2xl transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all"
                 @click.stop>
                <!-- Close Button -->
                <button @click="searchOpen = false" class="absolute right-4 top-4 z-10 p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Search Content -->
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-deep_twilight-500 mb-6">Rechercher</h2>
                    <div class="relative">
                        <input type="text" 
                               placeholder="Tapez votre recherche..." 
                               class="w-full px-6 py-4 pl-14 text-lg border-2 border-gray-200 rounded-xl focus:border-blue_green-500 focus:ring-2 focus:ring-blue_green-200 outline-none transition-all"
                               autofocus>
                        <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p class="mt-4 text-sm text-gray-500">Recherchez dans nos pages, articles et contenus</p>
                </div>
            </div>
        </div>
    </div>
</nav>

