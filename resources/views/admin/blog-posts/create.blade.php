<x-app-layout>
    <x-slot name="header">
        {{ __('Nouvel article de blog') }}
    </x-slot>

    @include('admin.blog-posts.partials.tinymce-content')

    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.blog-posts.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
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

                <!-- Slug -->
                <div>
                    <x-input-label for="slug" :value="__('Slug (URL)')" />
                    <x-text-input id="slug" 
                                 class="block mt-1 w-full" 
                                 type="text" 
                                 name="slug" 
                                 :value="old('slug')" 
                                 placeholder="auto-generé-si-vide" />
                    <p class="mt-1 text-sm text-gray-500">Laissé vide pour auto-génération à partir du titre</p>
                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                </div>

                <!-- Excerpt -->
                <div>
                    <x-input-label for="excerpt" :value="__('Résumé')" />
                    <textarea id="excerpt" 
                              name="excerpt" 
                              rows="3" 
                              required
                              class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('excerpt') }}</textarea>
                    <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
                </div>

                <!-- Content -->
                <div>
                    <x-input-label for="content" :value="__('Contenu')" />
                    <textarea id="content" 
                              name="content" 
                              rows="12" 
                              class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('content') }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <!-- Featured Image -->
                <div>
                    <x-input-label for="featured_image" :value="__('Image à la une')" />
                    <input id="featured_image" 
                           type="file" 
                           name="featured_image" 
                           accept="image/*"
                           class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue_green-50 file:text-blue_green-700 hover:file:bg-blue_green-100" />
                    <p class="mt-1 text-sm text-gray-500">Formats acceptés : JPG, PNG, GIF, WEBP (max 5MB)</p>
                    <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />
                </div>

                <!-- Post images (gallery) -->
                <div>
                    <x-input-label for="images" :value="__('Images de l\'article')" />
                    <input id="images" 
                           type="file" 
                           name="images[]" 
                           accept="image/*"
                           multiple
                           class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue_green-50 file:text-blue_green-700 hover:file:bg-blue_green-100" />
                    <p class="mt-1 text-sm text-gray-500">Vous pouvez sélectionner plusieurs images. JPG, PNG, GIF, WEBP (max 5MB chacune).</p>
                    <x-input-error :messages="$errors->get('images.*')" class="mt-2" />
                </div>

                <!-- Is Published -->
                <div class="flex items-center">
                    <input id="is_published" 
                           type="checkbox" 
                           name="is_published" 
                           value="1"
                           {{ old('is_published') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue_green-600 shadow-sm focus:ring-blue_green-500">
                    <label for="is_published" class="ml-2 text-sm text-deep_twilight-500">
                        {{ __('Publier immédiatement') }}
                    </label>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.blog-posts.index') }}" 
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
