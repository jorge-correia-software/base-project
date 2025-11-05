<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'image_url',
        'date',
        'company',
        'duration',
        'location',
        'price',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
