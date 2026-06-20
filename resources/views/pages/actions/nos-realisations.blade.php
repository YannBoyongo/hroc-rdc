@extends('layouts.ngo')

@section('title', 'Nos réalisations - HROC RDC')

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">Nos réalisations</h1>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($realisations->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($realisations as $realisation)
                        <div class="bg-white border-2 border-blue_green-200 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:scale-105">
                            @if($realisation->image)
                                @php
                                    $imageUrl = str_starts_with($realisation->image, 'realisations/') 
                                        ? Storage::url($realisation->image) 
                                        : asset($realisation->image);
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $realisation->title }}" class="w-full h-64 object-cover">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-blue_green-100 to-turquoise_surf-100 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-blue_green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-deep_twilight-500">{{ $realisation->title }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    <p class="text-lg">Aucune réalisation disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
