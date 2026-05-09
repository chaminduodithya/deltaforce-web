<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->enum('preferred_platform', ['pc', 'mobile'])->default('pc')->after('bio');
            $table->enum('preferred_server_region', ['garena', 'timi'])->default('garena')->after('preferred_platform');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['preferred_platform', 'preferred_server_region']);
        });
    }
};

