<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="space-y-8">
        {{-- Welcome card --}}
        <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-white">
                            {{ __('Bienvenue, :name', ['name' => Auth::user()->name]) }}
                        </h2>
                        <p class="mt-2 text-blue-100 text-sm sm:text-base">
                            {{ __("Panneau d'administration HROC RDC. Gérez le contenu du site depuis ici.") }}
                        </p>
                    </div>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center px-4 py-2.5 bg-white/20 hover:bg-white/30 text-white rounded-lg font-medium transition-colors border border-white/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        {{ __('Voir le site') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Stats grid --}}
        <div>
            <h3 class="text-lg font-semibold text-deep_twilight-500 mb-4">{{ __('Contenu en un coup d\'œil') }}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                <a href="{{ route('admin.blog-posts.index') }}"
                   class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md hover:border-blue_green-200 transition-all group">
                    <div class="flex items-start justify-between">
                        <div class="flex-shrink-0 w-11 h-11 rounded-lg bg-blue_green-100 flex items-center justify-center group-hover:bg-blue_green-200 transition-colors">
                            <svg class="w-6 h-6 text-blue_green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-deep_twilight-500">{{ $stats['blog_posts'] }}</span>
                    </div>
                    <p class="mt-3 text-sm font-medium text-gray-600">{{ __('Articles de blog') }}</p>
                    <p class="mt-0.5 text-xs text-gray-500">{{ $stats['blog_posts_published'] }} publiés</p>
                </a>

                <a href="{{ route('admin.realisations.index') }}"
                   class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md hover:border-blue_green-200 transition-all group">
                    <div class="flex items-start justify-between">
                        <div class="flex-shrink-0 w-11 h-11 rounded-lg bg-turquoise_surf-100 flex items-center justify-center group-hover:bg-turquoise_surf-200 transition-colors">
                            <svg class="w-6 h-6 text-turquoise_surf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-deep_twilight-500">{{ $stats['realisations'] }}</span>
                    </div>
                    <p class="mt-3 text-sm font-medium text-gray-600">{{ __('Réalisations') }}</p>
                </a>

                <a href="{{ route('admin.gallery-images.index') }}"
                   class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md hover:border-blue_green-200 transition-all group">
                    <div class="flex items-start justify-between">
                        <div class="flex-shrink-0 w-11 h-11 rounded-lg bg-french_blue-100 flex items-center justify-center group-hover:bg-french_blue-200 transition-colors">
                            <svg class="w-6 h-6 text-french_blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-deep_twilight-500">{{ $stats['gallery_images'] }}</span>
                    </div>
                    <p class="mt-3 text-sm font-medium text-gray-600">{{ __('Galerie') }}</p>
                </a>

                <a href="{{ route('admin.sliders.index') }}"
                   class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md hover:border-blue_green-200 transition-all group">
                    <div class="flex items-start justify-between">
                        <div class="flex-shrink-0 w-11 h-11 rounded-lg bg-amber-100 flex items-center justify-center group-hover:bg-amber-200 transition-colors">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-deep_twilight-500">{{ $stats['sliders'] }}</span>
                    </div>
                    <p class="mt-3 text-sm font-medium text-gray-600">{{ __('Sliders') }}</p>
                </a>

                <a href="{{ route('admin.partners.index') }}"
                   class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md hover:border-blue_green-200 transition-all group">
                    <div class="flex items-start justify-between">
                        <div class="flex-shrink-0 w-11 h-11 rounded-lg bg-emerald-100 flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-deep_twilight-500">{{ $stats['partners'] }}</span>
                    </div>
                    <p class="mt-3 text-sm font-medium text-gray-600">{{ __('Partenaires') }}</p>
                </a>

                <a href="{{ route('admin.reports.index') }}"
                   class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md hover:border-blue_green-200 transition-all group">
                    <div class="flex items-start justify-between">
                        <div class="flex-shrink-0 w-11 h-11 rounded-lg bg-violet-100 flex items-center justify-center group-hover:bg-violet-200 transition-colors">
                            <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-deep_twilight-500">{{ $stats['reports'] }}</span>
                    </div>
                    <p class="mt-3 text-sm font-medium text-gray-600">{{ __('Rapports') }}</p>
                </a>
            </div>
        </div>

        {{-- Quick actions + Recent posts --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Quick actions --}}
            <div class="lg:col-span-1 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base font-semibold text-deep_twilight-500">{{ __('Actions rapides') }}</h3>
                </div>
                <div class="p-4 space-y-2">
                    <a href="{{ route('admin.blog-posts.create') }}"
                       class="flex items-center px-4 py-3 rounded-lg border border-gray-200 hover:border-blue_green-300 hover:bg-blue_green-50 transition-colors group">
                        <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-blue_green-100 flex items-center justify-center group-hover:bg-blue_green-200">
                            <svg class="w-5 h-5 text-blue_green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                        <span class="ml-3 text-sm font-medium text-deep_twilight-500">{{ __('Nouvel article de blog') }}</span>
                    </a>
                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center px-4 py-3 rounded-lg border border-gray-200 hover:border-blue_green-300 hover:bg-blue_green-50 transition-colors group">
                        <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-gray-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <span class="ml-3 text-sm font-medium text-deep_twilight-500">{{ __('Mon profil') }}</span>
                    </a>
                    <a href="{{ route('settings.index') }}"
                       class="flex items-center px-4 py-3 rounded-lg border border-gray-200 hover:border-blue_green-300 hover:bg-blue_green-50 transition-colors group">
                        <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-gray-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </span>
                        <span class="ml-3 text-sm font-medium text-deep_twilight-500">{{ __('Paramètres') }}</span>
                    </a>
                </div>
            </div>

            {{-- Recent blog posts --}}
            <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gray-50">
                    <h3 class="text-base font-semibold text-deep_twilight-500">{{ __('Articles récents') }}</h3>
                    <a href="{{ route('admin.blog-posts.index') }}" class="text-sm font-medium text-blue_green-600 hover:text-blue_green-700">
                        {{ __('Tous les articles') }}
                    </a>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($recentPosts as $post)
                        <a href="{{ route('admin.blog-posts.edit', $post) }}" class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors">
                            @if($post->featured_image)
                                @php
                                    $imgUrl = str_starts_with($post->featured_image, 'blog-posts/') ? \Illuminate\Support\Facades\Storage::url($post->featured_image) : asset($post->featured_image);
                                @endphp
                                <img src="{{ $imgUrl }}" alt="" class="w-14 h-14 rounded-lg object-cover flex-shrink-0">
                            @else
                                <div class="w-14 h-14 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-deep_twilight-500 truncate">{{ $post->title }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    {{ $post->published_at ? $post->published_at->format('d/m/Y') : __('Brouillon') }}
                                    @if($post->author)
                                        · {{ $post->author->name }}
                                    @endif
                                </p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @empty
                        <div class="px-6 py-8 text-center text-gray-500">
                            <p>{{ __('Aucun article pour le moment.') }}</p>
                            <a href="{{ route('admin.blog-posts.create') }}" class="mt-2 inline-block text-sm font-medium text-blue_green-600 hover:text-blue_green-700">
                                {{ __('Créer le premier article') }}
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
