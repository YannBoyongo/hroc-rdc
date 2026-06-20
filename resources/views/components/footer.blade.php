@php
    $settings = \App\Models\Settings::getInstance();
@endphp
<footer class="bg-deep_twilight-500 text-white mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <h3 class="text-lg font-bold mb-4">HROC RDC</h3>
                <p class="text-light_cyan-500 text-sm">
                    {{ $settings->description ?? 'Healing and Rebuilding Our Communities - Organisation œuvrant pour la paix, les droits de l\'homme, la gouvernance et le développement durable en République Démocratique du Congo.' }}
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold mb-4">Liens rapides</h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-light_cyan-500 hover:text-white transition-all duration-300 hover:translate-x-2 group">
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.qui-sommes-nous') }}" class="inline-flex items-center gap-2 text-light_cyan-500 hover:text-white transition-all duration-300 hover:translate-x-2 group">
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Qui sommes-nous ?</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('actions.domaines-intervention') }}" class="inline-flex items-center gap-2 text-light_cyan-500 hover:text-white transition-all duration-300 hover:translate-x-2 group">
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Domaines d'intervention</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-light_cyan-500 hover:text-white transition-all duration-300 hover:translate-x-2 group">
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Contact</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-bold mb-4">Contact</h3>
                <ul class="space-y-3 text-sm text-light_cyan-500">
                    @if($settings->address)
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue_green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>{{ $settings->address }}</span>
                    </li>
                    @endif
                    @if($settings->email)
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue_green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <a href="mailto:{{ $settings->email }}" class="hover:text-white transition-colors duration-300">{{ $settings->email }}</a>
                    </li>
                    @endif
                    @if($settings->phone && is_array($settings->phone) && !empty($settings->phone))
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue_green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <a href="tel:{{ str_replace(' ', '', $settings->phone[0]) }}" class="hover:text-white transition-colors duration-300">{{ $settings->phone[0] }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="border-t border-french_blue-500 mt-8 pt-8">
            <div class="flex flex-col items-center gap-4">
                <h3 class="text-lg font-bold mb-2">Suivez-nous</h3>
                <div class="flex flex-wrap justify-center gap-4">
                    @if($settings->facebook)
                    <!-- Facebook -->
                    <a href="{{ $settings->facebook }}" target="_blank" rel="noopener noreferrer" 
                       class="w-12 h-12 bg-white/10 hover:bg-blue-600 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg group">
                        <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    @endif

                    @if($settings->linkedin)
                    <!-- LinkedIn -->
                    <a href="{{ $settings->linkedin }}" target="_blank" rel="noopener noreferrer" 
                       class="w-12 h-12 bg-white/10 hover:bg-blue-700 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg group">
                        <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    @endif

                    @if($settings->x)
                    <!-- X (Twitter) -->
                    <a href="{{ $settings->x }}" target="_blank" rel="noopener noreferrer" 
                       class="w-12 h-12 bg-white/10 hover:bg-black rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg group">
                        <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    @endif

                    @if($settings->youtube)
                    <!-- YouTube -->
                    <a href="{{ $settings->youtube }}" target="_blank" rel="noopener noreferrer" 
                       class="w-12 h-12 bg-white/10 hover:bg-red-600 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg group">
                        <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    @endif

                    @if($settings->tiktok)
                    <!-- TikTok -->
                    <a href="{{ $settings->tiktok }}" target="_blank" rel="noopener noreferrer" 
                       class="w-12 h-12 bg-white/10 hover:bg-black rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg group">
                        <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="border-t border-french_blue-500 mt-8 pt-8 text-center text-sm text-light_cyan-500">
            <p>&copy; {{ date('Y') }} HROC RDC. Tous droits réservés.</p>
        </div>
    </div>
</footer>

