@extends('layouts.ngo')

@section('title', ($post->title ?? 'Article') . ' - HROC RDC')

@php use Illuminate\Support\Facades\Storage; @endphp

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.css">
@endpush

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">{{ $post->title ?? 'Article' }}</h1>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(isset($post))
                @php
                    $hasGallery = !empty($post->images) && is_array($post->images);
                @endphp

                <div class="{{ $hasGallery ? 'lg:grid lg:grid-cols-12 lg:gap-10 lg:items-start' : 'max-w-4xl mx-auto' }}">
                    <!-- Main column -->
                    <div class="{{ $hasGallery ? 'lg:col-span-8' : '' }}">
                        <!-- Featured Image -->
                        @if($post->featured_image)
                        <div class="mb-8">
                            <img src="{{ str_starts_with($post->featured_image, 'blog-posts/') ? Storage::url($post->featured_image) : asset($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
                        </div>
                        @endif

                        <!-- Post Meta -->
                        <div class="flex items-center gap-4 text-sm text-gray-600 mb-6">
                            <span class="text-blue_green-600 font-semibold">
                                {{ $post->published_at ? $post->published_at->format('d F Y') : 'Non publié' }}
                            </span>
                            @if($post->author)
                                <span>Par {{ $post->author->name }}</span>
                            @endif
                        </div>

                        <!-- Post Content -->
                        <article>
                            <div class="prose prose-lg max-w-none prose-headings:text-deep_twilight-500 prose-a:text-blue_green-600 prose-a:no-underline hover:prose-a:underline text-gray-700">
                                {!! $post->content !!}
                            </div>
                        </article>
                    </div>

                    <!-- Gallery sidebar -->
                    @if($hasGallery)
                    <aside class="mt-12 lg:mt-0 lg:col-span-4">
                        <div class="lg:sticky lg:top-24 rounded-xl border border-gray-200 bg-gray-50 p-5 shadow-sm">
                            <h2 class="text-lg font-bold text-deep_twilight-500 mb-4">Galerie</h2>
                            <div class="space-y-3" id="post-gallery">
                                @foreach($post->images as $imgPath)
                                    @php
                                        $imgUrl = str_starts_with($imgPath, 'blog-posts/') ? Storage::url($imgPath) : asset($imgPath);
                                    @endphp
                                    <a href="{{ $imgUrl }}" data-fancybox="post-gallery" data-caption="{{ $post->title }}" class="block rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white focus:outline-none focus:ring-2 focus:ring-blue_green-500 focus:ring-offset-2">
                                        <img src="{{ $imgUrl }}" alt="{{ $post->title }}" class="w-full h-40 object-cover" loading="lazy">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                    @endif
                </div>

                <!-- Recent Posts -->
                <div class="{{ $hasGallery ? 'mt-16' : 'mt-16 max-w-4xl mx-auto' }}">
                @if(isset($recentPosts) && $recentPosts->count() > 0)
                <div class="border-t border-gray-200 pt-12">
                    <h2 class="text-2xl font-bold text-deep_twilight-500 mb-8">Articles récents</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($recentPosts as $recentPost)
                        <article class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                            @if($recentPost->featured_image)
                            <a href="{{ route('blog.post', $recentPost->slug) }}">
                                <img src="{{ str_starts_with($recentPost->featured_image, 'blog-posts/') ? Storage::url($recentPost->featured_image) : asset($recentPost->featured_image) }}" alt="{{ $recentPost->title }}" class="w-full h-48 object-cover">
                            </a>
                            @endif
                            <div class="p-4">
                                <div class="text-sm text-blue_green-600 font-semibold mb-2">
                                    {{ $recentPost->published_at ? $recentPost->published_at->format('d F Y') : '' }}
                                </div>
                                <h3 class="text-lg font-bold text-deep_twilight-500 mb-2">
                                    <a href="{{ route('blog.post', $recentPost->slug) }}" class="hover:text-blue_green-600 transition-colors">
                                        {{ $recentPost->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2">{{ $recentPost->excerpt }}</p>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
                @endif
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    <p>Article non trouvé.</p>
                    <a href="{{ route('blog') }}" class="text-blue_green-600 hover:underline mt-4 inline-block">
                        Retour au blog
                    </a>
                </div>
            @endif
        </div>
    </section>

    @if(isset($post) && !empty($post->images) && is_array($post->images))
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.umd.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Fancybox !== 'undefined') {
            Fancybox.bind('[data-fancybox="post-gallery"]');
        }
    });
    </script>
    @endpush
    @endif
@endsection
