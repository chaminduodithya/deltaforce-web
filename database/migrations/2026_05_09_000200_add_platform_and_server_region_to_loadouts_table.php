<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loadouts', function (Blueprint $table): void {
            $table->enum('platform', ['pc', 'mobile'])->default('pc')->after('playstyle');
            $table->enum('server_region', ['garena', 'timi'])->default('garena')->after('platform');
            $table->index(['platform', 'server_region'], 'loadouts_platform_server_index');
        });
    }

    public function down(): void
    {
        Schema::table('loadouts', function (Blueprint $table): void {
            $table->dropIndex('loadouts_platform_server_index');
            $table->dropColumn(['platform', 'server_region']);
        });
    }
};

