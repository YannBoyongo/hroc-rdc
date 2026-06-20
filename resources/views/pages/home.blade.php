@extends('layouts.ngo')

@section('title', 'Accueil - HROC RDC')

@section('content')
    <!-- Carousel -->
    <x-carousel :sliders="$sliders" />

    <!-- Introduction Section -->
    <section class="py-16 bg-light_cyan-50" 
             x-data="{ animated: false }"
             x-intersect="animated = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto transition-all duration-1000 ease-out"
                 :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'">
                <h2 class="text-3xl md:text-4xl font-bold text-deep_twilight-500 mb-6">Bienvenue chez HROC RDC</h2>
                @if($company->intro)
                    <div class="text-lg text-gray-700 leading-relaxed prose prose-lg max-w-none">
                        {!! $company->intro !!}
                    </div>
                @else
                <p class="text-lg text-gray-700 leading-relaxed">
                    Healing and Rebuilding Our Communities (HROC RDC) œuvre dans les domaines de la consolidation de la paix, 
                    la promotion des droits de l'homme, le leadership et la bonne gouvernance, la résilience et l'engagement communautaire, 
                    ainsi que l'autonomisation des agents de changement actifs et des populations vulnérables (jeunes, femmes, ex-combattants, 
                    réfugiés et personnes déplacées, et enfants), dans le but de contribuer à la reconstruction de la paix et au développement 
                    durable en République Démocratique du Congo.
                </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Approaches Section -->
    @if($approaches->count() > 0)
    <section class="py-16 bg-white"
             x-data="{ animated: false }"
             x-intersect="animated = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-deep_twilight-500 mb-12 transition-all duration-1000 ease-out"
                :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'">Nos approches</h2>
            <div class="space-y-8">
                @foreach($approaches as $index => $approach)
                    <div class="bg-gradient-to-r {{ $index % 2 === 0 ? 'from-blue_green-50 to-turquoise_surf-50' : 'from-sky_aqua-50 to-frosted_blue-50' }} p-8 rounded-lg shadow-md transition-all duration-1000 ease-out"
                     :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-12'"
                         style="transition-delay: {{ $index * 0.1 }}s;">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 {{ $index % 2 === 0 ? 'bg-blue_green-500' : 'bg-sky_aqua-500' }} rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                            <div class="flex-grow">
                                <p class="text-gray-700 leading-relaxed">
                                    {!! nl2br(e($approach->name)) !!}
                                </p>
                </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Impact Highlights Section -->
    <section class="py-16 bg-gradient-to-br from-french_blue-500 to-bright_teal_blue-500 text-white"
             x-data="{ animated: false }"
             x-intersect="animated = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 transition-all duration-1000 ease-out"
                :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'">Notre impact</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="transition-all duration-1000 ease-out"
                     :class="animated ? 'opacity-100 scale-100' : 'opacity-100 scale-90'"
                     style="transition-delay: 0.1s;">
                    <div class="text-5xl font-bold mb-2">500+</div>
                    <div class="text-lg">Communautés touchées</div>
                </div>
                <div class="transition-all duration-1000 ease-out"
                     :class="animated ? 'opacity-100 scale-100' : 'opacity-100 scale-90'"
                     style="transition-delay: 0.2s;">
                    <div class="text-5xl font-bold mb-2">10,000+</div>
                    <div class="text-lg">Bénéficiaires directs</div>
                </div>
                <div class="transition-all duration-1000 ease-out"
                     :class="animated ? 'opacity-100 scale-100' : 'opacity-100 scale-90'"
                     style="transition-delay: 0.3s;">
                    <div class="text-5xl font-bold mb-2">50+</div>
                    <div class="text-lg">Projets réalisés</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Blog Section -->
    @if($blogPosts->count() > 0)
    <section class="py-16 bg-light_cyan-50"
             x-data="{ animated: false }"
             x-intersect="animated = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-deep_twilight-500 transition-all duration-1000 ease-out"
                    :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'">Articles récents</h2>
                <a href="{{ route('blog') }}" 
                   class="text-blue_green-600 hover:text-blue_green-700 font-semibold transition-colors flex items-center gap-2">
                    Voir tout
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($blogPosts as $index => $post)
                <article class="bg-white border-2 border-gray-200 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:scale-105"
                         :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-12'"
                             style="transition-delay: {{ $index * 0.1 }}s;">
                        <a href="{{ route('blog.post', $post->slug) }}" class="block">
                            @if($post->featured_image)
                                @if(str_starts_with($post->featured_image, 'blog-posts/'))
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                                @else
                                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                                @endif
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue_green-100 to-turquoise_surf-100 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-blue_green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                    </a>
                    <div class="p-6">
                            <div class="text-sm text-blue_green-600 font-semibold mb-2">
                                {{ $post->published_at ? $post->published_at->format('d F Y') : $post->created_at->format('d F Y') }}
                            </div>
                        <h3 class="text-xl font-bold text-deep_twilight-500 mb-3">
                                <a href="{{ route('blog.post', $post->slug) }}" class="hover:text-blue_green-600 transition-colors">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-700 mb-4 line-clamp-2">
                                {{ Str::limit(strip_tags($post->excerpt), 120) }}
                        </p>
                            <a href="{{ route('blog.post', $post->slug) }}" class="inline-flex items-center text-blue_green-600 hover:text-blue_green-700 font-semibold transition-colors">
                            Lire la suite
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Partners Section -->
    @if($partners->count() > 0)
    <section class="py-16 bg-white"
             x-data="{ animated: false }"
             x-intersect="animated = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-deep_twilight-500 mb-12 transition-all duration-1000 ease-out"
                :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'">Nos partenaires</h2>
            <div class="relative" x-data="partnersCarousel()" x-init="init()" @mouseenter="stopAutoPlay()" @mouseleave="startAutoPlay()">
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-1000 ease-linear" 
                         :style="'transform: translateX(-' + (currentIndex * 100) + '%)'">
                        @php
                            $chunks = $partners->chunk(4);
                            // Duplicate chunks for infinite scroll - use values() to reset keys
                            $allChunks = $chunks->concat($chunks)->values();
                        @endphp
                        @foreach($allChunks as $chunk)
                            <div class="min-w-full flex gap-8 justify-center items-center px-4">
                                @foreach($chunk as $partner)
                                    <div class="flex-shrink-0 w-1/4 flex items-center justify-center p-4">
                                        @if($partner->image)
                                            <img src="{{ Storage::url($partner->image) }}" 
                                                 alt="{{ $partner->title }}" 
                                                 class="max-h-24 max-w-full object-contain grayscale hover:grayscale-0 transition-all duration-300">
                                        @endif
                                    </div>
                                @endforeach
                                @if($chunk->count() < 4)
                                    @for($i = 0; $i < (4 - $chunk->count()); $i++)
                                        <div class="flex-shrink-0 w-1/4"></div>
                                    @endfor
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Call to Action Section -->
    <section class="relative py-24 bg-cover bg-center bg-no-repeat"
             style="background-image: url('{{ asset('images/image-5.jpg') }}');"
             x-data="{ animated: false }"
             x-intersect="animated = true">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-deep_twilight-500/90 to-french_blue-500/90"></div>
        
        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center transition-all duration-1000 ease-out"
                 :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-12'">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Rejoignez-nous dans notre mission
                </h2>
                <p class="text-xl text-white mb-8 leading-relaxed">
                    Ensemble, nous pouvons construire un avenir meilleur pour les communautés de la République Démocratique du Congo. 
                    Votre soutien fait la différence.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-blue_green-500 hover:bg-blue_green-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <span>Nous contacter</span>
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="{{ route('actions.nos-realisations') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-semibold rounded-lg border-2 border-white/30 hover:border-white/50 transition-all duration-300 transform hover:scale-105">
                        <span>Découvrir nos réalisations</span>
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
function partnersCarousel() {
    return {
        currentIndex: 0,
        totalSlides: {{ ceil($partners->count() / 4) }},
        interval: null,
        init() {
            if (this.totalSlides > 1) {
                this.startAutoPlay();
            }
        },
        startAutoPlay() {
            this.interval = setInterval(() => {
                this.next();
            }, 3000);
        },
        stopAutoPlay() {
            if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
            }
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
            // Reset to beginning for infinite scroll effect
            if (this.currentIndex === 0) {
                setTimeout(() => {
                    this.currentIndex = 0;
                }, 50);
            }
        },
        previous() {
            this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
        }
    }
}
</script>
@endpush
