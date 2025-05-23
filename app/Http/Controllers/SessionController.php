<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Schedule;
use App\Models\Topic;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::with(['client', 'topic', 'schedule'])->latest()->paginate(10);
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schedules = Schedule::whereDoesntHave('session')->get();
        $topics = Topic::all();
        $clients = Client::all();
        return view('sessions.create', compact('schedules', 'topics', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'schedule_id' => 'required|exists:schedules,id',
            'client_id' => 'required|exists:clients,id',
            'topic_id' => 'required|exists:topics,id',
            'summary' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('sessions.create')
                ->withErrors($validator)
                ->withInput();
        }

        $session = Session::create($request->all());

        // Update schedule status jika session selesai
        if ($request->status === 'completed') {
            $session->schedule->update(['status' => 'completed']);
        }

        return redirect()
            ->route('sessions.index')
            ->with('success', 'Sesi konsultasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        $session->load(['client', 'topic', 'schedule', 'attachments']);
        return view('sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        $schedules = Schedule::whereDoesntHave('session')
            ->orWhere('id', $session->schedule_id)
            ->get();
        $topics = Topic::all();
        $clients = Client::all();
        return view('sessions.edit', compact('session', 'schedules', 'topics', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
        $validator = Validator::make($request->all(), [
            'schedule_id' => 'required|exists:schedules,id',
            'client_id' => 'required|exists:clients,id',
            'topic_id' => 'required|exists:topics,id',
            'summary' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('sessions.edit', $session)
                ->withErrors($validator)
                ->withInput();
        }

        $session->update($request->all());

        // Update schedule status jika session selesai
        if ($request->status === 'completed') {
            $session->schedule->update(['status' => 'completed']);
        }

        return redirect()
            ->route('sessions.index')
            ->with('success', 'Sesi konsultasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        // Reset schedule status jika session dihapus
        if ($session->schedule) {
            $session->schedule->update(['status' => 'pending']);
        }

        $session->delete();

        return redirect()
            ->route('sessions.index')
            ->with('success', 'Sesi konsultasi berhasil dihapus.');
    }
}
