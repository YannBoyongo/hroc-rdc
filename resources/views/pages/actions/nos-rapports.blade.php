@extends('layouts.ngo')

@section('title', 'Nos rapports - HROC RDC')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Nos rapports</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Découvrez nos rapports annuels et documents de synthèse de nos activités
                </p>
            </div>
        </div>
    </section>

    <!-- Reports Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($reports->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($reports as $report)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue_green-100 text-blue_green-800">
                                        {{ $report->year }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-semibold text-deep_twilight-500 mb-3">
                                    {{ $report->title }}
                                </h3>
                                @if($report->filepath)
                                    <a href="{{ Storage::url($report->filepath) }}" 
                                       target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 hover:from-deep_twilight-600 hover:to-french_blue-600 text-white rounded-lg transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        Télécharger le PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun rapport disponible</h3>
                    <p class="mt-1 text-sm text-gray-500">Les rapports seront publiés prochainement.</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

@push('styles')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
@endpush

