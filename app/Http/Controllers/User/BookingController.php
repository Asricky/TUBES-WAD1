<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Schedule $schedule)
    {
        // Check if schedule is still available
        if ($schedule->status !== 'available') {
            return redirect()->route('user.jadwal')->with('error', 'Jadwal sudah tidak tersedia.');
        }
        
        $topics = Topic::orderBy('name')->get() ?? collect();
        
        return view('user.booking.create', compact('schedule', 'topics'));
    }
    
    public function store(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'summary' => 'nullable|string|max:1000',
        ]);
        
        DB::beginTransaction();
        try {
            // Double check schedule is still available
            $schedule->refresh();
            if ($schedule->status !== 'available') {
                DB::rollBack();
                return redirect()->route('user.jadwal')->with('error', 'Jadwal sudah dibooking orang lain.');
            }
            
            // Generate meet link
            $meetLink = $this->generateMeetLink($schedule);
            
            // Create session (auto-accept with meet link)
            $session = Session::create([
                'client_id' => $schedule->client_id,
                'schedule_id' => $schedule->id,
                'topic_id' => $validated['topic_id'],
                'user_id' => Auth::id(),
                'summary' => $validated['summary'] ?? 'Menunggu konsultasi',
                'status' => 'booked', // Changed from 'scheduled' to 'booked'
                'meet_link' => $meetLink,
            ]);
            
            // Update schedule status
            $schedule->update(['status' => 'booked']);
            
            DB::commit();
            
            return redirect()->route('user.dashboard')
                ->with('success', 'Booking berhasil! Link meeting sudah tersedia di dashboard Anda.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log the error
            \Log::error('Booking error: ' . $e->getMessage(), [
                'schedule_id' => $schedule->id,
                'user_id' => auth()->id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
    /**
     * Generate unique meet link for session
     */
    private function generateMeetLink(Schedule $schedule)
    {
        $uniqueCode = \Illuminate\Support\Str::random(8);
        return "https://meet.tell2u.com/{$schedule->id}-{$uniqueCode}";
    }
    
    /**
     * Cancel booking
     */
    public function cancel(Session $session)
    {
        // Security: only session owner can cancel
        if ($session->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }
        
        // Can only cancel if status is 'booked'
        if ($session->status !== 'booked') {
            return redirect()->back()->with('error', 'Booking tidak dapat dibatalkan.');
        }
        
        DB::beginTransaction();
        try {
            // Update session status
            $session->update(['status' => 'cancelled']);
            
            // Free up the schedule slot
            $session->schedule->update(['status' => 'available']);
            
            DB::commit();
            
            return redirect()->route('user.dashboard')
                ->with('success', 'Booking berhasil dibatalkan. Slot jadwal telah tersedia kembali.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat membatalkan booking.');
        }
    }
}
