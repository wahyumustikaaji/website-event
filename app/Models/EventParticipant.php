<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventParticipant extends Model
{
    use HasFactory;  // Pastikan ini ada

    protected $fillable = ['event_id', 'user_id', 'is_approved', 'payment_status', 'payment_receipt'];

    // Relasi ke Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
