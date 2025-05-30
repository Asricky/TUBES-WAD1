<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'file_name',
        'file_path',
        'file_type',
        'description'
    ];

    // Relasi dengan Session
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
} 