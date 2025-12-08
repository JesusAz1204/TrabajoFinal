@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class="text-3xl font-semibold">Mis Cursos</h1>
    <p class="mt-2 text-slate-500">Continúa aprendiendo y adquiere nuevas habilidades para destacar en el mercado flexible.</p>
</div>

<div class="mt-8 grid gap-6 md:grid-cols-3">
    @forelse($courses as $c)
        @php $p = (int) $c->pivot->progress; @endphp
        <div class="overflow-hidden rounded-2xl border bg-white shadow-sm">
            <img class="h-44 w-full object-cover" src="{{ $c->image_url ?? 'https://picsum.photos/seed/course/800/500' }}" alt="">
            <div class="p-5">
                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-800">
                    {{ $c->category ?? 'Curso' }}
                </span>

                <h3 class="mt-3 font-semibold">{{ $c->title }}</h3>
                <p class="mt-1 text-sm text-slate-500">👤 por {{ $c->instructor ?? 'Instructor' }}</p>

                <div class="mt-4 text-xs text-slate-500 flex justify-between">
                    <span>{{ $p === 100 ? 'Completado' : 'Progreso' }}</span>
                    <span>{{ $p }}%</span>
                </div>
                <div class="mt-2 h-2 w-full rounded-full bg-slate-100">
<div class="h-2 rounded-full bg-emerald-600" @style(['width' => $p.'%'])></div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full rounded-2xl border bg-white p-6 text-slate-600">No tienes cursos aún.</div>
    @endforelse
</div>
@endsection
