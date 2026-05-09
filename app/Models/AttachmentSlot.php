<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttachmentSlot extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'display_order'];

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}

