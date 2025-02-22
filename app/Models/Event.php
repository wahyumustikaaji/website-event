<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;  // Pastikan ini ada

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'city_category_id',
        'creator_id',
        'location_name',
        'address',
        'body',
        'event_date',
        'start_time',
        'end_date',
        'end_time',
        'ticket_quantity',
        'views',
        'image'
    ];

    protected $with = ['category', 'cityCategory', 'creator'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cityCategory()
    {
        return $this->belongsTo(CityCategory::class, 'city_category_id');
    }

    // Relasi dengan User (Pembuat)
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    // Relasi dengan EventParticipant
    public function participants()
    {
        return $this->hasMany(EventParticipant::class, 'event_id');
    }

    public function getParticipantsCountAttribute()
    {
        return $this->participants()->count();
    }

    public function getFormattedEventDateAndTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->event_date)->locale('id')->isoFormat('ddd, D MMM, HH.mm');
    }

    public function getFormattedEventDateAttribute()
    {
        return \Carbon\Carbon::parse($this->event_date)->locale('id')->isoFormat('dddd, D MMMM');
    }

    public function getFormattedEventTimeStartAttribute()
    {
        return \Carbon\Carbon::parse($this->start_time)->format('H:i');
    }

    public function getFormattedEventTimeEndAttribute()
    {
        return \Carbon\Carbon::parse($this->end_time)->format('H:i');
    }
}
