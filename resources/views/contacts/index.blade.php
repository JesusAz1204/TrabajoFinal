@extends('layouts.app')

@section('content')
<div class="container p-4 mx-auto">

    @if (session('success'))
        <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">Mis Contactos</h1>
        <a href="{{ route('contacts.create') }}" class="px-4 py-2 font-bold text-white bg-green-600 rounded hover:bg-green-700">
            + Añadir Contacto
        </a>
    </div>

    @if ($contacts->isEmpty())
        <div class="p-6 text-center bg-white rounded-lg shadow-md">
            <p class="text-xl font-semibold text-gray-700">¡Ups!</p>
            <p class="mt-2 text-gray-600">No tienes contactos registrados aún. Haz clic en "Añadir Contacto" para enriquecer tu perfil.</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($contacts as $contact)
                <div class="p-6 bg-white border-t-4 border-green-500 rounded-lg shadow-md">
                    <h2 class="mb-2 text-xl font-bold text-gray-800">{{ $contact->name }}</h2>
                    @if ($contact->phone)
                        <p class="text-gray-600">📞 Teléfono: {{ $contact->phone }}</p>
                    @endif
                    @if ($contact->email)
                        <p class="text-gray-600">📧 Email: {{ $contact->email }}</p>
                    @endif
                    @if ($contact->company)
                        <p class="text-gray-600">🏢 Empresa: {{ $contact->company }}</p>
                    @endif
                    
                    <div class="flex items-center gap-4 mt-4">
                        <a href="{{ route('contacts.edit', $contact) }}" 
                           class="text-sm text-blue-600 hover:text-blue-800 focus:outline-none">
                            Editar
                        </a>
                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este contacto?')"
                                    class="text-sm text-red-600 hover:text-red-800 focus:outline-none">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection