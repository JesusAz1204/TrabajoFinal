<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpportunityController extends Controller
{
    public function create()
    {
        $me = Auth::user();
        if (!$me instanceof User) {
            abort(403);
        }

        return view('opportunities.create');
    }

    public function store(Request $request)
    {
        $me = Auth::user();
        if (!$me instanceof User) {
            abort(403);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:140'],
            'company' => ['nullable', 'string', 'max:140'],
            'category' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:5000'],
            'skills_required' => ['nullable', 'string', 'max:255'],
            'budget' => ['nullable', 'string', 'max:100'],
        ]);

        Opportunity::create([
            'user_id' => $me->id,
            ...$data,
        ]);

        return redirect()->route('dashboard')->with('status', 'Oportunidad publicada.');
    }
}
