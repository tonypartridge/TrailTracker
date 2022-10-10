<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Records extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'event_id',
        'location_id',
        'points'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Locations::class, 'location_id');
    }
    public function team(): BelongsTo
    {
        return $this->belongsTo(Teams::class, 'team_id');
    }
}
