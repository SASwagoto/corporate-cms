<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Service extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'short_summary',
        'content',
        'featured_image_id',
        'is_featured',
        'order',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'short_summary' => 'array',
        'content' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'featured_image_id');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoble');
    }

    public function getDisplayTitleAttribute(): string
    {
        $val = $this->getTranslation('title');
        if (is_array($val)) {
            return $val['en'] ?? reset($val) ?? '';
        }
        return (string) ($val ?? '');
    }

    public function getDisplaySummaryAttribute(): string
    {
        $val = $this->getTranslation('short_summary');
        if (is_array($val)) {
            return $val['en'] ?? reset($val) ?? '';
        }
        return (string) ($val ?? '');
    }

    public function getDisplayContentAttribute(): string
    {
        $val = $this->getTranslation('content');
        if (is_array($val)) {
            return $val['en'] ?? reset($val) ?? '';
        }
        return (string) ($val ?? '');
    }
}