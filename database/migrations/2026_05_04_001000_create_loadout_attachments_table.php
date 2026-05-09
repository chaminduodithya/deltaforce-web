<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loadout_attachments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('loadout_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attachment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attachment_slot_id')->constrained()->cascadeOnDelete();
            $table->enum('weapon_type', ['primary', 'secondary'])->default('primary');
            $table->timestamps();
            $table->unique(['loadout_id', 'attachment_slot_id', 'weapon_type'], 'loadout_slot_weapon_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loadout_attachments');
    }
};

