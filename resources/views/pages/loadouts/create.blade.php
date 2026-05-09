<x-app-layout>
    <div class="df-panel p-6">
        <h1 class="df-section-title text-2xl">Create Loadout</h1>
        <p class="mt-2 text-slate-300">Build and save your draft loadout for later publishing.</p>

        @if ($errors->any())
            <div class="mt-4 rounded-lg border border-red-400/40 bg-red-500/10 p-3 text-sm text-red-200">
                Please fix the highlighted fields and submit again.
            </div>
        @endif

        <form method="POST" action="{{ route('loadouts.store') }}" class="mt-6 space-y-8">
            @csrf

            {{-- Step 1: Mission Details --}}
            <fieldset>
                <legend class="df-title mb-4 flex items-center gap-2 text-lg">
                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-full bg-tactical-accent/15 text-xs font-bold text-tactical-accent">1</span>
                    Mission Details
                </legend>
                <div class="grid gap-4 md:grid-cols-2">
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Game Mode</span>
                        <select name="game_mode_id" class="df-input" required>
                            <option value="">Select game mode</option>
                            @foreach ($modes as $mode)
                                <option value="{{ $mode->id }}" @selected((string) old('game_mode_id') === (string) $mode->id)>{{ $mode->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('game_mode_id')
                            <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Playstyle</span>
                        <select name="playstyle" class="df-input" required>
                            @foreach (['all_rounder', 'close_range', 'mid_range', 'long_range', 'stealth', 'budget', 'meta'] as $playstyle)
                                <option value="{{ $playstyle }}" @selected(old('playstyle', 'all_rounder') === $playstyle)>
                                    {{ ucfirst(str_replace('_', ' ', $playstyle)) }}</option>
                            @endforeach
                        </select>
                        @error('playstyle')
                            <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                        @enderror
                    </label>
                </div>
                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Platform</span>
                        <select name="platform" class="df-input" required>
                            @foreach ($platforms as $value => $label)
                                <option value="{{ $value }}" @selected(old('platform', 'pc') === $value)>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('platform')
                            <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Server</span>
                        <select name="server_region" class="df-input" required>
                            @foreach ($servers as $value => $label)
                                <option value="{{ $value }}" @selected(old('server_region', 'garena') === $value)>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('server_region')
                            <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                        @enderror
                    </label>
                </div>
            </fieldset>

            {{-- Step 2: Weapon Config --}}
            <fieldset>
                <legend class="df-title mb-4 flex items-center gap-2 text-lg">
                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-full bg-tactical-accent/15 text-xs font-bold text-tactical-accent">2</span>
                    Weapon Config
                </legend>
                <div class="grid gap-4 md:grid-cols-2">
                    @include('components.weapon-selector', ['categories' => $categories])
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Secondary Weapon (Optional)</span>
                        <select name="secondary_weapon_id" class="df-input">
                            <option value="">None</option>
                            @foreach ($secondaryWeapons as $weapon)
                                <option value="{{ $weapon->id }}" @selected((string) old('secondary_weapon_id') === (string) $weapon->id)>{{ $weapon->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('secondary_weapon_id')
                            <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                        @enderror
                    </label>
                </div>
                <div class="mt-4">
                    @include('components.attachment-picker', ['attachmentSlots' => $attachmentSlots])
                </div>
            </fieldset>

            {{-- Step 3: Loadout Info --}}
            <fieldset>
                <legend class="df-title mb-4 flex items-center gap-2 text-lg">
                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-full bg-tactical-accent/15 text-xs font-bold text-tactical-accent">3</span>
                    Loadout Info
                </legend>
                <div class="grid gap-4 md:grid-cols-2">
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Title</span>
                        <input name="title" class="df-input" type="text" value="{{ old('title') }}"
                            placeholder="Meta CI-19 Build" required>
                        @error('title')
                            <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Loadout Code (Optional)</span>
                        <input name="loadout_code" class="df-input" type="text" value="{{ old('loadout_code') }}"
                            placeholder="AB12CD34EF">
                    </label>
                </div>

                <div class="mt-4" x-data="{ charCount: {{ strlen(old('description', '')) }} }">
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Description</span>
                        <textarea name="description" class="df-input" rows="5" required maxlength="2000"
                            x-on:input="charCount = $el.value.length">{{ old('description') }}</textarea>
                        <div class="mt-1 df-char-count" :class="{ 'is-over': charCount > 1800 }">
                            <span x-text="charCount"></span> / 2000
                        </div>
                        @error('description')
                            <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Armor Type (Optional)</span>
                        <input name="armor_type" class="df-input" type="text" value="{{ old('armor_type') }}"
                            placeholder="Balanced">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Ammo Type (Optional)</span>
                        <input name="ammo_type" class="df-input" type="text" value="{{ old('ammo_type') }}"
                            placeholder="Standard">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Gadget 1 (Optional)</span>
                        <input name="gadget_1" class="df-input" type="text" value="{{ old('gadget_1') }}"
                            placeholder="Smoke">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm text-slate-300">Gadget 2 (Optional)</span>
                        <input name="gadget_2" class="df-input" type="text" value="{{ old('gadget_2') }}"
                            placeholder="Ammo Box">
                    </label>
                </div>
            </fieldset>

            <div class="border-t border-tactical-line pt-6">
                <button type="submit" class="df-btn-primary w-full py-3 text-base sm:w-auto sm:px-12">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                    Save Draft
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
