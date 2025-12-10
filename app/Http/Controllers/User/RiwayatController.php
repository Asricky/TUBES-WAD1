<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Session::with(['schedule', 'client', 'topic'])
            ->where('user_id', $user->id);
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by topic
        if ($request->has('topic_id') && $request->topic_id) {
            $query->where('topic_id', $request->topic_id);
        }
        
        // Filter by month
        if ($request->has('month') && $request->month) {
            $query->whereMonth('created_at', $request->month);
        }
        
        $sessions = $query->latest()->paginate(10);
        
        return view('user.riwayat', compact('sessions'));
    }
    
    public function show(Session $session)
    {
        // Ensure user can only view their own sessions
        if ($session->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }
        
        return view('user.riwayat-detail', compact('session'));
    }
}
