@extends('layouts.app')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-semibold">Dashboard - Chaymba</h1>
</div>


    <div class="text-center">
        <h1 class="text-4xl font-semibold">Oportunidades Flexibles</h1>

        <div class="mx-auto mt-8 flex max-w-xl items-center gap-2 rounded-xl border bg-white px-4 py-3 shadow-sm">
            <input class="w-full border-0 bg-transparent outline-none" placeholder="Escribe el trabajo o habilidad..." />
            <span class="text-slate-400">🔎</span>
        </div>

        <div class="mt-10 grid grid-cols-2 gap-4 md:grid-cols-4">
            <a href="{{ route('courses.index') }}" class="rounded-2xl border bg-white p-6 shadow-sm hover:shadow-md">
                <div class="text-3xl">📚</div><div class="mt-3 font-medium">Cursos</div>
            </a>
            <a href="{{ route('messages.index') }}" class="rounded-2xl border bg-white p-6 shadow-sm hover:shadow-md">
                <div class="text-3xl">💬</div><div class="mt-3 font-medium">Mensajes</div>
            </a>
            <a href="{{ route('reports.index') }}" class="rounded-2xl border bg-white p-6 shadow-sm hover:shadow-md">
                <div class="text-3xl">📊</div><div class="mt-3 font-medium">Informes</div>
            </a>
            <a href="{{ route('contacts.index') }}" class="rounded-2xl border bg-white p-6 shadow-sm hover:shadow-md">
                <div class="text-3xl">👥</div><div class="mt-3 font-medium">Contactos</div>
            </a>
        </div>
    </div>
@endsection
