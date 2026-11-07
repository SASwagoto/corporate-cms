<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_asset_id')->constrained('media_assets')->restrictOnDelete();
            $table->string('usable_type', 150);
            $table->unsignedBigInteger('usable_id');
            $table->string('field_name', 100);
            $table->timestamps();

            $table->index(['usable_type', 'usable_id']);
            $table->index('media_asset_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_usages');
    }
};