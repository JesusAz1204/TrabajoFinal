@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4">
    <h1 class="text-3xl font-semibold">Mis Contactos</h1>

    <form class="flex items-center gap-2 rounded-xl border bg-white px-4 py-2 shadow-sm" method="GET">
        <input name="q" value="{{ $q }}" class="w-64 border-0 outline-none" placeholder="Buscar contacto..." />
        <button class="text-slate-500">🔎</button>
    </form>
</div>

<div class="mt-8 grid gap-6 md:grid-cols-3">
    @forelse($contacts as $c)
        <div class="rounded-2xl border bg-white p-6 shadow-sm">
            <div class="flex items-center justify-center">
                <div class="h-16 w-16 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl font-semibold">
                    {{ mb_substr($c->name,0,1) }}
                </div>
            </div>

            <div class="mt-4 text-center">
                <div class="text-lg font-semibold">{{ $c->name }}</div>
                <div class="text-sm text-slate-500">{{ $c->title ?? 'Contacto' }} - {{ $c->location ?? '—' }}</div>
            </div>

            <div class="mt-5 space-y-2">
                <a href="{{ route('messages.show', $c) }}" class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 font-medium text-white hover:bg-emerald-700">
                    ✈️ Enviar Mensaje
                </a>
                <a href="{{ route('profile.show') }}" class="flex w-full items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-2 font-medium text-slate-700 hover:bg-slate-200">
                    👤 Ver Perfil
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full rounded-2xl border bg-white p-6 text-slate-600">
            No tienes contactos aún.
        </div>
    @endforelse
</div>
@endsection
