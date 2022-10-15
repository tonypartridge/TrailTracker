<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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
        'location'
    ];
}
