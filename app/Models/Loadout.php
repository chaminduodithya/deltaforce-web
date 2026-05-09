<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Loadout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'primary_weapon_id',
        'secondary_weapon_id',
        'game_mode_id',
        'operator_id',
        'playstyle',
        'platform',
        'server_region',
        'loadout_code',
        'gadget_1',
        'gadget_2',
        'armor_type',
        'ammo_type',
        'screenshot',
        'video_url',
        'avg_kd',
        'matches_tested',
        'is_meta',
        'is_featured',
        'views_count',
        'copies_count',
        'vote_score',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_meta' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
            'avg_kd' => 'decimal:2',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query->orderByDesc('vote_score')->orderByDesc('copies_count');
    }

    public function scopeTrending(Builder $query): Builder
    {
        return $query->where('published_at', '>=', now()->subDays(7))
            ->orderByDesc('vote_score')
            ->orderByDesc('views_count');
    }

    public function scopeForMode(Builder $query, string $modeSlug): Builder
    {
        return $query->whereHas('gameMode', fn (Builder $mode): Builder => $mode->where('slug', $modeSlug));
    }

    public function scopeRecommendedFor(Builder $query, self $loadout): Builder
    {
        return $query
            ->published()
            ->whereKeyNot($loadout->id)
            ->select('loadouts.*')
            ->selectRaw(
                '(
                    CASE WHEN primary_weapon_id = ? THEN 60 ELSE 0 END +
                    CASE WHEN game_mode_id = ? THEN 25 ELSE 0 END +
                    CASE WHEN playstyle = ? AND playstyle IS NOT NULL THEN 15 ELSE 0 END +
                    CASE WHEN platform = ? THEN 10 ELSE 0 END +
                    CASE WHEN server_region = ? THEN 10 ELSE 0 END +
                    (vote_score * 0.6) +
                    (copies_count * 0.25) +
                    (views_count * 0.02)
                ) as recommendation_score',
                [$loadout->primary_weapon_id, $loadout->game_mode_id, $loadout->playstyle, $loadout->platform, $loadout->server_region],
            )
            ->orderByDesc('recommendation_score')
            ->orderByDesc('vote_score')
            ->orderByDesc('copies_count');
    }

    public function recommendationReasonsFor(self $target): array
    {
        $reasons = [];

        if ($this->primary_weapon_id === $target->primary_weapon_id) {
            $reasons[] = 'Same Primary Weapon';
        }

        if ($this->game_mode_id === $target->game_mode_id) {
            $reasons[] = 'Same Game Mode';
        }

        if (! empty($this->playstyle) && $this->playstyle === $target->playstyle) {
            $reasons[] = 'Same Playstyle';
        }

        if (! empty($this->platform) && $this->platform === $target->platform) {
            $reasons[] = 'Same Platform';
        }

        if (! empty($this->server_region) && $this->server_region === $target->server_region) {
            $reasons[] = 'Same Server';
        }

        if ($this->vote_score >= 40) {
            $reasons[] = 'High Community Score';
        }

        if ($this->copies_count >= 15) {
            $reasons[] = 'Frequently Copied';
        }

        if (empty($reasons)) {
            $reasons[] = 'Strong Community Performance';
        }

        return array_slice($reasons, 0, 3);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function primaryWeapon(): BelongsTo
    {
        return $this->belongsTo(Weapon::class, 'primary_weapon_id');
    }

    public function secondaryWeapon(): BelongsTo
    {
        return $this->belongsTo(Weapon::class, 'secondary_weapon_id');
    }

    public function gameMode(): BelongsTo
    {
        return $this->belongsTo(GameMode::class);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    public function loadoutAttachments(): HasMany
    {
        return $this->hasMany(LoadoutAttachment::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}

