<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Events;

class Teams extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'members',
        'event_id'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(TeamsParticipants::class, 'team_id');
    }
}
