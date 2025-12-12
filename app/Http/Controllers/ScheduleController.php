<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with('client')->latest()->paginate(10);
        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all() ?? collect();
        return view('schedules.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('schedules.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Auto-set status and duration
        Schedule::create([
            'client_id' => $request->client_id,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            'status' => 'available', // Auto-set
            'duration' => 60, // 1 hour fixed
        ]);

        return redirect()
            ->route('schedules.index')
            ->with('success', 'Jadwal konsultasi berhasil ditambahkan dengan status "Available".');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $clients = Client::all() ?? collect();
        return view('schedules.edit', compact('schedule', 'clients'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('schedules.edit', $schedule)
                ->withErrors($validator)
                ->withInput();
        }

        // Update only allowed fields, preserve auto-managed status
        $schedule->update([
            'client_id' => $request->client_id,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            // status is NOT updated - auto-managed by system
        ]);

        return redirect()
            ->route('schedules.index')
            ->with('success', 'Jadwal konsultasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()
            ->route('schedules.index')
            ->with('success', 'Jadwal konsultasi berhasil dihapus.');
    }
}
