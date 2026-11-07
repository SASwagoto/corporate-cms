<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leadership_members', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('designation');
            $table->json('message')->nullable();
            $table->json('bio')->nullable();
            $table->foreignId('portrait_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->string('linkedin_url', 500)->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leadership_members');
    }
};