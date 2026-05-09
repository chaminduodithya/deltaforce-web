@php($compact = $compact ?? false)

<article class="df-panel df-card-link p-4 {{ $compact ? '' : 'animate-slide-in' }}">
    <div class="flex items-start justify-between gap-2">
        <div class="min-w-0">
            <a href="{{ route('loadouts.show', $loadout) }}" class="block truncate font-semibold text-slate-100 hover:text-tactical-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-tactical-accent">
                {{ $loadout->title }}
            </a>
            <p class="truncate text-xs text-slate-400">{{ $loadout->primaryWeapon?->name }} • {{ $loadout->primaryWeapon?->category?->name }}</p>
        </div>
        <span class="df-chip {{ $loadout->gameMode?->slug === 'operations' ? 'text-orange-300' : 'text-green-300' }}">
            {{ $loadout->gameMode?->name }}
        </span>
    </div>

    <div class="mt-3 flex items-center justify-between gap-2 text-xs text-slate-400">
        <span>by {{ $loadout->user?->name }}</span>
        <span class="shrink-0">Score {{ $loadout->vote_score }} • Copies {{ $loadout->copies_count }}</span>
    </div>

    <div class="mt-2 flex flex-wrap gap-1 text-[11px] text-slate-300">
        <span class="rounded border border-tactical-line px-2 py-0.5">{{ strtoupper($loadout->platform ?? 'PC') }}</span>
        <span class="rounded border border-tactical-line px-2 py-0.5">{{ strtoupper($loadout->server_region ?? 'GARENA') }}</span>
    </div>
</article>

