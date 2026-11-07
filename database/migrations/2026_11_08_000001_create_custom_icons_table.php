<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_icons', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('type', 30)->default('file'); // 'file' or 'svg'
            $table->string('file_path', 500)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->mediumText('svg_code')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('type');
        });

        // Migrate any legacy custom icons from media_assets safely
        try {
            $legacyIcons = DB::table('media_assets')->where('folder', 'custom-icons')->get();
            foreach ($legacyIcons as $icon) {
                $isRaw = str_starts_with($icon->file_path, 'raw_svg:');
                $title = $icon->file_name;
                if ($icon->title) {
                    $decoded = json_decode($icon->title, true);
                    $title = is_array($decoded) ? ($decoded['en'] ?? array_values($decoded)[0] ?? $title) : $icon->title;
                }

                $svgCode = null;
                if ($isRaw && $icon->caption) {
                    $decodedCap = json_decode($icon->caption, true);
                    $svgCode = is_array($decodedCap) ? ($decodedCap['en'] ?? array_values($decodedCap)[0] ?? $icon->caption) : $icon->caption;
                }

                DB::table('custom_icons')->insert([
                    'title'      => $title,
                    'type'       => $isRaw ? 'svg' : 'file',
                    'file_path'  => $isRaw ? null : $icon->file_path,
                    'file_name'  => $icon->file_name,
                    'svg_code'   => $svgCode,
                    'created_by' => $icon->created_by,
                    'created_at' => $icon->created_at,
                    'updated_at' => $icon->updated_at,
                ]);
            }
        } catch (\Throwable $e) {
            // Ignore if migration fails
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_icons');
    }
};
