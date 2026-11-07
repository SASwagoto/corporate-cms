<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_type',
        'schema_version',
        'order',
        'is_active',
        'is_global',
        'global_reference_key',
        'settings',
        'content',
    ];

    protected $casts = [
        'schema_version' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean',
        'is_global' => 'boolean',
        'settings' => 'array',
        'content' => 'array',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}