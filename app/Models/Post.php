<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'category_id',
        'featured_image_id',
        'author_id',
        'status',
        'views',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    /**
     * Get the author of the post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the category of the post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the tags for the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Get the featured image.
     */
    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'featured_image_id');
    }

    /**
     * Get the SEO meta for the post.
     */
    public function seo()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    /**
     * Scope for published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope for draft posts.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Check if post can be deleted (no blocking relationships).
     */
    public function canBeDeleted(): bool
    {
        // For now, posts can always be permanently deleted
        // Add checks here if you have relationships like comments, etc.
        // Example: return $this->comments()->count() === 0;
        return true;
    }

    /**
     * Get list of reasons why post cannot be deleted.
     */
    public function getDeletionBlockers(): array
    {
        $blockers = [];

        // Add relationship checks here if needed
        // Example:
        // $commentCount = $this->comments()->count();
        // if ($commentCount > 0) {
        //     $blockers[] = $commentCount . ' comment' . ($commentCount > 1 ? 's' : '');
        // }

        return $blockers;
    }
}
