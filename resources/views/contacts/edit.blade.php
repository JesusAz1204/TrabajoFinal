@extends('layouts.app')

@section('content')
<div class="container max-w-xl p-4 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Editar Contacto: {{ $contact->name }}</h1>
    <p class="mb-6 text-gray-600">Modifica la información de tu contacto.</p>

    <form action="{{ route('contacts.update', $contact) }}" method="POST" class="p-6 bg-white rounded-lg shadow-md">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Nombre del Contacto *</label>
            <input type="text" name="name" id="name" required 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                   value="{{ old('name', $contact->name) }}">
            @error('name')
                <p class="text-xs italic text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="company" class="block mb-2 text-sm font-bold text-gray-700">Empresa o Institución</label>
            <input type="text" name="company" id="company" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('company') border-red-500 @enderror"
                   value="{{ old('company', $contact->company) }}">
            @error('company')
                <p class="text-xs italic text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone" class="block mb-2 text-sm font-bold text-gray-700">Teléfono</label>
            <input type="text" name="phone" id="phone" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror"
                   value="{{ old('phone', $contact->phone) }}">
            @error('phone')
                <p class="text-xs italic text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="email" class="block mb-2 text-sm font-bold text-gray-700">Correo Electrónico</label>
            <input type="email" name="email" id="email" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                   value="{{ old('email', $contact->email) }}">
            @error('email')
                <p class="text-xs italic text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="notes" class="block mb-2 text-sm font-bold text-gray-700">Notas Adicionales</label>
            <textarea name="notes" id="notes" rows="3" 
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('notes') border-red-500 @enderror">{{ old('notes', $contact->notes) }}</textarea>
            @error('notes')
                <p class="text-xs italic text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('contacts.index') }}" class="inline-block text-sm font-bold text-gray-500 align-baseline hover:text-gray-800">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection