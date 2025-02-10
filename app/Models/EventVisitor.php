<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventVisitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'ip_address',
        'country',
        'city',
        'device',
        'browser',
    ];
}
