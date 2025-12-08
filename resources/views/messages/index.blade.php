@extends('layouts.app')

@section('content')
<div class="rounded-2xl border bg-white shadow-sm overflow-hidden">
    <div class="grid md:grid-cols-[320px_1fr]">
        <aside class="border-r bg-white">
            <div class="p-4 font-semibold">Mensajes</div>
            <div class="divide-y">
                @forelse($contacts as $c)
                    <a href="{{ route('messages.show',$c) }}" class="flex gap-3 p-4 hover:bg-emerald-50 {{ $activeUser?->id === $c->id ? 'bg-emerald-50' : '' }}">
                        <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-semibold">
                            {{ mb_substr($c->name,0,1) }}
                        </div>
                        <div class="min-w-0">
                            <div class="font-medium">{{ $c->name }}</div>
                            <div class="truncate text-sm text-slate-500">—</div>
                        </div>
                    </a>
                @empty
                    <div class="p-4 text-sm text-slate-500">No hay contactos.</div>
                @endforelse
            </div>
        </aside>

        <section class="bg-slate-50">
            <div class="border-b bg-white p-4 font-semibold">
                {{ $activeUser?->name ?? 'Selecciona un contacto' }}
            </div>

            <div class="h-[520px] overflow-y-auto p-6 space-y-4">
                @forelse($messages as $m)
                    @php $mine = $m->sender_id === auth()->id(); @endphp
                    <div class="flex {{ $mine ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[70%] rounded-2xl px-4 py-3 shadow-sm
                            {{ $mine ? 'bg-emerald-600 text-white' : 'bg-white text-slate-800 border' }}">
                            <div class="text-sm">{{ $m->body }}</div>
                            <div class="mt-1 text-xs opacity-70">{{ $m->created_at->format('H:i') }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-sm text-slate-500">Aún no hay mensajes.</div>
                @endforelse
            </div>

            @if($activeUser)
                <form class="border-t bg-white p-4 flex gap-3" method="POST" action="{{ route('messages.store',$activeUser) }}">
                    @csrf
                    <input name="body" class="w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-200"
                           placeholder="Escribe un mensaje..." />
                    <button class="rounded-xl bg-emerald-600 px-4 py-3 font-medium text-white hover:bg-emerald-700">➤</button>
                </form>
            @endif
        </section>
    </div>
</div>
@endsection
