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
        'summary',
        'notes',
        'status'
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

    // Relasi dengan Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relasi dengan Topic
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    // Relasi dengan Attachment
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
