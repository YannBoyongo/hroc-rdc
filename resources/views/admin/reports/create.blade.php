<x-app-layout>
    <x-slot name="header">
        {{ __('Créer un rapport') }}
    </x-slot>

    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.reports.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            @csrf

            <div class="p-6 space-y-6">
                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('Titre')" />
                    <x-text-input id="title" 
                                 class="block mt-1 w-full" 
                                 type="text" 
                                 name="title" 
                                 :value="old('title')" 
                                 required 
                                 autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Year -->
                <div>
                    <x-input-label for="year" :value="__('Année')" />
                    <x-text-input id="year" 
                                 class="block mt-1 w-full" 
                                 type="number" 
                                 name="year" 
                                 :value="old('year', date('Y'))" 
                                 min="2000"
                                 max="2100"
                                 required />
                    <x-input-error :messages="$errors->get('year')" class="mt-2" />
                </div>

                <!-- File -->
                <div>
                    <x-input-label for="file" :value="__('Fichier PDF')" />
                    <input id="file" 
                           class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm" 
                           type="file" 
                           name="file" 
                           accept="application/pdf"
                           required />
                    <p class="mt-1 text-sm text-gray-500">Format accepté: PDF. Taille maximale: 10MB</p>
                    <x-input-error :messages="$errors->get('file')" class="mt-2" />
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.reports.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    {{ __('Annuler') }}
                </a>
                <x-primary-button>
                    {{ __('Créer') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>

