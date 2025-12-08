@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-2xl p-6">
    <h1 class="text-3xl font-semibold">Editar Perfil</h1>

    <form method="POST" action="{{ route('profile.update') }}"
          class="mt-6 space-y-4 rounded-2xl border bg-white p-6 shadow-sm">
        @csrf
        @method('PATCH')

        <div>
            <label class="text-sm font-medium">Nombre</label>
            <input name="name" value="{{ old('name', $user->name) }}"
                   class="mt-1 w-full rounded-lg border p-3">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="text-sm font-medium">Título</label>
            <input name="title" value="{{ old('title', $user->title) }}"
                   class="mt-1 w-full rounded-lg border p-3" placeholder="Ej: Desarrollador Web Full-Stack">
        </div>

        <div>
            <label class="text-sm font-medium">Ubicación</label>
            <input name="location" value="{{ old('location', $user->location) }}"
                   class="mt-1 w-full rounded-lg border p-3" placeholder="Ej: Ciudad de México, México">
        </div>

        <div>
            <label class="text-sm font-medium">Acerca de mí</label>
            <textarea name="bio" rows="5"
                      class="mt-1 w-full rounded-lg border p-3">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div>
            <label class="text-sm font-medium">Habilidades (separadas por comas)</label>
            <input name="skills"
                   value="{{ old('skills', is_array($user->skills ?? null) ? implode(', ', $user->skills) : '') }}"
                   class="mt-1 w-full rounded-lg border p-3"
                   placeholder="Ej: JavaScript, React, Laravel">
        </div>

        <button class="w-full rounded-xl bg-emerald-600 py-3 font-semibold text-white hover:bg-emerald-700">
            Guardar Cambios
        </button>
    </form>
</div>
@endsection
