<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'category',
        'image_url',
        'author_name',
        'author_avatar',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
