<?php

use App\Models\GameMode;
use App\Models\Loadout;
use App\Models\LoadoutAttachment;
use App\Models\User;
use App\Models\Weapon;
use App\Models\AttachmentSlot;
use App\Models\WeaponCategory;
use App\Http\Controllers\ProfileController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

Route::get('/', function () {
    return view('pages.home', [
        'trending' => Loadout::query()->published()->trending()->with(['primaryWeapon', 'gameMode', 'user'])->take(8)->get(),
        'warfareHot' => Loadout::query()->published()->forMode('warfare')->popular()->with(['primaryWeapon', 'gameMode', 'user'])->take(4)->get(),
        'operationsHot' => Loadout::query()->published()->forMode('operations')->popular()->with(['primaryWeapon', 'gameMode', 'user'])->take(4)->get(),
        'stats' => [
            'loadouts' => Loadout::query()->count(),
            'users' => User::query()->count(),
            'copies' => Loadout::query()->sum('copies_count'),
        ],
        'categories' => WeaponCategory::query()->orderBy('display_order')->get(),
    ]);
})->name('home');

Route::get('/loadouts', function () {
    $platforms = ['pc' => 'PC', 'mobile' => 'Mobile'];
    $servers = ['garena' => 'Garena', 'timi' => 'Tencent TiMi'];

    $query = Loadout::query()
        ->published()
        ->with(['primaryWeapon.category', 'gameMode', 'user']);

    if ($search = request('q')) {
        $query->where(function (Builder $inner) use ($search): void {
            $inner->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhereHas('primaryWeapon', fn (Builder $weapon): Builder => $weapon->where('name', 'like', "%{$search}%"));
        });
    }

    if ($category = request('category')) {
        $query->whereHas('primaryWeapon.category', fn (Builder $cat): Builder => $cat->where('slug', $category));
    }

    if ($mode = request('mode')) {
        $query->whereHas('gameMode', fn (Builder $gameMode): Builder => $gameMode->where('slug', $mode));
    }

    if ($platform = request('platform')) {
        $query->where('platform', $platform);
    }

    if ($server = request('server')) {
        $query->where('server_region', $server);
    }

    match (request('sort', 'popular')) {
        'newest' => $query->orderByDesc('published_at'),
        'top-rated' => $query->orderByDesc('avg_kd'),
        'most-copied' => $query->orderByDesc('copies_count'),
        default => $query->popular(),
    };

    return view('pages.loadouts.browse', [
        'loadouts' => $query->paginate(12)->withQueryString(),
        'categories' => WeaponCategory::query()->orderBy('display_order')->get(),
        'modes' => GameMode::query()->orderBy('name')->get(),
        'platforms' => $platforms,
        'servers' => $servers,
    ]);
})->name('loadouts.browse');

Route::get('/loadouts/{loadout:slug}', function (Loadout $loadout) {
    $loadout->load([
        'user',
        'gameMode',
        'operator',
        'primaryWeapon.category',
        'secondaryWeapon',
        'loadoutAttachments.slot',
        'loadoutAttachments.attachment',
        'comments.user',
    ]);

    $loadout->increment('views_count');

    $relatedSuggestions = Loadout::query()
        ->recommendedFor($loadout)
        ->with(['primaryWeapon.category', 'gameMode', 'user'])
        ->take(5)
        ->get()
        ->map(fn (Loadout $item): array => [
            'loadout' => $item,
            'score' => (int) round((float) ($item->recommendation_score ?? 0)),
            'reasons' => $item->recommendationReasonsFor($loadout),
        ]);

    return view('pages.loadouts.show', [
        'loadout' => $loadout,
        'relatedSuggestions' => $relatedSuggestions,
    ]);
})->where('loadout', '^(?!create$).+')->name('loadouts.show');

Route::get('/weapons', function () {
    return view('pages.weapons.index', [
        'categories' => WeaponCategory::query()->with(['weapons' => fn ($query) => $query->with('category')->orderBy('name')])->orderBy('display_order')->get(),
    ]);
})->name('weapons.index');

Route::get('/weapons/{weapon:slug}', function (Weapon $weapon) {
    $weapon->load(['category', 'attachments.slot']);

    return view('pages.weapons.show', [
        'weapon' => $weapon,
        'loadouts' => Loadout::query()
            ->published()
            ->where(fn (Builder $query): Builder => $query
                ->where('primary_weapon_id', $weapon->id)
                ->orWhere('secondary_weapon_id', $weapon->id))
            ->with(['gameMode', 'user', 'primaryWeapon'])
            ->popular()
            ->paginate(10)
            ->withQueryString(),
    ]);
})->name('weapons.show');

