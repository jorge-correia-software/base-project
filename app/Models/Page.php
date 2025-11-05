<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image_id',
        'author_id',
        'parent_id',
        'template',
        'status',
        'order',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'order' => 'integer',
    ];

    /**
     * Get the author of the page.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the featured image.
     */
    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'featured_image_id');
    }

    /**
     * Get the parent page.
     */
    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * Get the child pages.
     */
    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    /**
     * Get the SEO meta for the page.
     */
    public function seo()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    /**
     * Scope for published pages.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    /**
     * Check if the page can be permanently deleted.
     */
    public function canBeDeleted(): bool
    {
        // Check if page has child pages
        return $this->children()->count() === 0;
    }

    /**
     * Get a list of reasons why the page cannot be deleted.
     */
    public function getDeletionBlockers(): array
    {
        $blockers = [];

        $childCount = $this->children()->count();
        if ($childCount > 0) {
            $blockers[] = $childCount . ' child page' . ($childCount > 1 ? 's' : '');
        }

        return $blockers;
    }
}
