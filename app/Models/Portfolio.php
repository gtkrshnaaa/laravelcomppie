<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'portfolio_category_id', 'title', 'slug', 'client_name', 'client_company',
        'description', 'content', 'featured_image', 'gallery_images', 'project_date',
        'project_url', 'is_featured', 'order',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'project_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($portfolio) {
            if (empty($portfolio->slug)) {
                $portfolio->slug = Str::slug($portfolio->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->orderBy('order');
    }
}
