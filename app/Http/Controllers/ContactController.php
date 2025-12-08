<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');

        $me = Auth::user();
        if (!$me instanceof User) {
            abort(403);
        }

        $contacts = $me->contacts()
            ->when($q !== '', fn ($s) => $s->where('name', 'like', "%{$q}%"))
            ->get();

        return view('contacts.index', compact('contacts', 'q'));
    }
}
