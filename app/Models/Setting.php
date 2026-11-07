<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'is_autoload',
    ];

    protected $casts = [
        'is_autoload' => 'boolean',
    ];

    protected static ?array $runtimeCache = null;

    /**
     * Ultra-fast zero-latency in-memory dictionary.
     */
    public static function allSettings(): array
    {
        if (static::$runtimeCache !== null) {
            return static::$runtimeCache;
        }

        try {
            static::$runtimeCache = static::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            static::$runtimeCache = [];
        }

        return static::$runtimeCache;
    }

    /**
     * Retrieve a setting value in 0ms directly from in-memory dictionary.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = static::allSettings();
        return $settings[$key] ?? $default;
    }

    /**
     * Set/Update setting and IMMEDIATELY flush memory & disk cache.
     */
    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group, 'type' => $type]
        );

        // Force zero-latency memory sync
        if (static::$runtimeCache !== null) {
            static::$runtimeCache[$key] = $value;
        }

        Cache::forget('cms_settings_all');
        Cache::forget("setting_{$key}");

        return $setting;
    }

    /**
     * Clear all setting caches explicitly.
     */
    public static function flushCache(): void
    {
        static::$runtimeCache = null;
        Cache::forget('cms_settings_all');
    }
}