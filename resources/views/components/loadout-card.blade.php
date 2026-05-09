@php($compact = $compact ?? false)

<article class="df-panel df-card-link p-4 {{ $compact ? '' : 'reveal-delay-1' }}" @if (! $compact) data-reveal="up" @endif>
    <div class="flex items-start justify-between gap-2">
        <div class="min-w-0">
            <p class="truncate text-[11px] uppercase tracking-wide text-slate-500">{{ $loadout->primaryWeapon?->category?->name }}</p>
            <a href="{{ route('loadouts.show', $loadout) }}" class="block truncate font-semibold text-slate-100 hover:text-tactical-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-tactical-accent">
                {{ $loadout->title }}
            </a>
            <p class="truncate text-sm font-semibold text-slate-200">{{ $loadout->primaryWeapon?->name }}</p>
        </div>
        <span class="df-chip {{ $loadout->gameMode?->slug === 'operations' ? 'text-orange-300' : 'text-green-300' }}">
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
            <span class="df-badge df-badge-platform">{{ strtoupper($loadout->platform ?? 'PC') }}</span>
            <span class="df-badge df-badge-server">{{ ($loadout->server_region ?? 'garena') === 'timi' ? 'GLOBAL' : 'GARENA' }}</span>
        </div>
    </div>
</article>

