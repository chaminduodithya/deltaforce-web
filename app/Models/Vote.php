<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'loadout_id', 'value'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function loadout(): BelongsTo
    {
        return $this->belongsTo(Loadout::class);
    }
}

