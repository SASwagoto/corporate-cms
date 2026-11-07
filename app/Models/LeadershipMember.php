<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadershipMember extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'designation',
        'message',
        'bio',
        'portrait_media_id',
        'linkedin_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'name' => 'array',
        'designation' => 'array',
        'message' => 'array',
        'bio' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function portrait(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'portrait_media_id');
    }
}