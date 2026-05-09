<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameMode extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function loadouts(): HasMany
    {
        return $this->hasMany(Loadout::class);
    }
}

