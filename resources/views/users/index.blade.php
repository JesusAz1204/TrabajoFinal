<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @php
                $users = $users ?? collect();
                $myContactIds = $myContactIds ?? [];
            @endphp

            {{-- Mensajes --}}
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

            @if($errors->any())
                <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Header --}}
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-slate-900">Usuarios</h1>

                <a href="{{ route('contacts.index') }}"
                   class="rounded-2xl border border-slate-200 px-5 py-3 text-slate-700 hover:bg-slate-50">
                    ← Volver a contactos
                </a>
            </div>

            {{-- Crear usuario manualmente --}}
            <div class="bg-white shadow-sm sm:rounded-2xl p-6">
                <h2 class="text-lg font-semibold text-slate-900">Crear usuario manualmente</h2>

                <form method="POST" action="{{ route('users.store') }}" class="mt-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <input
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Nombre"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-300"
                            required
                        />

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Correo"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-300"
                            required
                        />

                        <input
                            type="password"
                            name="password"
                            placeholder="Contraseña"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-300"
                            required
                        />
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="rounded-2xl bg-emerald-600 px-6 py-3 font-semibold text-white hover:bg-emerald-700">
                            Guardar usuario
                        </button>
                    </div>
                </form>
            </div>

            {{-- Lista de usuarios --}}
            <div class="bg-white shadow-sm sm:rounded-2xl p-6">
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">Lista de usuarios</h2>

                    <form method="GET" action="{{ route('users.index') }}" class="w-full md:max-w-md">
                        <div class="relative">
                            <input
                                type="text"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="Buscar usuario..."
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 pr-12 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-300"
                            />
                            <button type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 rounded-xl px-3 py-2 hover:bg-slate-50"
                                title="Buscar">
                                🔎
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-4 divide-y">
                    @forelse($users as $u)
                        <div class="py-3 flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <div class="font-medium text-slate-900 truncate">{{ $u->name }}</div>
                                <div class="text-sm text-slate-500 truncate">{{ $u->email }}</div>
                            </div>

                            <div class="flex items-center gap-3">
                                @if(auth()->id() === $u->id)
                                    <span class="text-sm text-slate-400">Tú</span>

                                @elseif(in_array($u->id, $myContactIds))
                                    <span class="text-sm text-emerald-700 font-semibold">Ya es contacto</span>

                                @else
                                    {{-- Guardar contacto (aquí sí existe $u porque estamos en foreach) --}}
                                    <form method="POST" action="{{ route('contacts.store', ['user' => $u->id]) }}">
                                        @csrf
                                        <input type="hidden" name="redirect_users" value="1">

                                        <button type="submit"
                                            class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 hover:bg-emerald-100">
                                            Guardar contacto
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4">No hay usuarios para mostrar.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    @if(method_exists($users, 'links'))
                        {{ $users->links() }}
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
