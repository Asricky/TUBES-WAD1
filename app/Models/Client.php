<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'notes'
    ];

    // Relasi dengan Schedule
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // Relasi dengan Session
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
