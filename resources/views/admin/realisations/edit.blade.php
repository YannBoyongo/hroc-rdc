<x-app-layout>
    <x-slot name="header">
        {{ __('Modifier la réalisation') }}
    </x-slot>

    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.realisations.update', $realisation) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
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
                                 :value="old('title', $realisation->title)" 
                                 required 
                                 autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" 
                              name="description" 
                              rows="6" 
                              required
                              class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('description', $realisation->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Image -->
                <div>
                    <x-input-label for="image" :value="__('Image')" />
                    @if($realisation->image)
                        <div class="mt-2 mb-4">
                            <img src="{{ Storage::url($realisation->image) }}" alt="Preview" class="h-32 w-auto rounded">
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

                <!-- Tags -->
                <div>
                    <x-input-label for="tags" :value="__('Tags')" />
                    <div id="tags-container" class="space-y-2 mt-1">
                        @if(old('tags', $realisation->tags))
                            @foreach(old('tags', $realisation->tags ?? []) as $index => $tag)
                                <div class="flex gap-2 tag-input-group">
                                    <x-text-input type="text" 
                                                 name="tags[]" 
                                                 class="flex-1" 
                                                 :value="$tag" 
                                                 placeholder="Tag" />
                                    <button type="button" 
                                            class="px-3 py-2 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors remove-tag"
                                            @if($loop->first) style="display: none;" @endif>
                                        {{ __('Supprimer') }}
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-2 tag-input-group">
                                <x-text-input type="text" 
                                             name="tags[]" 
                                             class="flex-1" 
                                             value="" 
                                             placeholder="Tag" />
                                <button type="button" 
                                        class="px-3 py-2 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors remove-tag"
                                        style="display: none;">
                                    {{ __('Supprimer') }}
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" 
                            id="add-tag" 
                            class="mt-2 text-sm text-blue_green-600 hover:text-blue_green-800 font-medium">
                        + {{ __('Ajouter un tag') }}
                    </button>
                    <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                </div>

                <!-- Order -->
                <div>
                    <x-input-label for="order" :value="__('Ordre d\'affichage')" />
                    <x-text-input id="order" 
                                 class="block mt-1 w-full" 
                                 type="number" 
                                 name="order" 
                                 :value="old('order', $realisation->order)" 
                                 min="0" />
                    <x-input-error :messages="$errors->get('order')" class="mt-2" />
                </div>

                <!-- Is Published -->
                <div class="flex items-center">
                    <input id="is_published" 
                           type="checkbox" 
                           name="is_published" 
                           value="1"
                           {{ old('is_published', $realisation->is_published) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue_green-600 shadow-sm focus:ring-blue_green-500">
                    <label for="is_published" class="ml-2 text-sm text-deep_twilight-500">
                        {{ __('Publier') }}
                    </label>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.realisations.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    {{ __('Annuler') }}
                </a>
                <x-primary-button>
                    {{ __('Mettre à jour') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tags management
            const tagsContainer = document.getElementById('tags-container');
            const addTagBtn = document.getElementById('add-tag');

            addTagBtn.addEventListener('click', function() {
                const tagGroup = document.createElement('div');
                tagGroup.className = 'flex gap-2 tag-input-group';
                tagGroup.innerHTML = `
                    <input type="text" 
                           name="tags[]" 
                           class="block w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm" 
                           placeholder="Tag" />
                    <button type="button" 
                            class="px-3 py-2 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors remove-tag">
                        {{ __('Supprimer') }}
                    </button>
                `;
                tagsContainer.appendChild(tagGroup);
                updateRemoveButtons();
            });

            tagsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-tag')) {
                    const tagGroups = tagsContainer.querySelectorAll('.tag-input-group');
                    if (tagGroups.length > 1) {
                        e.target.closest('.tag-input-group').remove();
                        updateRemoveButtons();
                    }
                }
            });

            function updateRemoveButtons() {
                const tagGroups = tagsContainer.querySelectorAll('.tag-input-group');
                const removeButtons = tagsContainer.querySelectorAll('.remove-tag');
                removeButtons.forEach((btn) => {
                    btn.style.display = tagGroups.length > 1 ? 'block' : 'none';
                });
            }

            updateRemoveButtons();
        });
    </script>
    @endpush
</x-app-layout>
