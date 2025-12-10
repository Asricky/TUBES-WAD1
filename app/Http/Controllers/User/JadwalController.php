<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Client;
use App\Models\Topic;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with(['client'])
            ->where('status', 'available')
            ->where('date', '>=', now()->toDateString());
        
        // Filter by date
        if ($request->has('date') && $request->date) {
            $query->whereDate('date', $request->date);
        }
        
        // Filter by client (konselor)
        if ($request->has('client_id') && $request->client_id) {
            $query->where('client_id', $request->client_id);
        }
        
        $schedules = $query->orderBy('date')->orderBy('time')->paginate(10);
        
        // Get list of clients for filter
        $clients = Client::orderBy('name')->get();
        $topics = Topic::orderBy('name')->get();
        
        return view('user.jadwal', compact('schedules', 'clients', 'topics'));
    }
}
