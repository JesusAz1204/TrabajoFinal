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

$tx = $me->transactions()->orderByDesc('created_at')->get();

        $incomeTotal = $tx->where('status', 'completed')
            ->where('amount', '>', 0)
            ->sum('amount');

        $projectsCompleted = $me->opportunities()->count();
        $proposalsSent = 35; 
        $ratingAvg = 4.9;    

        return view('reports.index', compact(
            'tx',
            'incomeTotal',
            'projectsCompleted',
            'proposalsSent',
            'ratingAvg'
        ));
    }
}
