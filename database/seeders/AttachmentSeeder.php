<?php

namespace Database\Seeders;

use App\Models\Attachment;
use App\Models\AttachmentSlot;
use App\Models\Weapon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttachmentSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            'barrel' => ['Extended Barrel', 'Precision Barrel', 'Short Barrel'],
            'muzzle' => ['Compensator', 'Suppressor', 'Flash Hider'],
            'grip' => ['Vertical Grip', 'Angled Grip', 'Lightweight Grip'],
            'optic' => ['Red Dot', 'Holo Sight', '4x Scope'],
            'stock' => ['Heavy Stock', 'Tactical Stock', 'Folded Stock'],
            'magazine' => ['Extended Mag', 'Fast Mag', 'Drum Mag'],
            'laser' => ['Blue Laser', 'Green Laser', 'Tac Laser'],
            'underbarrel' => ['Bipod', 'Hand Stop', 'Grenade Launcher'],
        ];

        foreach ($catalog as $slotSlug => $items) {
            $slot = AttachmentSlot::query()->where('slug', $slotSlug)->firstOrFail();
            foreach ($items as $item) {
                Attachment::query()->updateOrCreate(
                    ['slug' => Str::slug($item)],
                    [
                        'attachment_slot_id' => $slot->id,
                        'name' => $item,
                        'description' => "{$item} tuned for {$slot->name}.",
                        'pros' => 'Improves handling and control.',
                        'cons' => 'Slight trade-off in mobility.',
                    ]
                );
            }
        }

        $attachmentsBySlot = Attachment::query()->get()->groupBy('attachment_slot_id');

        Weapon::query()->each(function (Weapon $weapon) use ($attachmentsBySlot): void {
            foreach ($attachmentsBySlot as $slotId => $attachments) {
                $attachments->shuffle()->take(2)->each(function (Attachment $attachment) use ($weapon, $slotId): void {
                    $weapon->attachments()->syncWithoutDetaching([
                        $attachment->id => ['attachment_slot_id' => $slotId],
                    ]);
                });
            }
        });
    }
}

