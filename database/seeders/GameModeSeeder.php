<?php

namespace Database\Seeders;

use App\Models\GameMode;
use Illuminate\Database\Seeder;

class GameModeSeeder extends Seeder
{
    public function run(): void
    {
        GameMode::query()->updateOrCreate(
            ['slug' => 'warfare'],
            ['name' => 'Warfare', 'description' => 'Large scale objective combat.']
        );
        GameMode::query()->updateOrCreate(
            ['slug' => 'operations'],
            ['name' => 'Operations', 'description' => 'Tactical mode with tighter engagements.']
        );
    }
}

