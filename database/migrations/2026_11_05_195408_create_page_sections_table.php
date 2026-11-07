<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->string('section_type', 100);
            $table->unsignedInteger('schema_version')->default(1);
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_global')->default(false);
            $table->string('global_reference_key', 100)->nullable();
            $table->json('settings');
            $table->json('content');
            $table->timestamps();

            $table->index(['page_id', 'is_active', 'order']);
            $table->index('section_type');
            $table->index(['is_global', 'global_reference_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};