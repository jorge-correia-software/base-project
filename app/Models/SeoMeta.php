<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    use HasFactory;

    protected $table = 'seo_meta';

    protected $fillable = [
        'seoable_id',
        'seoable_type',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'twitter_card',
        'canonical_url',
        'no_index',
        'no_follow',
    ];

    protected $casts = [
        'no_index' => 'boolean',
        'no_follow' => 'boolean',
    ];

    /**
     * Get the parent seoable model.
     */
    public function seoable()
    {
        return $this->morphTo();
    }
}
