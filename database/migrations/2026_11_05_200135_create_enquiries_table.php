<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['general', 'service', 'career', 'quotation'])->default('general');
            $table->string('full_name', 150);
            $table->string('email', 150);
            $table->string('phone', 50)->nullable();
            $table->string('company', 150)->nullable();
            $table->string('subject', 255)->nullable();
            $table->text('message');
            $table->json('payload')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->enum('status', ['new', 'read', 'replied', 'archived'])->default('new');
            $table->timestamps();

            $table->index(['status', 'type', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};