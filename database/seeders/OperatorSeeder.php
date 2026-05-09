<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OperatorSeeder extends Seeder
{
    public function run(): void
    {
        $operators = [
            ['name' => 'Vyron', 'class' => 'assault'],
            ['name' => 'Luna', 'class' => 'recon'],
            ['name' => 'Shepherd', 'class' => 'support'],
            ['name' => 'Rook', 'class' => 'engineer'],
            ['name' => 'Stinger', 'class' => 'assault'],
            ['name' => 'Mender', 'class' => 'support'],
        ];

        foreach ($operators as $operator) {
            Operator::query()->updateOrCreate(
                ['slug' => Str::slug($operator['name'])],
                $operator + ['description' => "{$operator['name']} specialist profile."]
            );
        }
    }
}

