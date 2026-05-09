<?php

namespace Database\Seeders;

use App\Models\GameMode;
use App\Models\Loadout;
use App\Models\LoadoutAttachment;
use App\Models\LoadoutCopy;
use App\Models\Operator;
use App\Models\User;
use App\Models\Vote;
use App\Models\Weapon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoLoadoutSeeder extends Seeder
{
    public function run(): void
    {
        $users = collect([
            ['name' => 'GhostRecon', 'email' => 'ghost@example.com'],
            ['name' => 'TacRunner', 'email' => 'runner@example.com'],
            ['name' => 'MetaForge', 'email' => 'meta@example.com'],
        ])->map(fn (array $user): User => User::query()->firstOrCreate(
            ['email' => $user['email']],
            ['name' => $user['name'], 'password' => bcrypt('password')]
        ));

        $modes = GameMode::query()->get()->keyBy('slug');
        $operators = Operator::query()->get();
        $primaryWeapons = Weapon::query()->where('is_secondary', false)->get();
        $secondaryWeapons = Weapon::query()->where('is_secondary', true)->get();

        if ($primaryWeapons->isEmpty() || $secondaryWeapons->isEmpty()) {
            return;
        }

        foreach (range(1, 12) as $index) {
            $mode = $modes->random();
            $primary = $primaryWeapons->random();
            $secondary = $secondaryWeapons->random();
            $title = "{$mode->name} {$primary->name} Build {$index}";

            $loadout = Loadout::query()->updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'user_id' => $users->random()->id,
                    'title' => $title,
                    'description' => "Balanced {$primary->name} setup for {$mode->name} rotations.",
                    'primary_weapon_id' => $primary->id,
                    'secondary_weapon_id' => $secondary->id,
                    'game_mode_id' => $mode->id,
                    'operator_id' => $operators->random()?->id,
                    'playstyle' => collect(['close_range', 'mid_range', 'long_range', 'all_rounder', 'stealth', 'budget', 'meta'])->random(),
                    'platform' => collect(['pc', 'mobile'])->random(),
                    'server_region' => collect(['garena', 'timi'])->random(),
                    'loadout_code' => strtoupper(Str::random(10)),
                    'gadget_1' => collect(['Smoke', 'Frag', 'Med Kit', 'Drone'])->random(),
                    'gadget_2' => collect(['Sensor', 'Ammo Box', 'C4', 'Flash'])->random(),
                    'armor_type' => collect(['Light', 'Balanced', 'Heavy'])->random(),
                    'ammo_type' => collect(['Standard', 'AP', 'HP'])->random(),
                    'avg_kd' => random_int(90, 210) / 100,
                    'matches_tested' => random_int(3, 25),
                    'is_meta' => $index % 4 === 0,
                    'is_featured' => $index % 6 === 0,
                    'views_count' => random_int(100, 1400),
                    'copies_count' => random_int(10, 300),
                    'vote_score' => random_int(5, 180),
                    'status' => 'published',
                    'published_at' => now()->subDays(random_int(0, 20)),
                ]
            );

            $attachments = $primary->attachments()->inRandomOrder()->take(4)->get();
            foreach ($attachments as $attachment) {
                LoadoutAttachment::query()->updateOrCreate(
                    [
                        'loadout_id' => $loadout->id,
                        'attachment_slot_id' => $attachment->attachment_slot_id,
                        'weapon_type' => 'primary',
                    ],
                    ['attachment_id' => $attachment->id]
                );
            }

            foreach ($users as $user) {
                if ($user->id === $loadout->user_id) {
                    continue;
                }

                $voteValue = random_int(0, 1) ? 1 : -1;
                Vote::query()->updateOrCreate(
                    ['user_id' => $user->id, 'loadout_id' => $loadout->id],
                    ['value' => $voteValue]
                );
                if ($voteValue > 0) {
                    LoadoutCopy::query()->firstOrCreate(['user_id' => $user->id, 'loadout_id' => $loadout->id]);
                }
            }
        }
    }
}
