<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    
    public function index()
    {
        $me = Auth::user();
        if (!$me instanceof User) {
            abort(403);
        }

        $courses = $me->courseRecords()->latest()->get(); 

        return view('courses.index', compact('courses'));
    }
    
    
    public function create()
    {
        return view('courses.create');
    }

    
    public function store(Request $request)
    {
        $me = Auth::user();
        if (!$me instanceof User) {
            abort(403);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'institucion' => 'nullable|string|max:255',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $me->courseRecords()->create($request->all());

        return redirect()->route('courses.index')->with('success', '¡Curso de formación añadido correctamente!');
    }

    
    public function destroy(Course $course)
    {
        if (Auth::id() !== $course->user_id) {
            abort(403, 'No tienes permiso para eliminar este curso.');
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Curso de formación eliminado correctamente.');
    }
}