<div x-data="{ show: false }" 
     x-init="
         window.addEventListener('scroll', () => {
             show = window.scrollY > 300;
         });
     "
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 scale-75"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-75"
     @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
     class="fixed bottom-8 right-8 z-40 cursor-pointer group"
     style="display: none;">
    <div class="bg-gradient-to-br from-blue_green-500 to-turquoise_surf-500 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </div>
</div>

