<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    // GET /contacts
    public function index(Request $request)
    {
        $me = $request->user();

        $q = trim((string) $request->query('q'));     // buscar dentro de MIS contactos

        $contacts = $me->contacts()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('name', 'like', "%{$q}%")
                       ->orWhere('email', 'like', "%{$q}%")
                       ->orWhere('title', 'like', "%{$q}%")
                       ->orWhere('location', 'like', "%{$q}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('contacts.index', compact('contacts', 'q'));
    }

    // POST /contacts/{user}
    public function store(Request $request, User $user)
    {
        $me = $request->user();

        if ($user->id === $me->id) {
            return back()->with('error', 'No puedes agregarte a ti mismo.');
        }

        DB::table('contacts')->insertOrIgnore([
            'user_id' => $me->id,
            'contact_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->boolean('redirect_users')) {
            return redirect()->route('users.index')->with('success', 'Contacto guardado.');
        }

        return back()->with('success', 'Contacto guardado.');
    }

    // DELETE /contacts/{user}
    public function destroy(Request $request, User $user)
    {
        $me = $request->user();

        DB::table('contacts')
            ->where('user_id', $me->id)
            ->where('contact_id', $user->id)
            ->delete();

        return back()->with('success', 'Contacto eliminado.');
    }
}
