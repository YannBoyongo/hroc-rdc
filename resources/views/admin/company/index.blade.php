<x-app-layout>
    <x-slot name="header">
        {{ __('Entreprise') }}
    </x-slot>

    <div class="space-y-6">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-blue_green-50 border border-blue_green-200 text-blue_green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Company Form -->
        <form method="POST" action="{{ route('admin.company.update') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            @csrf
            @method('PATCH')

            <div class="p-6 space-y-6">
                <!-- Intro Section -->
                <div>
                    <h3 class="text-lg font-semibold text-deep_twilight-500 mb-4">{{ __('Introduction') }}</h3>
                    <div>
                        <x-input-label for="intro" :value="__('Introduction')" />
                        <textarea id="intro" 
                                  name="intro" 
                                  rows="8" 
                                  class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('intro', $company->intro) }}</textarea>
                        <x-input-error :messages="$errors->get('intro')" class="mt-2" />
                    </div>
                </div>

                <!-- About Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-deep_twilight-500 mb-4">{{ __('À propos') }}</h3>
                    <div>
                        <x-input-label for="about" :value="__('À propos')" />
                        <textarea id="about" 
                                  name="about" 
                                  rows="8" 
                                  class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('about', $company->about) }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>
                </div>

                <!-- Vision Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-deep_twilight-500 mb-4">{{ __('Vision') }}</h3>
                    <div>
                        <x-input-label for="vision" :value="__('Vision')" />
                        <textarea id="vision" 
                                  name="vision" 
                                  rows="8" 
                                  class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('vision', $company->vision) }}</textarea>
                        <x-input-error :messages="$errors->get('vision')" class="mt-2" />
                    </div>
                </div>

                <!-- Mission Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-deep_twilight-500 mb-4">{{ __('Mission') }}</h3>
                    <div>
                        <x-input-label for="mission" :value="__('Mission')" />
                        <textarea id="mission" 
                                  name="mission" 
                                  rows="8" 
                                  class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('mission', $company->mission) }}</textarea>
                        <x-input-error :messages="$errors->get('mission')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <x-primary-button>
                    {{ __('Enregistrer') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editors = ['intro', 'about', 'vision', 'mission'];
            
            editors.forEach(function(editorId) {
                ClassicEditor
                    .create(document.querySelector('#' + editorId), {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'link', '|',
                                'bulletedList', 'numberedList', '|',
                                'blockQuote', 'insertTable', '|',
                                'undo', 'redo'
                            ]
                        },
                        language: 'fr',
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraphe', class: 'ck-heading_paragraph' },
                                { model: 'heading1', view: 'h1', title: 'Titre 1', class: 'ck-heading_heading1' },
                                { model: 'heading2', view: 'h2', title: 'Titre 2', class: 'ck-heading_heading2' },
                                { model: 'heading3', view: 'h3', title: 'Titre 3', class: 'ck-heading_heading3' }
                            ]
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de l\'initialisation de l\'éditeur:', error);
                    });
            });
        });
    </script>
    @endpush
</x-app-layout>
