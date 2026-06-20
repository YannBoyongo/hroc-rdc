@extends('layouts.ngo')

@section('title', 'Notre vision - HROC RDC')

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">Notre vision</h1>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                @if($company->vision)
                    <div class="bg-gradient-to-br from-sky_aqua-50 to-frosted_blue-50 p-8 md:p-12 rounded-lg shadow-lg mb-8">
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                            {!! $company->vision !!}
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Le contenu de la vision n'est pas encore disponible.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
