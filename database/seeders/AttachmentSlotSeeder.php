<?php

namespace Database\Seeders;

use App\Models\AttachmentSlot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttachmentSlotSeeder extends Seeder
{
    public function run(): void
    {
        $slots = ['Barrel', 'Muzzle', 'Grip', 'Optic', 'Stock', 'Magazine', 'Laser', 'Underbarrel'];

        foreach ($slots as $index => $slot) {
            AttachmentSlot::query()->updateOrCreate(
                ['slug' => Str::slug($slot)],
                ['name' => $slot, 'display_order' => $index + 1]
            );
        }
    }
}

