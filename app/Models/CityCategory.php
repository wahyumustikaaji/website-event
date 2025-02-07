<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CityCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'description', 'image'];

    /**
     * Relasi ke Event (Satu CityCategory memiliki banyak Event)
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'city_category_id');
    }
}
