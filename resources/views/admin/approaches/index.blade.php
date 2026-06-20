<x-app-layout>
    <x-slot name="header">
        {{ __('Approches') }}
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
            <h2 class="text-2xl font-bold text-deep_twilight-500">Liste des approches</h2>
            <a href="{{ route('admin.approaches.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 hover:from-deep_twilight-600 hover:to-french_blue-600 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ __('Ajouter une approche') }}
            </a>
        </div>

        <!-- Approaches Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($approaches as $approach)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $approach->id }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-deep_twilight-500">{{ $approach->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.approaches.edit', $approach) }}" 
                                       class="text-blue_green-600 hover:text-blue_green-900">
                                        {{ __('Modifier') }}
                                    </a>
                                    <form action="{{ route('admin.approaches.destroy', $approach) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette approche ?');">
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
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                Aucune approche trouvée. <a href="{{ route('admin.approaches.create') }}" class="text-blue_green-600 hover:underline">Créer la première</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($approaches->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $approaches->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

