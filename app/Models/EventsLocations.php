<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsLocations extends Model
{
    use HasFactory;

    protected $fillable = [
        'sort',
        'events_id',
        'locations_id',
        'points',
    ];
}
