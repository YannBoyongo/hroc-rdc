<x-app-layout>
    <x-slot name="header">
        {{ __('Ajouter une image à la galerie') }}
    </x-slot>

    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.gallery-images.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
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

                <!-- Image -->
                <div>
                    <x-input-label for="image" :value="__('Image')" />
                    <input id="image" 
                           type="file" 
                           name="image" 
                           accept="image/*"
                           class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue_green-50 file:text-blue_green-700 hover:file:bg-blue_green-100"
                           required />
                    <p class="mt-1 text-sm text-gray-500">Formats acceptés : JPG, PNG, GIF, WEBP (max 5MB)</p>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Caption -->
                <div>
                    <x-input-label for="caption" :value="__('Légende')" />
                    <textarea id="caption" 
                              name="caption" 
                              rows="3"
                              class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('caption') }}</textarea>
                    <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                </div>

                <!-- Order -->
                <div>
                    <x-input-label for="order" :value="__('Ordre d\'affichage')" />
                    <x-text-input id="order" 
                                 class="block mt-1 w-full" 
                                 type="number" 
                                 name="order" 
                                 :value="old('order', 0)" 
                                 min="0" />
                    <x-input-error :messages="$errors->get('order')" class="mt-2" />
                </div>

                <!-- Is Published -->
                <div class="flex items-center">
                    <input id="is_published" 
                           type="checkbox" 
                           name="is_published" 
                           value="1"
                           {{ old('is_published', true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue_green-600 shadow-sm focus:ring-blue_green-500">
                    <label for="is_published" class="ml-2 text-sm text-deep_twilight-500">
                        {{ __('Publier') }}
                    </label>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.gallery-images.index') }}" 
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
