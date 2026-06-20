<x-app-layout>
    <x-slot name="header">
        {{ __('Réalisations') }}
    </x-slot>

    <div class="space-y-6">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-blue_green-50 border border-blue_green-200 text-blue_green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header with Create Button -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-deep_twilight-500">Liste des réalisations</h2>
            <a href="{{ route('admin.realisations.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 hover:from-deep_twilight-600 hover:to-french_blue-600 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ __('Ajouter une réalisation') }}
            </a>
        </div>

        <!-- Realisations Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tags</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($realisations as $realisation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($realisation->image)
                                    @if(str_starts_with($realisation->image, 'realisations/'))
                                        <img src="{{ Storage::url($realisation->image) }}" alt="{{ $realisation->title }}" class="h-16 w-16 object-cover rounded">
                                    @else
                                        <img src="{{ asset($realisation->image) }}" alt="{{ $realisation->title }}" class="h-16 w-16 object-cover rounded">
                                    @endif
                                @else
                                    <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-deep_twilight-500">{{ $realisation->title }}</div>
                                <div class="text-sm text-gray-500 line-clamp-2">{{ Str::limit(strip_tags($realisation->description), 100) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($realisation->tags)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($realisation->tags, 0, 2) as $tag)
                                            <span class="px-2 py-1 bg-blue_green-100 text-blue_green-700 rounded text-xs">{{ $tag }}</span>
                                        @endforeach
                                        @if(count($realisation->tags) > 2)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">+{{ count($realisation->tags) - 2 }}</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $realisation->order }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($realisation->is_published)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-medium">Publié</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-medium">Brouillon</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.realisations.edit', $realisation) }}" 
                                       class="text-blue_green-600 hover:text-blue_green-900">
                                        {{ __('Modifier') }}
                                    </a>
                                    <form action="{{ route('admin.realisations.destroy', $realisation) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réalisation ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            {{ __('Supprimer') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Aucune réalisation trouvée. <a href="{{ route('admin.realisations.create') }}" class="text-blue_green-600 hover:underline">Créer la première</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($realisations->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $realisations->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
