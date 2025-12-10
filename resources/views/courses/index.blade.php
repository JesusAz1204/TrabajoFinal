@extends('layouts.app') {{-- Asegúrate de usar el layout correcto --}}

@section('content')

    <div class="container py-4">

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2>Mis Cursos</h2>
            <a href="{{ route('courses.create') }}" class="btn btn-success" 
               style="background-color: #28a745; border-color: #28a745;">
                ➕ Añadir Curso
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <p class="text-muted">A continuación, se muestra la lista de cursos de formación y experiencia que has registrado en tu perfil.</p>

        <hr class="mb-5">

        @if ($courses->isEmpty())
            <div class="text-center alert alert-info">
                <h4 class="alert-heading">¡Ups!</h4>
                <p>No tienes cursos registrados aún. Haz clic en "Añadir Curso" para enriquecer tu perfil.</p>
            </div>
        @else
            <div class="row">
                @foreach ($courses as $course)
                    <div class="mb-4 col-md-12">
                        <div class="p-4 shadow-sm card" style="border-left: 6px solid #28a745;">
                            <div class="card-body">
                                
                                <div class="mb-3 d-flex justify-content-between align-items-start">
                                    <h4 class="mb-0">Registro de Formación</h4>
                                    
                                    <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el curso \'{{ $course->nombre }}\'? Esta acción no se puede deshacer.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>

                                <dl class="mb-3 row">
                                    <dt class="col-sm-3 fw-bold">Nombre del Curso:</dt>
                                    <dd class="col-sm-9 text-primary fw-bold">{{ $course->nombre }}</dd>

                                    <dt class="col-sm-3 fw-bold">Institución o Plataforma:</dt>
                                    <dd class="col-sm-9 text-muted">{{ $course->institucion ?? 'Institución no especificada' }}</dd>
                                </dl>
                                
                                <table class="table mt-3 table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold" style="width: 150px;">Fecha de Inicio:</td>
                                            <td>{{ $course->fecha_inicio ? $course->fecha_inicio->format('d/m/Y') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Fecha de Finalización:</td>
                                            <td>{{ $course->fecha_fin ? $course->fecha_fin->format('d/m/Y') : 'En curso / N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection