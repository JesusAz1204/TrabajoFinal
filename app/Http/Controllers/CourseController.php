<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $me = Auth::user();
        if (!$me instanceof User) {
            abort(403);
        }

        $courses = $me->courses()
            ->withPivot(['progress', 'completed_at'])
            ->get();

        return view('courses.index', compact('courses'));
    }
}
