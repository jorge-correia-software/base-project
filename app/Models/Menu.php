<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'location',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the menu items for the menu.
     */
    public function items()
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('order');
    }

    /**
     * Get all menu items (including children).
     */
    public function allItems()
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }

    /**
     * Check if menu can be deleted (no blocking relationships).
     */
    public function canBeDeleted(): bool
    {
        // Check if menu has items
        $itemCount = $this->allItems()->count();

        return $itemCount === 0;
    }

    /**
     * Get list of reasons why menu cannot be deleted.
     */
    public function getDeletionBlockers(): array
    {
        $blockers = [];

        $itemCount = $this->allItems()->count();
        if ($itemCount > 0) {
            $blockers[] = $itemCount . ' menu item' . ($itemCount > 1 ? 's' : '');
        }

        return $blockers;
    }
}
