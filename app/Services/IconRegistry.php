<?php

namespace App\Services;

use App\Models\CustomIcon;
use App\Models\MediaAsset;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class IconRegistry
{
    protected static array $runtimeRenderCache = [];

    /**
     * Scan disk and return FontAwesome SVGs manifest (Cached permanently).
     */
    public static function getManifest(): array
    {
        return Cache::rememberForever('fa_disk_icons_manifest_v5', function () {
            $basePath = public_path('assets' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'fontawesome' . DIRECTORY_SEPARATOR . 'svgs');
            $categories = ['brands', 'solid', 'regular'];
            $manifest = [];

            foreach ($categories as $cat) {
                $dir = $basePath . DIRECTORY_SEPARATOR . $cat;
                if (File::isDirectory($dir)) {
                    $files = File::files($dir);
                    foreach ($files as $file) {
                        if ($file->getExtension() === 'svg') {
                            $name = $file->getFilenameWithoutExtension();
                            $manifest[] = [
                                'id'    => "{$cat}:{$name}",
                                'name'  => $name,
                                'cat'   => $cat,
                                'title' => ucwords(str_replace('-', ' ', $name)),
                                'url'   => "assets/plugins/fontawesome/svgs/{$cat}/{$file->getFilename()}",
                            ];
                        }
                    }
                }
            }

            return $manifest;
        });
    }

    /**
     * Retrieve all persistent custom icons from dedicated CustomIcon Database.
     */
    public static function getCustomIcons(): array
    {
        try {
            return CustomIcon::latest()->get()->map(function ($icon) {
                $isSvg = $icon->type === 'svg';
                $path = $isSvg ? "raw_svg:{$icon->id}" : ($icon->file_path ?: "custom_icon:{$icon->id}");

                return [
                    'id'         => $icon->id,
                    'path'       => $path,
                    'is_raw_svg' => $isSvg,
                    'raw_svg'    => $isSvg ? $icon->svg_code : null,
                    'name'       => $icon->title,
                    'url'        => $icon->url,
                ];
            })->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Render the icon inline (Raw SVG, Uploaded Image, or FontAwesome) with zero-latency memory cache.
     */
    public static function render(string $iconKey, string $class = 'w-4 h-4'): string
    {
        $memKey = "{$iconKey}_{$class}";
        if (isset(static::$runtimeRenderCache[$memKey])) {
            return static::$runtimeRenderCache[$memKey];
        }

        return static::$runtimeRenderCache[$memKey] = static::resolveRender($iconKey, $class);
    }

    protected static function resolveRender(string $iconKey, string $class): string
    {
        // 1. Raw Custom SVG Code (Stored in dedicated CustomIcon table or legacy MediaAsset)
        if (str_starts_with($iconKey, 'raw_svg:') || str_starts_with($iconKey, 'custom_svg:')) {
            $iconId = (int) preg_replace('/[^0-9]/', '', $iconKey);
            return Cache::rememberForever("custom_svg_render_{$iconId}_{$class}", function () use ($iconId, $class) {
                $icon = CustomIcon::find($iconId);
                if ($icon && !empty($icon->svg_code)) {
                    $svg = preg_replace('/(width|height)="[^"]*"/', '', $icon->svg_code);
                    return preg_replace('/<svg/', '<svg class="' . $class . ' shrink-0 inline-block fill-current"', $svg, 1);
                }

                // Fallback check legacy media_assets
                $legacyAsset = MediaAsset::find($iconId);
                if ($legacyAsset && !empty($legacyAsset->caption)) {
                    $cap = $legacyAsset->caption;
                    $raw = is_array($cap) ? ($cap['en'] ?? array_values($cap)[0] ?? '') : $cap;
                    if (is_string($raw) && str_contains($raw, '<svg')) {
                        $svg = preg_replace('/(width|height)="[^"]*"/', '', $raw);
                        return preg_replace('/<svg/', '<svg class="' . $class . ' shrink-0 inline-block fill-current"', $svg, 1);
                    }
                }

                return '<svg class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/></svg>';
            });
        }

        // 2. Custom Icon by ID from custom_icons table
        if (str_starts_with($iconKey, 'custom_icon:')) {
            $iconId = (int) str_replace('custom_icon:', '', $iconKey);
            $icon = CustomIcon::find($iconId);
            if ($icon && $icon->url) {
                return '<img src="' . htmlspecialchars($icon->url, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($icon->title, ENT_QUOTES, 'UTF-8') . '" class="' . $class . ' object-contain inline-block shrink-0" />';
            }
        }

        // 3. Uploaded Image Asset or Web URL
        if (str_starts_with($iconKey, 'storage/') || str_starts_with($iconKey, 'assets/') || str_starts_with($iconKey, 'http://') || str_starts_with($iconKey, 'https://') || str_starts_with($iconKey, '/')) {
            $cleanUrl = (str_starts_with($iconKey, 'http://') || str_starts_with($iconKey, 'https://')) ? $iconKey : asset(ltrim($iconKey, '/'));
            return '<img src="' . htmlspecialchars($cleanUrl, ENT_QUOTES, 'UTF-8') . '" alt="Custom Icon" class="' . $class . ' object-contain inline-block shrink-0" />';
        }

        // 4. FontAwesome Category Resolution
        if (str_contains($iconKey, ':')) {
            [$cat, $name] = explode(':', $iconKey, 2);
        } else {
            $cat = in_array($iconKey, ['linkedin', 'facebook', 'twitter', 'x-twitter', 'instagram', 'youtube', 'whatsapp', 'telegram', 'github', 'tiktok', 'wechat']) ? 'brands' : 'solid';
            $name = $iconKey;
        }

        $filePath = public_path("assets/plugins/fontawesome/svgs/{$cat}/{$name}.svg");

        if (!File::exists($filePath)) {
            $filePath = public_path("assets/plugins/fontawesome/svgs/solid/globe.svg");
            if (!File::exists($filePath)) {
                return '<svg class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/></svg>';
            }
        }

        return Cache::rememberForever("fa_svg_raw_{$cat}_{$name}_{$class}", function () use ($filePath, $class) {
            $svg = File::get($filePath);
            $svg = preg_replace('/(width|height)="[^"]*"/', '', $svg);
            
            if (str_contains($svg, '<svg')) {
                $svg = preg_replace('/<svg/', '<svg class="' . $class . ' shrink-0 inline-block fill-current"', $svg, 1);
            }

            return $svg;
        });
    }
}