<?php

namespace Database\Seeders;

use App\Models\Weapon;
use App\Models\WeaponCategory;
use Illuminate\Database\Seeder;

class WeaponSeeder extends Seeder
{
    public function run(): void
    {
        $byCategory = [
            'assault-rifle' => [
                ['slug' => 'ak-12', 'name' => 'AK-12', 'image' => 'AK-12.webp', 'damage' => 21, 'rpm' => 735, 'mobility' => 57],
                ['slug' => 'akm', 'name' => 'AKM', 'image' => 'AKM.webp', 'damage' => 26, 'rpm' => 650, 'mobility' => 55],
                ['slug' => 'aks-74', 'name' => 'AKS-74', 'image' => 'AKS-74.webp', 'damage' => 27, 'rpm' => 533, 'mobility' => 60],
                ['slug' => 'as-val', 'name' => 'AS-Val', 'image' => 'AS-Val.webp', 'damage' => 24, 'rpm' => 900, 'mobility' => 64],
                ['slug' => 'ash-12', 'name' => 'ASh-12', 'image' => 'ASh-12.webp', 'damage' => 41, 'rpm' => 420, 'mobility' => 49],
                ['slug' => 'aug', 'name' => 'AUG', 'image' => 'AUG.webp', 'damage' => 24, 'rpm' => 710, 'mobility' => 56],
                ['slug' => 'car-15', 'name' => 'CAR-15', 'image' => 'CAR-15.webp', 'damage' => 25, 'rpm' => 632, 'mobility' => 58],
                ['slug' => 'ci-19', 'name' => 'CI-19', 'image' => 'CI-19.webp', 'damage' => 28, 'rpm' => 700, 'mobility' => 59],
                ['slug' => 'g3', 'name' => 'G3', 'image' => 'G3.webp', 'damage' => 32, 'rpm' => 500, 'mobility' => 50],
                ['slug' => 'k416', 'name' => 'K416', 'image' => 'K416.webp', 'damage' => 24, 'rpm' => 780, 'mobility' => 59],
                ['slug' => 'k437', 'name' => 'K437', 'image' => 'K437.webp', 'damage' => 23, 'rpm' => 790, 'mobility' => 60],
                ['slug' => 'kc17', 'name' => 'KC17', 'image' => 'KC17.webp', 'damage' => 30, 'rpm' => 600, 'mobility' => 54],
                ['slug' => 'm16a4', 'name' => 'M16A4', 'image' => 'M16A4.webp', 'damage' => 25, 'rpm' => 672, 'mobility' => 56],
                ['slug' => 'm4a1', 'name' => 'M4A1', 'image' => 'M4A1.webp', 'damage' => 20, 'rpm' => 800, 'mobility' => 58],
                ['slug' => 'm7', 'name' => 'M7', 'image' => 'M7.webp', 'damage' => 26, 'rpm' => 670, 'mobility' => 55],
                ['slug' => 'mcx-lt', 'name' => 'MCX-LT', 'image' => 'MCX-LT.webp', 'damage' => 24, 'rpm' => 760, 'mobility' => 58],
                ['slug' => 'mk47', 'name' => 'MK47', 'image' => 'MK47.webp', 'damage' => 31, 'rpm' => 550, 'mobility' => 53],
                ['slug' => 'ptr-32', 'name' => 'PTR-32', 'image' => 'PTR-32.webp', 'damage' => 34, 'rpm' => 500, 'mobility' => 50],
                ['slug' => 'qbz-95', 'name' => 'QBZ95', 'image' => 'QBZ95.webp', 'damage' => 22, 'rpm' => 679, 'mobility' => 55],
                ['slug' => 'scar-h', 'name' => 'SCAR-H', 'image' => 'SCAR-H.webp', 'damage' => 33, 'rpm' => 560, 'mobility' => 52],
                ['slug' => 'sg552', 'name' => 'SG552', 'image' => 'SG552.webp', 'damage' => 19, 'rpm' => 906, 'mobility' => 61],
            ],
            'smg' => [
                ['slug' => 'bizon', 'name' => 'Bizon', 'image' => 'Bizon.webp', 'damage' => 25, 'rpm' => 659, 'mobility' => 62],
                ['slug' => 'mk4', 'name' => 'MK4', 'image' => 'MK4.webp', 'damage' => 34, 'rpm' => 793, 'mobility' => 60],
                ['slug' => 'mp5', 'name' => 'MP5', 'image' => 'MP5.webp', 'damage' => 26, 'rpm' => 820, 'mobility' => 66],
                ['slug' => 'mp7', 'name' => 'MP7', 'image' => 'MP7.webp', 'damage' => 20, 'rpm' => 950, 'mobility' => 67],
                ['slug' => 'p90', 'name' => 'P90', 'image' => 'P90.webp', 'damage' => 22, 'rpm' => 898, 'mobility' => 56],
                ['slug' => 'qcq171', 'name' => 'QCQ171', 'image' => 'QCQ171.webp', 'damage' => 25, 'rpm' => 763, 'mobility' => 55],
                ['slug' => 'smg-45', 'name' => 'SMG-45', 'image' => 'SMG-45.webp', 'damage' => 26, 'rpm' => 605, 'mobility' => 70],
                ['slug' => 'sr-3m', 'name' => 'SR-3M', 'image' => 'SR-3M.webp', 'damage' => 27, 'rpm' => 747, 'mobility' => 68],
                ['slug' => 'uzi', 'name' => 'UZI', 'image' => 'UZI.webp', 'damage' => 24, 'rpm' => 780, 'mobility' => 68],
                ['slug' => 'vector', 'name' => 'Vector', 'image' => 'Vector.webp', 'damage' => 20, 'rpm' => 1091, 'mobility' => 69],
                ['slug' => 'vityaz', 'name' => 'Vityaz', 'image' => 'Vityaz.webp', 'damage' => 25, 'rpm' => 700, 'mobility' => 63],
            ],
            'sniper' => [
                ['slug' => 'awm', 'name' => 'AWM', 'image' => 'AWM.webp', 'damage' => 100, 'rpm' => 35, 'mobility' => 44],
                ['slug' => 'm700', 'name' => 'M700', 'image' => 'M700.webp', 'damage' => 72, 'rpm' => 48, 'mobility' => 48],
                ['slug' => 'r93', 'name' => 'R93', 'image' => 'R93.webp', 'damage' => 100, 'rpm' => 56, 'mobility' => 57],
                ['slug' => 'sv-98', 'name' => 'SV-98', 'image' => 'SV-98.webp', 'damage' => 76, 'rpm' => 44, 'mobility' => 49],
            ],
            'lmg' => [
                ['slug' => 'm249', 'name' => 'M249', 'image' => 'M249.webp', 'damage' => 20, 'rpm' => 858, 'mobility' => 47],
                ['slug' => 'm250', 'name' => 'M250', 'image' => 'M250.webp', 'damage' => 34, 'rpm' => 550, 'mobility' => 38],
                ['slug' => 'pkm', 'name' => 'PKM', 'image' => 'PKM.webp', 'damage' => 25, 'rpm' => 669, 'mobility' => 42],
                ['slug' => 'qjb201', 'name' => 'QJB201', 'image' => 'QJB201.webp', 'damage' => 21, 'rpm' => 785, 'mobility' => 50],
            ],
            'shotgun' => [
                ['slug' => '725', 'name' => '725', 'image' => '725-Double-Barrel-Shotgun.webp', 'damage' => 34, 'rpm' => 375, 'mobility' => 50],
                ['slug' => 'm1014', 'name' => 'M1014', 'image' => 'M1014.webp', 'damage' => 20, 'rpm' => 261, 'mobility' => 53],
                ['slug' => 'm870', 'name' => 'M870', 'image' => 'M870.webp', 'damage' => 30, 'rpm' => 74, 'mobility' => 57],
                ['slug' => 's12k', 'name' => 'S12K', 'image' => 'S12K.webp', 'damage' => 17, 'rpm' => 300, 'mobility' => 49],
            ],
            'marksman' => [
                ['slug' => 'm14', 'name' => 'M14', 'image' => 'M14.webp', 'damage' => 27, 'rpm' => 727, 'mobility' => 58],
                ['slug' => 'marlin-lever-action', 'name' => 'Marlin Lever Action', 'image' => 'Marlin-Lever-action-Rifle.webp', 'damage' => 35, 'rpm' => 100, 'mobility' => 55],
                ['slug' => 'mini-14', 'name' => 'Mini-14', 'image' => 'Mini-14.webp', 'damage' => 25, 'rpm' => 590, 'mobility' => 52],
                ['slug' => 'psg-1', 'name' => 'PSG-1', 'image' => 'PSG-1.webp', 'damage' => 35, 'rpm' => 300, 'mobility' => 49],
                ['slug' => 'sks', 'name' => 'SKS', 'image' => 'SKS.webp', 'damage' => 27, 'rpm' => 510, 'mobility' => 55],
                ['slug' => 'sr-25', 'name' => 'SR-25', 'image' => 'SR-25.webp', 'damage' => 35, 'rpm' => 364, 'mobility' => 56],
                ['slug' => 'sr9', 'name' => 'SR9', 'image' => 'SR9.webp', 'damage' => 35, 'rpm' => 361, 'mobility' => 43],
                ['slug' => 'svd', 'name' => 'SVD', 'image' => 'SVD.webp', 'damage' => 40, 'rpm' => 300, 'mobility' => 48],
                ['slug' => 'vss', 'name' => 'VSS', 'image' => 'VSS.webp', 'damage' => 33, 'rpm' => 480, 'mobility' => 54],
            ],
            'pistol' => [
                ['slug' => '357-revolver', 'name' => '.357 Revolver', 'image' => '.357-Revolve.webp', 'damage' => 52, 'rpm' => 182, 'mobility' => 62],
                ['slug' => '93r', 'name' => '93R', 'image' => '93R.webp', 'damage' => 25, 'rpm' => 672, 'mobility' => 67],
                ['slug' => 'deagle', 'name' => 'Desert Eagle', 'image' => 'Desert-Eagle.webp', 'damage' => 50, 'rpm' => 207, 'mobility' => 66],
                ['slug' => 'g17', 'name' => 'G17', 'image' => 'G17.webp', 'damage' => 33, 'rpm' => 462, 'mobility' => 70],
                ['slug' => 'g18', 'name' => 'G18', 'image' => 'G18.webp', 'damage' => 14, 'rpm' => 1172, 'mobility' => 62],
                ['slug' => 'm1911', 'name' => 'M1911', 'image' => 'M1911.webp', 'damage' => 35, 'rpm' => 373, 'mobility' => 65],
                ['slug' => 'qsz-92g', 'name' => 'QSZ-92G', 'image' => 'QSZ-92G.webp', 'damage' => 34, 'rpm' => 375, 'mobility' => 64],
            ],
        ];

        $categoryImageFolders = [
            'assault-rifle' => 'Assault Rifle',
            'smg' => 'SMG',
            'sniper' => 'Sniper',
            'lmg' => 'LMG',
            'shotgun' => 'Shoutgun',
            'marksman' => 'Marksman Rifle',
            'pistol' => 'pistols',
        ];

        foreach ($byCategory as $categorySlug => $names) {
            $category = WeaponCategory::query()->where('slug', $categorySlug)->firstOrFail();
            $imageFolder = $categoryImageFolders[$categorySlug];

            foreach ($names as $weapon) {
                Weapon::query()->updateOrCreate(
                    ['slug' => $weapon['slug']],
                    [
                        'weapon_category_id' => $category->id,
                        'name' => $weapon['name'],
                        'image' => "images/guns/{$imageFolder}/{$weapon['image']}",
                        'base_damage' => $weapon['damage'],
                        'fire_rate' => $weapon['rpm'],
                        'mobility' => $weapon['mobility'],
                        'is_secondary' => $categorySlug === 'pistol',
                    ]
                );
            }
        }
    }
}

