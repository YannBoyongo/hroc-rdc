@extends('layouts.ngo')

@section('title', 'Donation - HROC RDC')

@section('content')
    <div class="bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold">Faire un don</h1>
        </div>
    </div>

    <section class="py-16 bg-white"
             x-data="{ animated: false }"
             x-intersect="animated = true">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Introduction -->
            <div class="text-center mb-12 transition-all duration-1000"
                 :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'">
                <h2 class="text-3xl md:text-4xl font-bold text-deep_twilight-500 mb-6">Votre soutien fait la différence</h2>
                <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto">
                    Chaque don contribue directement à nos programmes de consolidation de la paix, de promotion des droits de l'homme, 
                    et d'autonomisation des communautés en République Démocratique du Congo. Votre générosité nous permet de continuer 
                    à transformer des vies et à construire un avenir meilleur.
                </p>
            </div>

            <!-- Bank Details Card -->
            @php
                $settings = \App\Models\Settings::getInstance();
            @endphp
            @if($settings->bank_name || $settings->account_number || $settings->swift_bic_code || $settings->beneficiary)
            <div class="bg-gradient-to-br from-blue_green-50 to-turquoise_surf-50 rounded-2xl shadow-xl p-8 md:p-12 mb-12"
                 x-data="{ 
                     copied: false,
                     copyToClipboard(text, type) {
                         navigator.clipboard.writeText(text).then(() => {
                             this.copied = type;
                             setTimeout(() => this.copied = false, 2000);
                         });
                     }
                 }"
                 x-intersect="animated = true">
                <h3 class="text-2xl font-bold text-deep_twilight-500 mb-8 text-center">Coordonnées bancaires</h3>
                
                <div class="space-y-6">
                    @if($settings->bank_name)
                    <!-- Bank Name -->
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Nom de la banque</label>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-xl font-bold text-deep_twilight-500 flex-1" id="bank-name">{{ $settings->bank_name }}</span>
                            <button @click="copyToClipboard('{{ $settings->bank_name }}', 'bank')" 
                                    class="px-4 py-2 bg-blue_green-500 hover:bg-blue_green-600 text-white rounded-lg transition-all duration-300 hover:scale-105 flex items-center gap-2">
                                <svg x-show="copied !== 'bank'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <svg x-show="copied === 'bank'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span x-text="copied === 'bank' ? 'Copié!' : 'Copier'"></span>
                            </button>
                        </div>
                    </div>
                    @endif

                    @if($settings->account_number)
                    <!-- Account Number -->
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Numéro de compte</label>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-xl font-bold text-deep_twilight-500 flex-1 font-mono" id="account-number">{{ $settings->account_number }}</span>
                            <button @click="copyToClipboard('{{ $settings->account_number }}', 'account')" 
                                    class="px-4 py-2 bg-blue_green-500 hover:bg-blue_green-600 text-white rounded-lg transition-all duration-300 hover:scale-105 flex items-center gap-2">
                                <svg x-show="copied !== 'account'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <svg x-show="copied === 'account'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span x-text="copied === 'account' ? 'Copié!' : 'Copier'"></span>
                            </button>
                        </div>
                    </div>
                    @endif

                    @if($settings->swift_bic_code)
                    <!-- SWIFT Code -->
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Code SWIFT / BIC</label>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-xl font-bold text-deep_twilight-500 flex-1 font-mono" id="swift-code">{{ $settings->swift_bic_code }}</span>
                            <button @click="copyToClipboard('{{ $settings->swift_bic_code }}', 'swift')" 
                                    class="px-4 py-2 bg-blue_green-500 hover:bg-blue_green-600 text-white rounded-lg transition-all duration-300 hover:scale-105 flex items-center gap-2">
                                <svg x-show="copied !== 'swift'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <svg x-show="copied === 'swift'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span x-text="copied === 'swift' ? 'Copié!' : 'Copier'"></span>
                            </button>
                        </div>
                    </div>
                    @endif

                    @if($settings->beneficiary)
                    <!-- Beneficiary Name -->
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Bénéficiaire</label>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-xl font-bold text-deep_twilight-500 flex-1" id="beneficiary">{{ $settings->beneficiary }}</span>
                            <button @click="copyToClipboard('{{ $settings->beneficiary }}', 'beneficiary')" 
                                    class="px-4 py-2 bg-blue_green-500 hover:bg-blue_green-600 text-white rounded-lg transition-all duration-300 hover:scale-105 flex items-center gap-2">
                                <svg x-show="copied !== 'beneficiary'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <svg x-show="copied === 'beneficiary'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span x-text="copied === 'beneficiary' ? 'Copié!' : 'Copier'"></span>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Instructions -->
            <div class="bg-light_cyan-50 rounded-xl p-8 mb-12"
                 x-data="{ animated: false }"
                 x-intersect="animated = true">
                <div class="transition-all duration-1000"
                     :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'">
                    <h3 class="text-2xl font-bold text-deep_twilight-500 mb-6">Instructions pour le virement</h3>
                    <ol class="space-y-4 text-gray-700">
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-8 h-8 bg-blue_green-500 text-white rounded-full flex items-center justify-center font-bold">1</span>
                            <span>Utilisez les boutons "Copier" à côté de chaque information pour copier facilement les détails bancaires.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-8 h-8 bg-blue_green-500 text-white rounded-full flex items-center justify-center font-bold">2</span>
                            <span>Effectuez le virement depuis votre banque en utilisant les informations copiées.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-8 h-8 bg-blue_green-500 text-white rounded-full flex items-center justify-center font-bold">3</span>
                            <span>Pour les virements internationaux, utilisez le code SWIFT fourni.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-8 h-8 bg-blue_green-500 text-white rounded-full flex items-center justify-center font-bold">4</span>
                            <span>Après votre don, vous pouvez nous contacter à @if($settings->email)<a href="mailto:{{ $settings->email }}" class="text-blue_green-600 hover:text-blue_green-700 font-semibold">{{ $settings->email }}</a>@else <span class="text-blue_green-600 font-semibold">notre adresse e-mail</span>@endif pour recevoir un reçu.</span>
                        </li>
                    </ol>
                </div>
            </div>

            <!-- Thank You Message -->
            <div class="text-center bg-gradient-to-br from-blue_green-500 to-turquoise_surf-500 text-white rounded-xl p-8 md:p-12"
                 x-data="{ animated: false }"
                 x-intersect="animated = true">
                <div class="transition-all duration-1000"
                     :class="animated ? 'opacity-100 translate-y-0' : 'opacity-100 translate-y-8'">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <h3 class="text-2xl md:text-3xl font-bold mb-4">Merci pour votre générosité</h3>
                    <p class="text-lg text-light_cyan-100 max-w-2xl mx-auto">
                        Votre don nous permet de continuer notre mission de transformation des communautés en République Démocratique du Congo. 
                        Chaque contribution, grande ou petite, fait une différence significative dans la vie de ceux que nous servons.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

