@extends('layouts.ngo')

@section('title', 'Nos approches - HROC RDC')

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">Nos approches</h1>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($approaches->count() > 0)
                <div class="space-y-8">
                    @foreach($approaches as $index => $approach)
                        <div class="bg-gradient-to-r {{ $index % 2 === 0 ? 'from-blue_green-50 to-turquoise_surf-50' : 'from-sky_aqua-50 to-frosted_blue-50' }} p-8 rounded-lg shadow-md">
                            <div class="flex items-start gap-6">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 {{ $index % 2 === 0 ? 'bg-blue_green-500' : 'bg-sky_aqua-500' }} rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <p class="text-gray-700 leading-relaxed">{{ $approach->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Aucune approche disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
