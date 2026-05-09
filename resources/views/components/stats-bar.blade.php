<div class="space-y-3">
    <p class="df-title text-base">SITREP</p>
    <div class="grid gap-2 md:grid-cols-3">
        <div class="rounded-lg bg-slate-950/60 p-3">
            <p class="text-xs uppercase text-slate-400">Active Loadouts</p>
            <p class="df-title text-xl">{{ number_format($sitrep['active_loadouts'] ?? $stats['loadouts']) }}</p>
        </div>
        <div class="rounded-lg bg-slate-950/60 p-3">
            <p class="text-xs uppercase text-slate-400">Top Contributor</p>
            <p class="df-title text-base">{{ $sitrep['top_contributor'] ?? 'No Intel Yet' }}</p>
        </div>
        <div class="rounded-lg bg-slate-950/60 p-3">
            <p class="text-xs uppercase text-slate-400">This Week's Hot Gun</p>
            <p class="df-title text-base">{{ $sitrep['hot_gun'] ?? 'No Intel Yet' }}</p>
        </div>
    </div>
</div>
