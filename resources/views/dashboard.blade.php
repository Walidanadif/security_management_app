<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 text-xl font-semibold text-gray-800 dark:text-gray-100">
                Bienvenue {{ $userName }}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    👮 <strong>Agents</strong>
                    <p class="text-2xl">{{ $agentsCount }}</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>