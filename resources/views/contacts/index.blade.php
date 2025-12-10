<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="rounded-xl bg-green-50 border border-green-200 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Header -->
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h1 class="text-3xl font-bold text-slate-900">Mis Contactos</h1>

                <div class="flex flex-col gap-3 md:flex-row md:items-center md:gap-4 w-full md:w-auto">
                    <!-- Buscador de contactos -->
                    <form method="GET" action="{{ route('contacts.index') }}" class="w-full md:w-[420px]">
                        <div class="relative">
                            <input
                                type="text"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="Buscar contacto..."
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 pr-12 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-300"
                            />
                            <button
                                type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 rounded-xl px-3 py-2 hover:bg-slate-50"
                                title="Buscar"
                            >
                                🔎
                            </button>
                        </div>
                    </form>

                    <!-- Botón para ir a Usuarios -->
                    <a
                        href="{{ route('users.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-5 py-3 font-semibold text-white hover:bg-emerald-700"
                    >
                        Agregar usuarios
                    </a>
                </div>
            </div>

            <!-- Lista de contactos -->
            <div class="bg-white shadow-sm sm:rounded-2xl p-6">
                @if(($contacts ?? collect())->count())
                    <div class="divide-y">
                        @foreach($contacts as $c)
                            <div class="py-4 flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4 min-w-0">
                                    <div class="h-11 w-11 rounded-full bg-slate-100 flex items-center justify-center font-semibold text-slate-600">
                                        {{ mb_strtoupper(mb_substr($c->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">
                                        <div class="font-semibold text-slate-900 truncate">{{ $c->name }}</div>
                                        <div class="text-sm text-slate-500 truncate">
                                            {{ $c->title ?? $c->email }}
                                            @if(!empty($c->location)) • {{ $c->location }} @endif
                                        </div>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('contacts.destroy', $c) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="rounded-xl border border-slate-200 px-4 py-2 text-slate-700 hover:bg-slate-50"
                                    >
                                        Quitar
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        @if(isset($contacts) && method_exists($contacts, 'links'))
                            {{ $contacts->links() }}
                        @endif
                    </div>
                @else
                    <div class="rounded-2xl border border-slate-200 p-4 text-slate-600">
                        No tienes contactos aún.
                    </div>
                @endif
            </div>

            <!-- Hint / Ayuda -->
            <div class="bg-white shadow-sm sm:rounded-2xl p-6">
                <h2 class="text-lg font-semibold text-slate-900">¿Cómo agrego contactos?</h2>
                <p class="mt-2 text-slate-600">
                    Da clic en <span class="font-semibold">“Agregar usuarios”</span> para ir al apartado de usuarios.
                    Ahí podrás crear usuarios manualmente y agregarlos a tu lista de contactos.
                    Una vez agregados, aparecerán aquí en <span class="font-semibold">Mis Contactos</span>
                    y también podrás encontrarlos con el buscador.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
