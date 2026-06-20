@extends('layouts.ngo')

@section('title', 'Galerie - HROC RDC')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">Galerie</h1>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
                 x-data="{ animated: false }"
                 x-intersect="animated = true">
                @forelse($images as $index => $image)
                @php
                    $imageUrl = str_starts_with($image->image_path, 'gallery-images/') 
                        ? Storage::url($image->image_path) 
                        : asset($image->image_path);
                @endphp
                <a href="{{ $imageUrl }}" 
                   data-fancybox="gallery" 
                   data-caption="{{ $image->caption ?: $image->title }}"
                   class="block group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 hover:scale-105"
                   :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'"
                   style="transition-delay: {{ ($index % 10) * 0.1 }}s;">
                    <img src="{{ $imageUrl }}" 
                         alt="{{ $image->title }}" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                </a>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p>Aucune image disponible dans la galerie pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]", {
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: [],
                right: ["slideshow", "download", "thumbs", "close"],
            },
        },
    });
</script>
@endpush

