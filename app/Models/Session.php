<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'consultation_sessions';

    protected $fillable = [
        'client_id',
        'schedule_id',
        'topic_id',
        'user_id',  // mahasiswa who booked
        'summary',
        'notes',
        'status',
        'meet_link'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi dengan Schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    // Relasi dengan Client (Konselor)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relasi dengan Topic
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    // Relasi dengan User (Mahasiswa yang booking)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Attachment
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    /**
     * Check if user can access meet link (15 min before until end time)
     */
    public function canAccessMeetLink()
    {
        if ($this->status !== 'booked' || !$this->meet_link) {
            return false;
        }

        // Parse scheduled time properly from date and time columns
        $dateStr = $this->schedule->date->format('Y-m-d');
        // Time column is stored as TIME type, get raw value
        $timeStr = $this->schedule->time;
        
        // Combine date and time, explicitly set timezone
        $scheduledTime = \Carbon\Carbon::parse($dateStr . ' ' . $timeStr, config('app.timezone', 'Asia/Jakarta'));
        $now = \Carbon\Carbon::now(config('app.timezone', 'Asia/Jakarta'));
        
        // Access 15 minutes before until end time
        $canAccessFrom = $scheduledTime->copy()->subMinutes(15);
        $canAccessUntil = $scheduledTime->copy()->addMinutes($this->schedule->duration ?? 60);
        
        // Debug log
        \Log::info('Meet Link Access Check', [
            'scheduled' => $scheduledTime->format('Y-m-d H:i:s'),
            'now' => $now->format('Y-m-d H:i:s'),
            'can_access_from' => $canAccessFrom->format('Y-m-d H:i:s'),
            'can_access_until' => $canAccessUntil->format('Y-m-d H:i:s'),
            'result' => $now->between($canAccessFrom, $canAccessUntil)
        ]);
        
        return $now->between($canAccessFrom, $canAccessUntil);
    }

    /**
     * Get meeting time information
     */
    public function getMeetingTimeInfo()
    {
        // Parse scheduled time properly from date and time columns
        $dateStr = $this->schedule->date->format('Y-m-d');
        // Time column is stored as TIME type, get raw value
        $timeStr = $this->schedule->time;
        $scheduledTime = \Carbon\Carbon::parse($dateStr . ' ' . $timeStr);
        
        $duration = $this->schedule->duration ?? 60;
        $endTime = $scheduledTime->copy()->addMinutes($duration);
        
        return [
            'start' => $scheduledTime,
            'end' => $endTime,
            'can_join' => $this->canAccessMeetLink(),
            'access_from' => $scheduledTime->copy()->subMinutes(15),
        ];
    }
}
