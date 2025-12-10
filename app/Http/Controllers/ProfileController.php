<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        if (!$user instanceof User) abort(403);

        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        if (!$user instanceof User) abort(403);

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user instanceof User) abort(403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:120'],
            'location' => ['nullable', 'string', 'max:120'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'skills' => ['nullable', 'string', 'max:255'], 
        ]);

        $user->name = $data['name'];
        $user->title = $data['title'] ?? null;
        $user->location = $data['location'] ?? null;
        $user->bio = $data['bio'] ?? null;

        $skills = collect(explode(',', $data['skills'] ?? ''))
            ->map(fn($s) => trim($s))
            ->filter()
            ->values()
            ->all();

        $user->skills = $skills;

        $user->save();

        return redirect()->route('profile.show')->with('status', 'Perfil actualizado.');
    }
}
