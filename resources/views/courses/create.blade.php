@extends('layouts.app') {{-- Reemplaza 'layouts.app' si usas otro layout principal --}}

@section('content')

    <div class="container py-4">
        <h2>Registro de Nuevo Curso</h2>
        <p class="text-muted">Añade los cursos de formación que has completado para enriquecer tu perfil.</p>

        <div class="p-4 mt-4 card">
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf <div class="mb-3 form-group">
                    <label for="nombre" class="form-label">Nombre del Curso <span class="text-danger">*</span></label>
                    <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="institucion" class="form-label">Institución o Plataforma</label>
                    <input type="text" id="institucion" name="institucion" class="form-control @error('institucion') is-invalid @enderror" value="{{ old('institucion') }}">
                    @error('institucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6 form-group">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio') }}">
                        @error('fecha_inicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3 col-md-6 form-group">
                        <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" value="{{ old('fecha_fin') }}">
                        @error('fecha_fin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success" style="background-color: #28a745; border-color: #28a745;">
                        Guardar Curso
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection