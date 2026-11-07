<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_metas', function (Blueprint $table) {
            $table->id();
            $table->string('seoble_type', 150);
            $table->unsignedBigInteger('seoble_id');
            $table->json('meta_title');
            $table->json('meta_description');
            $table->string('canonical_url', 500)->nullable();
            $table->boolean('robots_index')->default(true);
            $table->boolean('robots_follow')->default(true);
            $table->string('robots_advanced', 150)->default('max-snippet:-1, max-image-preview:large, max-video-preview:-1');
            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();
            $table->foreignId('og_image_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->string('twitter_card', 30)->default('summary_large_image');
            $table->string('schema_type', 100)->default('WebPage');
            $table->json('custom_json_ld')->nullable();
            $table->json('ai_extract_summary')->nullable();
            $table->boolean('sitemap_include')->default(true);
            $table->decimal('sitemap_priority', 2, 1)->default(0.8);
            $table->enum('sitemap_changefreq', ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'])->default('weekly');
            $table->timestamps();

            $table->unique(['seoble_type', 'seoble_id'], 'idx_seo_polymorphic');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_metas');
    }
};