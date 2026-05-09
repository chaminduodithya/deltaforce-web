<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('attachment_slot_id')->constrained()->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->text('pros')->nullable();
            $table->text('cons')->nullable();
            $table->timestamps();
            $table->index('attachment_slot_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};

