<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Events extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'contact',
        'startDateTime',
        'endDateTime',
        'teams',
        'user_id',
    ];

//    protected static function boot() {
//        parent::boot();
//
//        static::creating(function ($model) {
//            $model->user_id = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
//        });
//
//    }
    public function locations(): HasMany
    {
        return $this->hasMany(EventsLocations::class, 'events_id');
        return $this->belongsToMany(EventsLocations::class, 'locations', 'id', 'locations_id', '', '');
    }
}
