<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weapon_attachments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('weapon_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attachment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attachment_slot_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['weapon_id', 'attachment_id']);
            $table->index(['weapon_id', 'attachment_slot_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weapon_attachments');
    }
};