Route::get('/user/{user:username}', function (User $user) {
    $user->load(['loadouts' => fn ($query) => $query->published()->with(['primaryWeapon', 'gameMode'])->popular()->take(12)]);

    return view('pages.profile.show', ['profileUser' => $user]);
})->name('profile.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/loadouts/create', function () {
        return view('pages.loadouts.create', [
            'categories' => WeaponCategory::query()
                ->with(['weapons' => fn ($query) => $query->where('is_secondary', false)->orderBy('name')])
                ->orderBy('display_order')
                ->get(),
            'modes' => GameMode::query()->orderBy('name')->get(),
            'secondaryWeapons' => Weapon::query()->where('is_secondary', true)->orderBy('name')->get(),
            'attachmentSlots' => AttachmentSlot::query()->with(['attachments' => fn ($query) => $query->orderBy('name')])->orderBy('display_order')->get(),
            'platforms' => ['pc' => 'PC', 'mobile' => 'Mobile'],
            'servers' => ['garena' => 'Garena', 'timi' => 'Tencent TiMi'],
        ]);
    })->name('loadouts.create');

    Route::post('/loadouts', function (Request $request) {
        $playstyles = ['close_range', 'mid_range', 'long_range', 'all_rounder', 'stealth', 'budget', 'meta'];

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'game_mode_id' => ['required', 'integer', 'exists:game_modes,id'],
            'primary_weapon_id' => ['required', 'integer', Rule::exists('weapons', 'id')->where('is_secondary', false)],
            'secondary_weapon_id' => ['nullable', 'integer', Rule::exists('weapons', 'id')->where('is_secondary', true), 'different:primary_weapon_id'],
            'playstyle' => ['required', Rule::in($playstyles)],
            'platform' => ['required', Rule::in(['pc', 'mobile'])],
            'server_region' => ['required', Rule::in(['garena', 'timi'])],
            'loadout_code' => ['nullable', 'string', 'max:255'],
            'gadget_1' => ['nullable', 'string', 'max:255'],
            'gadget_2' => ['nullable', 'string', 'max:255'],
            'armor_type' => ['nullable', 'string', 'max:255'],
            'ammo_type' => ['nullable', 'string', 'max:255'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['nullable', 'integer', 'exists:attachments,id'],
        ]);

        $primaryWeapon = Weapon::query()->whereKey($validated['primary_weapon_id'])->firstOrFail();
        $attachmentSlots = AttachmentSlot::query()->orderBy('display_order')->get();

        foreach ($attachmentSlots as $slot) {
            $attachmentId = data_get($validated, "attachments.{$slot->slug}");
            if (! $attachmentId) {
                continue;
            }

            $isValidAttachment = DB::table('weapon_attachments')
                ->where('weapon_id', $primaryWeapon->id)
                ->where('attachment_id', $attachmentId)
                ->where('attachment_slot_id', $slot->id)
                ->exists();

            if (! $isValidAttachment) {
                throw ValidationException::withMessages([
                    "attachments.{$slot->slug}" => "Selected {$slot->name} attachment is not compatible with the selected primary weapon.",
                ]);
            }
        }

        $baseSlug = Str::slug($validated['title']);
        $slugRoot = $baseSlug !== '' ? $baseSlug : "loadout-{$request->user()->id}";
        $slug = $slugRoot;
        $index = 1;
        while (Loadout::query()->where('slug', $slug)->exists()) {
            $slug = "{$slugRoot}-{$index}";
            $index++;
        }

        $loadout = DB::transaction(function () use ($validated, $request, $slug, $attachmentSlots): Loadout {
            $created = Loadout::query()->create([
                'user_id' => $request->user()->id,
                'title' => $validated['title'],
                'slug' => $slug,
                'description' => $validated['description'],
                'primary_weapon_id' => $validated['primary_weapon_id'],
                'secondary_weapon_id' => $validated['secondary_weapon_id'] ?? null,
                'game_mode_id' => $validated['game_mode_id'],
                'playstyle' => $validated['playstyle'],
                'platform' => $validated['platform'],
                'server_region' => $validated['server_region'],
                'loadout_code' => $validated['loadout_code'] ?? null,
                'gadget_1' => $validated['gadget_1'] ?? null,
                'gadget_2' => $validated['gadget_2'] ?? null,
                'armor_type' => $validated['armor_type'] ?? null,
                'ammo_type' => $validated['ammo_type'] ?? null,
                'status' => 'draft',
            ]);

            foreach ($attachmentSlots as $slot) {
                $attachmentId = data_get($validated, "attachments.{$slot->slug}");
                if (! $attachmentId) {
                    continue;
                }

                LoadoutAttachment::query()->create([
                    'loadout_id' => $created->id,
                    'attachment_id' => $attachmentId,
                    'attachment_slot_id' => $slot->id,
                    'weapon_type' => 'primary',
                ]);
            }

            return $created;
        });

        return redirect()->route('loadouts.show', $loadout);
    })->name('loadouts.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
