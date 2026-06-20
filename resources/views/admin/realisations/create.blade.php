<x-app-layout>
    <x-slot name="header">
        {{ __('Créer une réalisation') }}
    </x-slot>

    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.realisations.store') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
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
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.realisations.index') }}" 
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
