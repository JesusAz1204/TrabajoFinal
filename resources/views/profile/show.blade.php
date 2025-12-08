@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl p-6">
    <div class="rounded-2xl border bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="h-20 w-20 rounded-full bg-slate-200"></div>
                <div>
                    <h1 class="text-2xl font-semibold">{{ $user->name }}</h1>
                    <p class="text-slate-500">{{ $user->title ?? 'Desarrollador/a' }}</p>
                    <p class="text-sm text-slate-500">{{ $user->location ?? '' }}</p>
                </div>
            </div>

<a href="{{ route('profile.edit') }}" class="rounded-xl bg-emerald-600 px-4 py-2 font-semibold text-white hover:bg-emerald-700">
    Editar Perfil
</a>
        </div>

        <hr class="my-6">

        <h2 class="text-lg font-semibold">Acerca de mí</h2>
        <p class="mt-2 text-slate-600">
            {{ $user->bio ?? 'Aún no has agregado una descripción.' }}
        </p>

        <h2 class="mt-6 text-lg font-semibold">Habilidades</h2>
        <div class="mt-3 flex flex-wrap gap-2">
            @php
                $skills = is_array($user->skills ?? null) ? $user->skills : [];
            @endphp

            @forelse($skills as $skill)
                <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm text-emerald-800">{{ $skill }}</span>
            @empty
                <span class="text-sm text-slate-500">Sin habilidades registradas.</span>
            @endforelse
        </div>
    </div>
</div>
@endsection
