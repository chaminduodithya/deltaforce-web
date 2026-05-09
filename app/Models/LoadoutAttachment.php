<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoadoutAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['loadout_id', 'attachment_id', 'attachment_slot_id', 'weapon_type'];

    public function loadout(): BelongsTo
    {
        return $this->belongsTo(Loadout::class);
    }

    public function attachment(): BelongsTo
    {
        return $this->belongsTo(Attachment::class);
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(AttachmentSlot::class, 'attachment_slot_id');
    }
}

