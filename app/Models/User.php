<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'bio',
        'preferred_platform',
        'preferred_server_region',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (self $user): bool => self::ensureUsername($user));
        static::updating(fn (self $user): bool => self::ensureUsername($user));
    }

    public function getRouteKeyName(): string
    {
        return 'username';
    }

    public function loadouts(): HasMany
    {
        return $this->hasMany(Loadout::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function copiedLoadouts(): HasMany
    {
        return $this->hasMany(LoadoutCopy::class);
    }

    private static function ensureUsername(self $user): bool
    {
        if (! empty($user->username)) {
            return true;
        }

        $base = Str::slug($user->name ?: Str::before($user->email, '@')) ?: 'operator';
        $candidate = $base;
        $suffix = 1;

        while (
            self::query()
                ->where('username', $candidate)
                ->when($user->exists, fn ($query) => $query->whereKeyNot($user->getKey()))
                ->exists()
        ) {
            $candidate = "{$base}-{$suffix}";
            $suffix++;
        }

        $user->username = $candidate;

        return true;
    }
}
