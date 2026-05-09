<div class="grid grid-cols-3 gap-2 text-center">
    <div class="rounded-lg bg-slate-950/60 p-3">
        <p class="text-xs uppercase text-slate-400">Loadouts</p>
        <p class="df-title text-xl">{{ number_format($stats['loadouts']) }}</p>
    </div>
    <div class="rounded-lg bg-slate-950/60 p-3">
        <p class="text-xs uppercase text-slate-400">Users</p>
        <p class="df-title text-xl">{{ number_format($stats['users']) }}</p>
    </div>
    <div class="rounded-lg bg-slate-950/60 p-3">
        <p class="text-xs uppercase text-slate-400">Copies</p>
        <p class="df-title text-xl">{{ number_format($stats['copies']) }}</p>
    </div>
</div>
