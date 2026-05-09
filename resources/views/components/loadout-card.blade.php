@php($compact = $compact ?? false)

<article class="df-panel df-card-link p-4 {{ $compact ? '' : 'reveal-delay-1' }}"
    @if (!$compact) data-reveal="up" @endif>
    <div class="flex items-start gap-3">
        {{-- Weapon image --}}
        <div class="hidden flex-shrink-0 sm:block">
            @if ($loadout->primaryWeapon && $loadout->primaryWeapon->gunImagePath())
                <img src="{{ asset($loadout->primaryWeapon->gunImagePath()) }}" alt="{{ $loadout->primaryWeapon->name }}"
                    class="h-14 w-14 rounded border border-tactical-line bg-slate-950/60 object-contain p-1"
                    loading="lazy" width="56" height="56">
            @else
                <div
                    class="flex h-14 w-14 items-center justify-center rounded border border-tactical-line bg-slate-950/60 text-xs text-slate-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 13h8l3-3 7 7-2 2-7-7-3 3H3v-2Z"></path>
                    </svg>
                </div>
            @endif
        </div>

        {{-- Card content --}}
        <div class="min-w-0 flex-1">
            <div class="flex items-start justify-between gap-2">
                <div class="min-w-0">
                    <p class="truncate text-[11px] uppercase tracking-wide text-slate-500">
                        {{ $loadout->primaryWeapon?->category?->name }}</p>
                    <a href="{{ route('loadouts.show', $loadout) }}"
                        class="block truncate font-semibold text-slate-100 hover:text-tactical-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-tactical-accent">
                        {{ $loadout->title }}
                    </a>
                    <p class="truncate text-sm font-semibold text-slate-200">{{ $loadout->primaryWeapon?->name }}</p>
                </div>
                <span
                    class="df-chip flex-shrink-0 {{ $loadout->gameMode?->slug === 'operations' ? 'text-orange-300' : 'text-green-300' }}">
                    {{ $loadout->gameMode?->name }}
                </span>
            </div>

            <div class="mt-3 grid grid-cols-2 gap-2 text-xs">
                <div class="rounded border border-white/10 bg-slate-950/40 px-2 py-1.5 text-center">
                    <p class="text-[10px] uppercase tracking-wide text-slate-500">Score</p>
                    <p class="font-semibold text-slate-200">{{ $loadout->vote_score }}</p>
                </div>
                <div class="rounded border border-white/10 bg-slate-950/40 px-2 py-1.5 text-center">
                    <p class="text-[10px] uppercase tracking-wide text-slate-500">Copies</p>
                    <p class="font-semibold text-slate-200">{{ $loadout->copies_count }}</p>
                </div>
            </div>

            <div class="mt-2 flex flex-wrap items-center justify-between gap-2 text-[11px] text-slate-300">
                <span class="truncate text-slate-500">by {{ $loadout->user?->name }}</span>
                <div class="flex gap-1">
                    @if ($loadout->playstyle)
                        <span
                            class="df-badge border-violet-400/30 bg-violet-500/10 text-violet-200">{{ ucfirst(str_replace('_', ' ', $loadout->playstyle)) }}</span>
                    @endif
                    <span class="df-badge df-badge-platform">{{ strtoupper($loadout->platform ?? 'PC') }}</span>
                    <span
                        class="df-badge df-badge-server">{{ ($loadout->server_region ?? 'garena') === 'timi' ? 'GLOBAL' : 'GARENA' }}</span>
                </div>
            </div>
        </div>
    </div>
</article>
