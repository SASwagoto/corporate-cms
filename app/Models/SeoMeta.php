<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMeta extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'seo_metas';

    protected $fillable = [
        'seoble_type',
        'seoble_id',
        'meta_title',
        'meta_description',
        'canonical_url',
        'robots_index',
        'robots_follow',
        'robots_advanced',
        'og_title',
        'og_description',
        'og_image_id',
        'twitter_card',
        'schema_type',
        'custom_json_ld',
        'ai_extract_summary',
        'sitemap_include',
        'sitemap_priority',
        'sitemap_changefreq',
    ];

    protected $casts = [
        'meta_title' => 'array',
        'meta_description' => 'array',
        'og_title' => 'array',
        'og_description' => 'array',
        'ai_extract_summary' => 'array',
        'custom_json_ld' => 'array',
        'robots_index' => 'boolean',
        'robots_follow' => 'boolean',
        'sitemap_include' => 'boolean',
        'sitemap_priority' => 'float',
    ];

    public function seoble(): MorphTo
    {
        return $this->morphTo();
    }

    public function ogImage(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'og_image_id');
    }
}