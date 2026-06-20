<x-app-layout>
    <x-slot name="header">
        {{ __('Modifier le partenaire') }}
    </x-slot>

    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            @csrf
            @method('PATCH')

            <div class="p-6 space-y-6">
                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('Titre')" />
                    <x-text-input id="title" 
                                 class="block mt-1 w-full" 
                                 type="text" 
                                 name="title" 
                                 :value="old('title', $partner->title)" 
                                 required 
                                 autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Image -->
                <div>
                    <x-input-label for="image" :value="__('Image')" />
                    @if($partner->image)
                        <div class="mt-2 mb-4">
                            <img src="{{ Storage::url($partner->image) }}" alt="{{ $partner->title }}" class="h-32 w-auto rounded">
                        </div>
                    @endif
                    <input id="image" 
                           class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm" 
                           type="file" 
                           name="image" 
                           accept="image/jpeg,image/png,image/jpg,image/gif" />
                    <p class="mt-1 text-sm text-gray-500">Formats acceptés: JPEG, PNG, JPG, GIF. Taille maximale: 2MB. Laissez vide pour conserver l'image actuelle.</p>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.partners.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    {{ __('Annuler') }}
                </a>
                <x-primary-button>
                    {{ __('Mettre à jour') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>

