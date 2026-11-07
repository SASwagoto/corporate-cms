<?php

namespace App\Services;

use App\Models\MediaAsset;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaStorageService
{
    /**
     * Store file safely with PNG transparency protection and WebP conversion.
     */
    public function store(UploadedFile $file, string $folder = 'general', ?string $customTitle = null, bool $autoCompress = true): MediaAsset
    {
        $hash = hash_file('sha256', $file->getRealPath());

        // 1. Deduplication Check
        $existing = MediaAsset::where('file_hash', $hash)->first();
        if ($existing) {
            return $existing;
        }

        $disk = \App\Models\Setting::get('storage_driver', 'public');
        $extension = strtolower($file->getClientOriginalExtension());
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $title = $customTitle ?: ucwords(str_replace(['-', '_'], ' ', $originalName));
        $cleanBase = Str::slug($customTitle ?: $originalName) . '-' . time();

        // 2. SVG and PDF are NEVER compressed with GD (direct storage)
        if (in_array($extension, ['svg', 'pdf'])) {
            $finalFileName = "{$cleanBase}.{$extension}";
            $path = $file->storeAs("uploads/{$folder}", $finalFileName, $disk);
            $mime = $extension === 'svg' ? 'image/svg+xml' : 'application/pdf';

            return MediaAsset::create([
                'disk'       => $disk,
                'file_path'  => $path,
                'file_name'  => $finalFileName,
                'mime_type'  => $mime,
                'file_size'  => $file->getSize(),
                'file_hash'  => $hash,
                'width'      => null,
                'height'     => null,
                'title'      => ['en' => $title],
                'alt_text'   => ['en' => $title],
                'folder'     => $folder,
                'created_by' => auth()->id(),
            ]);
        }

        // 3. For JPG / PNG / WebP: Process with GD
        if ($autoCompress && in_array($extension, ['jpg', 'jpeg', 'png', 'webp']) && function_exists('imagecreatefromstring')) {
            $compressed = $this->compressToWebp($file->getRealPath(), $extension);
            if ($compressed !== null) {
                $finalFileName = "{$cleanBase}.webp";
                $path = "uploads/{$folder}/{$finalFileName}";

                Storage::disk($disk)->put($path, $compressed['data']);

                return MediaAsset::create([
                    'disk'       => $disk,
                    'file_path'  => $path,
                    'file_name'  => $finalFileName,
                    'mime_type'  => 'image/webp',
                    'file_size'  => strlen($compressed['data']),
                    'file_hash'  => $hash,
                    'width'      => $compressed['width'],
                    'height'     => $compressed['height'],
                    'title'      => ['en' => $title],
                    'alt_text'   => ['en' => $title],
                    'folder'     => $folder,
                    'created_by' => auth()->id(),
                ]);
            }
        }

        // 4. Standard Store Fallback
        $finalFileName = "{$cleanBase}.{$extension}";
        $path = $file->storeAs("uploads/{$folder}", $finalFileName, $disk);
        $dimensions = @getimagesize($file->getRealPath());

        return MediaAsset::create([
            'disk'       => $disk,
            'file_path'  => $path,
            'file_name'  => $finalFileName,
            'mime_type'  => "image/{$extension}",
            'file_size'  => $file->getSize(),
            'file_hash'  => $hash,
            'width'      => $dimensions ? $dimensions[0] : null,
            'height'     => $dimensions ? $dimensions[1] : null,
            'title'      => ['en' => $title],
            'alt_text'   => ['en' => $title],
            'folder'     => $folder,
            'created_by' => auth()->id(),
        ]);
    }

    /**
     * High-Precision WebP Compression preserving PNG transparent alpha channels.
     */
    protected function compressToWebp(string $sourcePath, string $extension): ?array
    {
        try {
            $content = file_get_contents($sourcePath);
            $image = @imagecreatefromstring($content);
            if (!$image) return null;

            $origWidth = imagesx($image);
            $origHeight = imagesy($image);

            // Scale down if image is huge (> 2048px width)
            $maxWidth = 2048;
            if ($origWidth > $maxWidth) {
                $newWidth = $maxWidth;
                $newHeight = (int)(($origHeight / $origWidth) * $maxWidth);
                $resized = imagecreatetruecolor($newWidth, $newHeight);

                // Preserve alpha channel for transparent PNGs
                imagealphablending($resized, false);
                imagesavealpha($resized, true);

                imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                imagedestroy($image);
                $image = $resized;
                $origWidth = $newWidth;
                $origHeight = $newHeight;
            } else {
                // Preserve transparency on original size
                imagealphablending($image, false);
                imagesavealpha($image, true);
            }

            ob_start();
            imagewebp($image, null, 85);
            $data = ob_get_clean();
            imagedestroy($image);

            return [
                'data'   => $data,
                'width'  => $origWidth,
                'height' => $origHeight,
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function delete(MediaAsset $asset): bool
    {
        $cleanPath = ltrim(str_replace('storage/', '', $asset->file_path), '/');
        Storage::disk($asset->disk)->delete($cleanPath);
        return (bool) $asset->delete();
    }
}