<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomIcon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'file_path',
        'file_name',
        'svg_code',
        'created_by',
    ];

    /**
     * Absolute public URL for file-based custom icons.
     */
    public function getUrlAttribute(): ?string
    {
        if ($this->type === 'svg' || empty($this->file_path)) {
            return null;
        }

        if (str_starts_with($this->file_path, 'http://') || str_starts_with($this->file_path, 'https://')) {
            return $this->file_path;
        }

        $cleanPath = ltrim(str_replace('storage/', '', $this->file_path), '/');

        return '/storage/' . $cleanPath;
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
