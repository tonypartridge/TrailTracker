<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lat',
        'lon',
        'address',
        'description',
        'image_path',
        'url',
        'created_by',
    ];
}
