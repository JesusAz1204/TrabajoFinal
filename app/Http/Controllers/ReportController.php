<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $me = Auth::user();
        if (!$me instanceof User) {
            abort(403);
        }

        $tx = $me->transactions()->latest('occurred_at')->get();

        $incomeTotal = $tx->where('status', 'completed')
            ->where('amount', '>', 0)
            ->sum('amount');

        // Puedes cambiar esto después por lógica real:
        $projectsCompleted = $me->opportunities()->count();
        $proposalsSent = 35; // demo
        $ratingAvg = 4.9;    // demo

        return view('reports.index', compact(
            'tx',
            'incomeTotal',
            'projectsCompleted',
            'proposalsSent',
            'ratingAvg'
        ));
    }
}
