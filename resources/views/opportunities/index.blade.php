<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bolsa de Trabajo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 flex justify-end">
                <a href="{{ route('opportunities.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">
                    + Publicar Nuevo Empleo
                </a>
            </div>

            <div class="grid gap-6">
                @foreach ($opportunities as $opportunity)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $opportunity->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $opportunity->company ?? 'Empresa Confidencial' }} • {{ $opportunity->category }}</p>
                            </div>
                            <span class="bg-emerald-100 text-emerald-800 text-xs px-2 py-1 rounded-full font-bold">
                                {{ $opportunity->budget ? '$'.$opportunity->budget : 'A convenir' }}
                            </span>
                        </div>

                        <p class="mt-4 text-gray-600 text-sm line-clamp-3">
                            {{ $opportunity->description }}
                        </p>

                        <div class="mt-4 flex items-center justify-between border-t pt-4">
                            <span class="text-xs text-gray-400">Publicado por: {{ $opportunity->user->name }}</span>
                            <span class="text-xs text-gray-400">{{ $opportunity->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach

                @if($opportunities->isEmpty())
                    <p class="text-center text-gray-500">No hay empleos disponibles aún.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>