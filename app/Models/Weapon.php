<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Weapon extends Model
{
    use HasFactory;

    protected ?string $resolvedGunImagePath = null;

    protected $fillable = [
        'weapon_category_id',
        'name',
        'slug',
        'image',
        'base_damage',
        'fire_rate',
        'mobility',
        'is_secondary',
    ];

    protected function casts(): array
    {
        return [
            'is_secondary' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(WeaponCategory::class, 'weapon_category_id');
    }

    public function attachments(): BelongsToMany
    {
        return $this->belongsToMany(Attachment::class, 'weapon_attachments')
            ->withPivot('attachment_slot_id')
            ->withTimestamps();
    }

    public function primaryLoadouts(): HasMany
    {
        return $this->hasMany(Loadout::class, 'primary_weapon_id');
    }

    public function secondaryLoadouts(): HasMany
    {
        return $this->hasMany(Loadout::class, 'secondary_weapon_id');
    }

    public function gunImagePath(): string
    {
        if ($this->resolvedGunImagePath !== null) {
            return $this->resolvedGunImagePath;
        }

        if (! empty($this->image) && file_exists(public_path($this->image))) {
            return $this->resolvedGunImagePath = ltrim($this->image, '/');
        }

        foreach ($this->gunImagePathCandidates() as $candidate) {
            if (file_exists(public_path($candidate))) {
                return $this->resolvedGunImagePath = $candidate;
            }
        }

        return $this->resolvedGunImagePath = 'images/df2.webp';
    }

    private function gunImagePathCandidates(): array
    {
        $extensions = ['webp', 'jpg', 'jpeg', 'png'];
        $paths = [];

        foreach ($this->categoryDirectoryCandidates() as $directory) {
            foreach ($this->weaponFileNameCandidates() as $fileName) {
                foreach ($extensions as $extension) {
                    $paths[] = "images/guns/{$directory}/{$fileName}.{$extension}";
                }
            }
        }

        return array_values(array_unique($paths));
    }

    private function categoryDirectoryCandidates(): array
    {
        $slug = (string) ($this->category?->slug ?? '');
        $name = (string) ($this->category?->name ?? '');

        $mapped = match ($slug) {
            'shotgun' => ['Shotgun', 'Shoutgun'],
            'marksman' => ['Marksman', 'Marksman Rifle'],
            'pistol' => ['Pistol', 'Pistols', 'pistols'],
            'assault-rifle' => ['Assault Rifle'],
            'smg' => ['SMG'],
            'lmg' => ['LMG'],
            'sniper' => ['Sniper'],
            default => [],
        };

        return array_values(array_unique(array_filter([
            ...$mapped,
            $name,
            Str::title($slug),
        ])));
    }

    private function weaponFileNameCandidates(): array
    {
        $aliases = match ($this->slug) {
            'deagle' => ['Desert-Eagle'],
            'qbz-95' => ['QBZ95'],
            default => [],
        };

        $raw = [
            $this->name,
            $this->slug,
            Str::slug($this->name),
            str_replace(' ', '-', $this->name),
            preg_replace('/[^A-Za-z0-9\-.]+/', '', $this->name) ?: null,
            str_replace('-', '', $this->slug),
            Str::upper(str_replace([' ', '-'], '', $this->name)),
            ...$aliases,
        ];

        return array_values(array_unique(array_filter($raw)));
    }
}

