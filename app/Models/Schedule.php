<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date',
        'time',
        'status',
        'notes',
        'duration'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relasi dengan Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relasi dengan Session
    public function session()
    {
        return $this->hasOne(Session::class);
    }
    
    /**
     * Helper method to format time for display
     */
    public function getFormattedTimeAttribute()
    {
        // Parse time string to get H:i format
        return \Carbon\Carbon::parse($this->time)->format('H:i');
    }
}
