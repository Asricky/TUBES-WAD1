<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Schedule;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('clients.create')
                ->withErrors($validator)
                ->withInput();
        }

        Client::create($request->all());

        return redirect()
            ->route('clients.index')
            ->with('success', 'Data klien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        // Validate client data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'notes' => 'nullable|string',
            'schedule.*' => 'nullable|date',
            'session.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('clients.edit', $client)
                ->withErrors($validator)
                ->withInput();
        }

        // Update client information
        $client->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,
        ]);

        // Update schedules (Jadwal Konsultasi)
        foreach ($request->schedule as $scheduleId => $scheduleDate) {
            $schedule = Schedule::find($scheduleId);
            if ($schedule) {
                $schedule->update([
                    'date' => $scheduleDate,
                ]);
            }
        }

        // Update session history (Riwayat Konsultasi)
        foreach ($request->session as $sessionId => $sessionNotes) {
            $session = Session::find($sessionId);
            if ($session) {
                $session->update([
                    'notes' => $sessionNotes,
                ]);
            }
        }

        return redirect()
            ->route('clients.index')
            ->with('success', 'Data klien dan data terkait berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Data klien berhasil dihapus.');
    }
}
