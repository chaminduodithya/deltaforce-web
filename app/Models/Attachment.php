<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['attachment_slot_id', 'name', 'slug', 'description', 'pros', 'cons'];

    public function slot(): BelongsTo
    {
        return $this->belongsTo(AttachmentSlot::class, 'attachment_slot_id');
    }

    public function weapons(): BelongsToMany
    {
        return $this->belongsToMany(Weapon::class, 'weapon_attachments')
            ->withPivot('attachment_slot_id')
            ->withTimestamps();
    }
}

