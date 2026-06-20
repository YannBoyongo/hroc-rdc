<x-app-layout>
    <x-slot name="header">
        {{ __('Rapports') }}
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
            <h2 class="text-2xl font-bold text-deep_twilight-500">Liste des rapports</h2>
            <a href="{{ route('admin.reports.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-deep_twilight-500 to-french_blue-500 hover:from-deep_twilight-600 hover:to-french_blue-600 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ __('Ajouter un rapport') }}
            </a>
        </div>

        <!-- Reports Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Année</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fichier</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reports as $report)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-deep_twilight-500">{{ $report->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $report->year }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($report->filepath)
                                    <a href="{{ Storage::url($report->filepath) }}" target="_blank" class="inline-flex items-center text-blue_green-600 hover:text-blue_green-900">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        Voir le PDF
                                    </a>
                                @else
                                    <span class="text-sm text-gray-400">Aucun fichier</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.reports.edit', $report) }}" 
                                       class="text-blue_green-600 hover:text-blue_green-900">
                                        {{ __('Modifier') }}
                                    </a>
                                    <form action="{{ route('admin.reports.destroy', $report) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">
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
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Aucun rapport trouvé. <a href="{{ route('admin.reports.create') }}" class="text-blue_green-600 hover:underline">Créer le premier</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($reports->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $reports->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

