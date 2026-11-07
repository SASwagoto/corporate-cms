<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class BusinessUnit extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'establishment_year',
        'head_office',
        'overview',
        'website_url',
        'logo_media_id',
        'cover_media_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'head_office' => 'array',
        'overview' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function logo(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'logo_media_id');
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'cover_media_id');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoble');
    }
}