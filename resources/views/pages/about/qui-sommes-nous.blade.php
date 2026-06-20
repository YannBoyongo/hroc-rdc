@extends('layouts.ngo')

@section('title', 'Qui sommes-nous ? - HROC RDC')

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">Qui sommes-nous ?</h1>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                @if($company->about)
                    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {!! $company->about!!}
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Le contenu "À propos" n'est pas encore disponible.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
