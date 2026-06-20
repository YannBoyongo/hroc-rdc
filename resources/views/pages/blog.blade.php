@extends('layouts.ngo')

@section('title', 'Blog - HROC RDC')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">Blog</h1>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $index => $post)
                <article class="bg-white border-2 border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col"
                         x-data="{ animated: false }"
                         x-intersect="animated = true">
                    <div class="transition-all duration-700 flex flex-col flex-1"
                         style="transition-delay: {{ $index * 0.1 }}s;"
                         :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'">
                        <a href="{{ route('blog.post', $post->slug) }}" class="block aspect-[16/10] bg-gray-100 overflow-hidden rounded-t-lg">
                            @if($post->featured_image)
                                <img src="{{ str_starts_with($post->featured_image, 'blog-posts/') ? Storage::url($post->featured_image) : asset($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover object-center" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>
                        <div class="p-6 pt-5 pb-6 flex flex-col flex-1 min-h-0">
                            <div class="text-sm text-blue_green-600 font-semibold mb-2">
                                {{ $post->published_at ? $post->published_at->format('d F Y') : '' }}
                            </div>
                            <h3 class="text-xl font-bold text-deep_twilight-500 mb-3 line-clamp-2">
                                <a href="{{ route('blog.post', $post->slug) }}" class="hover:text-blue_green-600 transition-colors">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-700 mb-5 line-clamp-3 flex-grow min-h-0">
                                {{ $post->excerpt }}
                            </p>
                            <a href="{{ route('blog.post', $post->slug) }}" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-5 py-3 rounded-lg font-semibold text-white bg-blue_green-600 hover:bg-blue_green-700 focus:ring-2 focus:ring-blue_green-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md flex-shrink-0 mt-auto">
                                Lire la suite
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p>Aucun article de blog disponible pour le moment.</p>
                </div>
                @endforelse
            </div>

            @if($posts->hasPages())
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
            @endif
        </div>
    </section>
@endsection

