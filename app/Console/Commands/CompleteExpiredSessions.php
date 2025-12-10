<?php

namespace App\Console\Commands;

use App\Models\Session;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompleteExpiredSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sessions:complete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark sessions as completed after their scheduled time + duration has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired sessions...');
        
        $expiredSessions = Session::where('status', 'booked')
            ->whereHas('schedule', function($query) {
                // Find sessions where scheduled_time + duration < now
                $query->whereRaw("CONCAT(date, ' ', time) < DATE_SUB(NOW(), INTERVAL duration MINUTE)");
            })
            ->with('schedule')
            ->get();
        
        $count = 0;
        
        foreach ($expiredSessions as $session) {
            try {
                DB::transaction(function () use ($session) {
                    // Update session status
                    $session->update(['status' => 'completed']);
                    
                    // Update schedule status
                    $session->schedule->update(['status' => 'completed']);
                });
                
                $count++;
                $this->info("Completed session ID: {$session->id}");
            } catch (\Exception $e) {
                $this->error("Failed to complete session ID {$session->id}: {$e->getMessage()}");
            }
        }
        
        $this->info("Successfully completed {$count} expired sessions.");
        
        return Command::SUCCESS;
    }
}
