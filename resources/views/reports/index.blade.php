@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between">
    <h1 class="text-3xl font-semibold">Informes</h1>
    <div class="rounded-xl border bg-white px-4 py-2 text-sm shadow-sm">📅 Últimos 30 días</div>
</div>

<div class="mt-6 grid gap-4 md:grid-cols-4">
    <div class="rounded-2xl border bg-white p-5 shadow-sm">
        <div class="text-slate-500 text-sm">Ingresos Totales</div>
        <div class="mt-2 text-2xl font-semibold">${{ number_format($incomeTotal, 2) }}</div>
    </div>
    <div class="rounded-2xl border bg-white p-5 shadow-sm">
        <div class="text-slate-500 text-sm">Proyectos Completados</div>
        <div class="mt-2 text-2xl font-semibold">{{ $projectsCompleted }}</div>
    </div>
    <div class="rounded-2xl border bg-white p-5 shadow-sm">
        <div class="text-slate-500 text-sm">Propuestas Enviadas</div>
        <div class="mt-2 text-2xl font-semibold">{{ $proposalsSent }}</div>
    </div>
    <div class="rounded-2xl border bg-white p-5 shadow-sm">
        <div class="text-slate-500 text-sm">Calificación Promedio</div>
        <div class="mt-2 text-2xl font-semibold">{{ $ratingAvg }}</div>
    </div>
</div>

<div class="mt-6 rounded-2xl border bg-white p-6 shadow-sm">
    <h2 class="text-lg font-semibold">Historial de Transacciones</h2>

    <div class="mt-4 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-500">
                <tr class="border-b">
                    <th class="py-3">FECHA</th>
                    <th class="py-3">DESCRIPCIÓN</th>
                    <th class="py-3 text-right">MONTO</th>
                    <th class="py-3 text-right">ESTADO</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($tx as $t)
                    <tr>
                        <td class="py-3">{{ $t->occurred_at->format('d M, Y') }}</td>
                        <td class="py-3">{{ $t->description }}</td>
                        <td class="py-3 text-right {{ $t->amount < 0 ? 'text-amber-700' : '' }}">
                            {{ $t->amount < 0 ? '-' : '' }}${{ number_format(abs($t->amount),2) }}
                        </td>
                        <td class="py-3 text-right">
                            @if($t->status === 'completed')
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-emerald-800">Completado</span>
                            @else
                                <span class="rounded-full bg-amber-100 px-3 py-1 text-amber-800">Pendiente</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
