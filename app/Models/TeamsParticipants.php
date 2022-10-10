<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamsParticipants extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'participant_id'
    ];
}
