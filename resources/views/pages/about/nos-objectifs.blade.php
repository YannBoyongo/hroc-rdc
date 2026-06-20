@extends('layouts.ngo')

@section('title', 'Nos objectifs - HROC RDC')

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">Nos objectifs</h1>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($objectives->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($objectives as $index => $objective)
                        <div class="bg-gradient-to-br from-blue_green-50 to-turquoise_surf-50 p-6 rounded-lg shadow-md">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-blue_green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-xl">{{ $loop->iteration }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-deep_twilight-500">{{ $objective->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Aucun objectif disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
