<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


class Participants extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team'
    ];

//    public function team(): BelongsTo
//    {
//        return $this->belongsTo(Teams::class, 'team_id');
//    }

}
