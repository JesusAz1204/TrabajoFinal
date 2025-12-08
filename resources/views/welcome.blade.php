<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chaymba</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-b from-emerald-50 to-white text-slate-800">
    <header class="border-b bg-white/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <div class="flex items-center gap-2 font-semibold">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">C</span>
                <span>Chaymba</span>
            </div>

            <nav class="flex items-center gap-4 text-sm">
                <a class="hover:text-emerald-700" href="{{ route('home') }}">Buscar Trabajos</a>
                <a class="hover:text-emerald-700" href="{{ route('opportunities.create') }}">Publicar Empleo</a>
                <a class="hover:text-emerald-700" href="{{ route('profile.show') }}">Mi Perfil</a>

                @auth
                    <a class="rounded-lg bg-emerald-600 px-3 py-2 font-medium text-white hover:bg-emerald-700" href="{{ route('dashboard') }}">
                        Ir al Panel
                    </a>
                @else
                    <a class="hover:text-emerald-700" href="{{ route('login') }}">Log in</a>
                    <a class="rounded-lg bg-emerald-600 px-3 py-2 font-medium text-white hover:bg-emerald-700" href="{{ route('register') }}">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-4 py-16 text-center">
        <h1 class="text-4xl font-semibold tracking-tight">Oportunidades Flexibles</h1>

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

        <p class="mt-10 text-sm text-slate-500">Redes Sociales: <span class="font-semibold">f</span> <span class="font-semibold">t</span> <span class="font-semibold">◎</span></p>
    </main>
</body>
</html>
