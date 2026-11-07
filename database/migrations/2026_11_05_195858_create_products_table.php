<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('slug', 255)->unique();
            $table->string('part_number', 100)->nullable();
            $table->json('technical_specifications')->nullable();
            $table->foreignId('featured_image_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->foreignId('brochure_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'part_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};