<x-app-layout>
    <section class="df-panel p-6">
        <div class="grid gap-6 lg:grid-cols-[1.2fr,1fr]">
            <div>
                <h1 class="df-title text-3xl">{{ $weapon->name }}</h1>
                <p class="mt-1 text-slate-300">{{ $weapon->category->name }}</p>
                <div class="mt-4 grid grid-cols-3 gap-3 text-sm">
                    <div class="rounded border border-tactical-line bg-slate-950/60 p-3">Damage: {{ $weapon->base_damage }}</div>
                    <div class="rounded border border-tactical-line bg-slate-950/60 p-3">Fire Rate: {{ $weapon->fire_rate }}</div>
                    <div class="rounded border border-tactical-line bg-slate-950/60 p-3">Mobility: {{ $weapon->mobility }}</div>
                </div>
            </div>
            <div class="overflow-hidden rounded-xl border border-tactical-line bg-slate-950/70">
                <img
                    src="{{ asset($weapon->gunImagePath()) }}"
                    alt="{{ $weapon->name }} full weapon render"
                    class="h-52 w-full object-contain p-3 sm:h-60"
                    width="960"
                    height="540"
                >
            </div>
        </div>
    </section>

    <section class="mt-6">
        <h2 class="df-title mb-3 text-xl">Popular Attachments</h2>
        <div class="df-panel p-4">
            <div class="grid gap-3 md:grid-cols-2">
                @foreach ($weapon->attachments->take(10) as $attachment)
                    <div class="rounded bg-slate-950/50 p-3">
                        <p class="font-medium">{{ $attachment->name }}</p>
                        <p class="mt-1 text-xs text-slate-400">{{ $attachment->slot->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mt-6">
        <h2 class="df-title mb-3 text-xl">Community Loadouts</h2>
        <div class="space-y-3">
            @foreach ($loadouts as $loadout)
                @include('components.loadout-card', ['loadout' => $loadout, 'compact' => true])
            @endforeach
        </div>
        <div class="mt-6">{{ $loadouts->links() }}</div>
    </section>
</x-app-layout>
