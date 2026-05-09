<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operators', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 100);
            $table->enum('class', ['assault', 'recon', 'support', 'engineer']);
            $table->string('slug', 100)->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index('class');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operators');
    }
};

