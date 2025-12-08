@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-2xl p-6">
    <h1 class="text-3xl font-semibold">Publica una Nueva Oportunidad</h1>
    <p class="mt-1 text-slate-500">Completa los siguientes campos para llegar a los mejores candidatos.</p>

    <form method="POST" action="{{ route('opportunities.store') }}" class="mt-6 space-y-4 rounded-2xl border bg-white p-6 shadow-sm">
        @csrf

        <div>
            <label class="text-sm font-medium">Título del Empleo</label>
            <input name="title" value="{{ old('title') }}" class="mt-1 w-full rounded-lg border p-3" placeholder="Ej: Diseñador Gráfico para Redes Sociales">
            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="text-sm font-medium">Nombre de la Empresa (Opcional)</label>
            <input name="company" value="{{ old('company') }}" class="mt-1 w-full rounded-lg border p-3" placeholder="Ej: Mi Emprendimiento Creativo">
        </div>

        <div>
            <label class="text-sm font-medium">Categoría</label>
            <input name="category" value="{{ old('category') }}" class="mt-1 w-full rounded-lg border p-3" placeholder="Ej: Diseño, Web, Marketing...">
        </div>

        <div>
            <label class="text-sm font-medium">Descripción del Puesto</label>
            <textarea name="description" class="mt-1 w-full rounded-lg border p-3" rows="5"
                placeholder="Describe las responsabilidades, los objetivos y lo que esperas del candidato.">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="text-sm font-medium">Habilidades Requeridas</label>
            <input name="skills_required" value="{{ old('skills_required') }}" class="mt-1 w-full rounded-lg border p-3"
                   placeholder="Ej: Photoshop, Illustrator, Comunicación, SEO (separadas por comas)">
        </div>

        <div>
            <label class="text-sm font-medium">Presupuesto o Salario</label>
            <input name="budget" value="{{ old('budget') }}" class="mt-1 w-full rounded-lg border p-3"
                   placeholder="Ej: $500 por proyecto, $20 por hora, a convenir">
        </div>

        <button class="w-full rounded-xl bg-emerald-600 py-3 font-semibold text-white hover:bg-emerald-700">
            Publicar Empleo
        </button>
    </form>
</div>
@endsection
