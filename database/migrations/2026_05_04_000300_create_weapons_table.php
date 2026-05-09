<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weapons', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('weapon_category_id')->constrained()->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->string('image')->nullable();
            $table->unsignedSmallInteger('base_damage')->nullable();
            $table->unsignedSmallInteger('fire_rate')->nullable();
            $table->unsignedSmallInteger('mobility')->nullable();
            $table->boolean('is_secondary')->default(false);
            $table->timestamps();
            $table->index(['weapon_category_id', 'is_secondary']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weapons');
    }
};
