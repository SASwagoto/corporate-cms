<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'part_number',
        'technical_specifications',
        'featured_image_id',
        'brochure_media_id',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'technical_specifications' => 'array',
        'is_active' => 'boolean',
    ];

    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'featured_image_id');
    }

    public function brochure(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'brochure_media_id');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoble');
    }
}