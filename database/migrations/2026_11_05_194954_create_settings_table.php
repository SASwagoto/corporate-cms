<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group', 50);
            $table->string('key', 100)->unique();
            $table->longText('value')->nullable();
            $table->string('type', 30)->default('text');
            $table->boolean('is_autoload')->default(true);
            $table->timestamps();

            $table->index(['group', 'is_autoload']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};