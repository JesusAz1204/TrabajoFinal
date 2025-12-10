<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Muestra la lista de cursos registrados por el usuario (experiencia).
     */
    public function index()
    {
        $me = Auth::user();
        if (!$me instanceof User) {
            abort(403);
        }

        // Usar courseRecords() para listar los cursos registrados por el usuario.
        $courses = $me->courseRecords()->latest()->get(); 

        return view('courses.index', compact('courses'));
    }
    
    /**
     * Muestra el formulario para añadir un nuevo curso de formación.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Procesa la solicitud POST y guarda el nuevo curso en la base de datos.
     */
    public function store(Request $request)
    {
        $me = Auth::user();
        if (!$me instanceof User) {
            abort(403);
        }

        // 1. Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'institucion' => 'nullable|string|max:255',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        // 2. Creación y guardado del registro (usa la relación HasMany)
        $me->courseRecords()->create($request->all());

        // 3. Redirección con mensaje de éxito
        return redirect()->route('courses.index')->with('success', '¡Curso de formación añadido correctamente!');
    }

    /**
     * Elimina un curso de formación específico.
     */
    public function destroy(Course $course)
    {
        // 1. Verificación de propiedad: Solo el dueño del curso puede eliminarlo.
        if (Auth::id() !== $course->user_id) {
            abort(403, 'No tienes permiso para eliminar este curso.');
        }

        // 2. Eliminación del registro
        $course->delete();

        // 3. Redirección con mensaje de éxito
        return redirect()->route('courses.index')->with('success', 'Curso de formación eliminado correctamente.');
    }
}