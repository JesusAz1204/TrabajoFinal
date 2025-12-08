<!doctype html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Chaymba') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-b from-emerald-50 to-white text-slate-800">
    <header class="sticky top-0 z-20 border-b bg-white/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-semibold">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">C</span>
                <span>Chaymba</span>
            </a>

            <nav class="hidden items-center gap-6 text-sm md:flex">
                <a class="hover:text-emerald-700" href="{{ route('courses.index') }}">Cursos</a>
                <a class="hover:text-emerald-700" href="{{ route('messages.index') }}">Mensajes</a>
                <a class="hover:text-emerald-700" href="{{ route('reports.index') }}">Informes</a>
                <a class="hover:text-emerald-700" href="{{ route('contacts.index') }}">Contactos</a>
                <a class="hover:text-emerald-700" href="{{ route('profile.show') }}">Mi Perfil</a>
                <a class="inline-flex items-center rounded-lg bg-emerald-600 px-3 py-2 font-medium text-white hover:bg-emerald-700"
                   href="{{ route('opportunities.create') }}">Publicar Empleo</a>
            </nav>

            <div class="flex items-center gap-3">
                <span class="hidden text-sm text-slate-600 md:inline">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="rounded-lg border px-3 py-2 text-sm hover:bg-slate-50">Salir</button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </main>
</body>
</html>
