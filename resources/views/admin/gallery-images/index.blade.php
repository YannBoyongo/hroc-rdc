<x-app-layout>
    <x-slot name="header">
        {{ __('Images de galerie') }}
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-blue_green-50 border border-blue_green-200 text-blue_green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-deep_twilight-500">Liste des images</h2>
            <a href="{{ route('admin.gallery-images.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 hover:from-deep_twilight-600 hover:to-french_blue-600 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ __('Ajouter une image') }}
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-6">
                @forelse($images as $image)
                @php
                    $imageUrl = str_starts_with($image->image_path, 'gallery-images/') 
                        ? Storage::url($image->image_path) 
                        : asset($image->image_path);
                @endphp
                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="aspect-square bg-gray-100">
                        <img src="{{ $imageUrl }}" alt="{{ $image->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-deep_twilight-500 mb-1">{{ $image->title }}</h3>
                        @if($image->caption)
                            <p class="text-sm text-gray-600 line-clamp-2 mb-2">{{ $image->caption }}</p>
                        @endif
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                            <span>Ordre: {{ $image->order }}</span>
                            @if($image->is_published)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded">Publié</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded">Brouillon</span>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.gallery-images.edit', $image) }}" 
                               class="flex-1 text-center px-3 py-2 bg-blue_green-50 text-blue_green-600 rounded hover:bg-blue_green-100 transition-colors text-sm font-medium">
                                Modifier
                            </a>
                            <form action="{{ route('admin.gallery-images.destroy', $image) }}" 
                                  method="POST" 
                                  class="flex-1"
                                  onsubmit="return confirm('Supprimer cette image ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-3 py-2 bg-red-50 text-red-600 rounded hover:bg-red-100 transition-colors text-sm font-medium">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    Aucune image trouvée. <a href="{{ route('admin.gallery-images.create') }}" class="text-blue_green-600 hover:underline">Ajouter la première</a>
                </div>
                @endforelse
            </div>

            @if($images->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $images->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
