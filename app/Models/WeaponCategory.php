<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WeaponCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'display_order'];

    public function weapons(): HasMany
    {
        return $this->hasMany(Weapon::class);
    }
}

