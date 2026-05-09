<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loadouts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title', 150);
            $table->string('slug', 200)->unique();
            $table->text('description');
            $table->foreignId('primary_weapon_id')->constrained('weapons')->restrictOnDelete();
            $table->foreignId('secondary_weapon_id')->nullable()->constrained('weapons')->nullOnDelete();
            $table->foreignId('game_mode_id')->constrained()->restrictOnDelete();
            $table->foreignId('operator_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('playstyle', ['close_range', 'mid_range', 'long_range', 'all_rounder', 'stealth', 'budget', 'meta']);
            $table->text('loadout_code')->nullable();
            $table->string('gadget_1')->nullable();
            $table->string('gadget_2')->nullable();
            $table->string('armor_type')->nullable();
            $table->string('ammo_type')->nullable();
            $table->string('screenshot')->nullable();
            $table->string('video_url')->nullable();
            $table->decimal('avg_kd', 4, 2)->nullable();
            $table->unsignedInteger('matches_tested')->default(0);
            $table->boolean('is_meta')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('copies_count')->default(0);
            $table->integer('vote_score')->default(0);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index(['game_mode_id', 'vote_score']);
            $table->index(['primary_weapon_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loadouts');
    }
};

