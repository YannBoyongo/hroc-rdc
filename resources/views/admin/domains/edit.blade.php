<x-app-layout>
    <x-slot name="header">
        {{ __('Modifier le domaine') }}
    </x-slot>

    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.domains.update', $domain) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            @csrf
            @method('PATCH')

            <div class="p-6 space-y-6">
                <!-- Descriptions -->
                <div>
                    <x-input-label for="descriptions" :value="__('Descriptions')" />
                    <textarea id="descriptions" 
                              name="descriptions" 
                              rows="6" 
                              required
                              class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('descriptions', $domain->descriptions) }}</textarea>
                    <x-input-error :messages="$errors->get('descriptions')" class="mt-2" />
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.domains.index') }}" 
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

