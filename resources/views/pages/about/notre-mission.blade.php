@extends('layouts.ngo')

@section('title', 'Notre mission - HROC RDC')

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">Notre mission</h1>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($company->mission)
                <div class="bg-gradient-to-br from-blue_green-50 to-turquoise_surf-50 p-8 md:p-12 rounded-lg shadow-lg">
                    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {!! $company->mission !!}
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Le contenu de la mission n'est pas encore disponible.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
