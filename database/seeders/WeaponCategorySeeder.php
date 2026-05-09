<?php

namespace Database\Seeders;

use App\Models\WeaponCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WeaponCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Assault Rifle', 'SMG', 'Sniper', 'LMG', 'Shotgun', 'Marksman', 'Pistol'];

        foreach ($categories as $index => $name) {
            WeaponCategory::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'icon' => "icons/{$index}.svg",
                    'display_order' => $index + 1,
                ]
            );
        }
    }
}

