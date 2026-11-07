<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class MediaAsset extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'disk',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'file_hash',
        'width',
        'height',
        'alt_text',
        'title',
        'caption',
        'folder',
        'created_by',
    ];

    protected $casts = [
        'alt_text'  => 'array',
        'title'     => 'array',
        'caption'   => 'array',
        'width'     => 'integer',
        'height'    => 'integer',
        'file_size' => 'integer',
    ];

    /**
     * Clean bulletproof Public URL (never duplicates 'storage/').
     */
    public function getUrlAttribute(): string
    {
        if (str_starts_with($this->file_path, 'http://') || str_starts_with($this->file_path, 'https://')) {
            return $this->file_path;
        }

        if (str_starts_with($this->file_path, 'raw_svg:')) {
            return '';
        }

        $cleanPath = ltrim(str_replace('storage/', '', $this->file_path), '/');

        if ($this->disk === 'public') {
            return asset('storage/' . $cleanPath);
        }

        return Storage::disk($this->disk)->url($cleanPath);
    }

    public function getHumanSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 1) . ' ' . ($units[$i] ?? 'MB');
    }

    public function usages(): HasMany
    {
        return $this->hasMany(MediaUsage::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}