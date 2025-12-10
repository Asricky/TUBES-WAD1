<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get statistics
        $totalSessions = Session::where('user_id', $user->id)->count();
        $completedSessions = Session::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        $upcomingSchedules = Session::where('user_id', $user->id)
            ->whereIn('status', ['scheduled', 'in_progress'])
            ->count();
        $thisMonthSessions = Session::where('user_id', $user->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Get upcoming sessions
        $upcomingSessions = Session::with(['schedule', 'client', 'topic'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['scheduled', 'in_progress'])
            ->latest()
            ->take(5)
            ->get();
        
        // Get recent sessions
        $recentSessions = Session::with(['schedule', 'client', 'topic'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        return view('user.dashboard', compact(
            'totalSessions',
            'completedSessions',
            'upcomingSchedules',
            'thisMonthSessions',
            'upcomingSessions',
            'recentSessions'
        ));
    }
}
