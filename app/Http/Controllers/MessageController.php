<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $me = Auth::user();

        if (!$me instanceof User) {
            abort(403);
        }

        $contacts = $me->contacts()->get();
        $active = $contacts->first();

        if (!$active) {
            return view('messages.index', [
                'contacts' => $contacts,
                'activeUser' => null,
                'messages' => collect(),
            ]);
        }

        return redirect()->route('messages.show', $active);
    }

    public function show(User $user)
    {
        $me = Auth::user();

        if (!$me instanceof User) {
            abort(403);
        }

        // (Opcional) seguridad: solo permitir chats con contactos
        // if (!$me->contacts()->whereKey($user->id)->exists()) abort(403);

        $contacts = $me->contacts()->get();

        $messages = Message::query()
            ->where(function ($q) use ($me, $user) {
                $q->where('sender_id', $me->id)
                  ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($q) use ($me, $user) {
                $q->where('sender_id', $user->id)
                  ->where('receiver_id', $me->id);
            })
            ->orderBy('created_at')
            ->get();

        return view('messages.index', [
            'contacts' => $contacts,
            'activeUser' => $user,
            'messages' => $messages,
        ]);
    }

    public function store(Request $request, User $user)
    {
        $me = Auth::user();

        if (!$me instanceof User) {
            abort(403);
        }

        $data = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'sender_id' => $me->id,
            'receiver_id' => $user->id,
            'body' => $data['body'],
        ]);

        return redirect()->route('messages.show', $user);
    }
}
