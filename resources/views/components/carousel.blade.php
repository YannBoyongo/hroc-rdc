@props(['sliders'])
@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="relative w-full h-[500px] md:h-[600px] overflow-hidden" x-data="carousel()" x-init="init()">
    @if($sliders->count() > 0)
        <!-- Images -->
        <div class="relative w-full h-full">
            @foreach($sliders as $index => $slider)
                <div x-show="activeSlide === {{ $index }}" 
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 scale-110"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-700"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="absolute inset-0">
                    <img src="{{ Storage::url($slider->image) }}" 
                         alt="{{ $slider->title }}" 
                         class="w-full h-full object-cover"
                         :style="activeSlide === {{ $index }} ? 'animation: kenBurns 15s ease-in-out infinite alternate;' : ''">
                    <div class="absolute inset-0 bg-gradient-to-r from-deep_twilight-500/80 to-transparent"></div>
                    @if($slider->title)
                        <div class="absolute bottom-20 left-8 md:left-16 text-white">
                            <h2 class="text-3xl md:text-5xl font-bold mb-2">{{ $slider->title }}</h2>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        @if($sliders->count() > 1)
            <button @click="previous()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm hover:scale-110 active:scale-95 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm hover:scale-110 active:scale-95 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Indicators -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                @foreach($sliders as $index => $slider)
                    <button @click="goToSlide({{ $index }})" 
                            :class="activeSlide === {{ $index }} ? 'bg-white w-8' : 'bg-white/50 w-3'"
                            class="h-3 rounded-full transition-all duration-300 hover:bg-white/80 hover:scale-110"></button>
                @endforeach
            </div>
        @endif
    @else
        <!-- Default placeholder if no sliders -->
        <div class="w-full h-full bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 flex items-center justify-center">
            <div class="text-white text-center">
                <h2 class="text-4xl font-bold mb-4">HROC RDC</h2>
                <p class="text-xl">Healing and Rebuilding Our Communities</p>
            </div>
        </div>
    @endif
</div>

<style>
@keyframes kenBurns {
    0% {
        transform: scale(1) translate(0, 0);
    }
    100% {
        transform: scale(1.1) translate(-2%, -2%);
    }
}
</style>

<script>
function carousel() {
    return {
        activeSlide: 0,
        totalSlides: {{ $sliders->count() }},
        interval: null,
        init() {
            if (this.totalSlides > 1) {
                this.startAutoPlay();
            }
        },
        startAutoPlay() {
            if (this.totalSlides > 1) {
                this.interval = setInterval(() => {
                    this.next();
                }, 5000);
            }
        },
        stopAutoPlay() {
            if (this.interval) {
                clearInterval(this.interval);
            }
        },
        next() {
            if (this.totalSlides > 0) {
                this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
            }
        },
        previous() {
            if (this.totalSlides > 0) {
                this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
            }
        },
        goToSlide(index) {
            this.activeSlide = index;
        }
    }
}
</script>
