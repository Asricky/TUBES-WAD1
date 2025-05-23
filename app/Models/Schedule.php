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
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime'
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
}
