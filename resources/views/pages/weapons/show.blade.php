<x-app-layout>
    {{-- Breadcrumb --}}
    <nav class="df-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('weapons.index') }}">Weapons</a>
        <span class="separator" aria-hidden="true">›</span>
        <span class="current">{{ $weapon->name }}</span>
    </nav>

    <section class="df-panel p-6">
        <div class="grid gap-6 lg:grid-cols-[1.2fr,1fr]">
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-400">{{ $weapon->category->name }}</p>
                <h1 class="df-section-title mt-1">{{ $weapon->name }}</h1>

                {{-- Visual stat bars --}}
                <div class="mt-6 space-y-3">
                    <div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-400">Damage</span>
                            <span class="font-semibold text-red-300">{{ $weapon->base_damage }}</span>
                        </div>
                        <div class="df-stat-bar mt-1">
                            <div class="df-stat-bar-fill bar-damage"
                                style="--stat-value: {{ min(($weapon->base_damage / 100) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-400">Fire Rate</span>
                            <span class="font-semibold text-amber-300">{{ $weapon->fire_rate }}</span>
                        </div>
                        <div class="df-stat-bar mt-1">
                            <div class="df-stat-bar-fill bar-firerate"
                                style="--stat-value: {{ min(($weapon->fire_rate / 1200) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-400">Mobility</span>
                            <span class="font-semibold text-cyan-300">{{ $weapon->mobility }}</span>
                        </div>
                        <div class="df-stat-bar mt-1">
                            <div class="df-stat-bar-fill bar-mobility"
                                style="--stat-value: {{ min(($weapon->mobility / 100) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-xl border border-tactical-line bg-slate-950/70">
                <img src="{{ asset($weapon->gunImagePath()) }}" alt="{{ $weapon->name }} full weapon render"
                    class="h-52 w-full object-contain p-3 sm:h-60" width="960" height="540">
            </div>
        </div>
    </section>

    <section class="mt-6">
        <h2 class="df-section-title mb-3 text-xl">Popular Attachments</h2>
        <div class="df-panel p-4">
            <div class="grid gap-3 md:grid-cols-2">
                @foreach ($weapon->attachments->take(10) as $attachment)
                    <div class="flex items-center justify-between rounded-lg bg-slate-950/50 px-4 py-2.5">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                </path>
                            </svg>
                            <span class="font-medium text-slate-200">{{ $attachment->name }}</span>
                        </div>
                        <span class="text-xs text-slate-400">{{ $attachment->slot->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mt-6">
        <h2 class="df-section-title mb-3 text-xl">Community Loadouts</h2>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($loadouts as $loadout)
                @include('components.loadout-card', ['loadout' => $loadout, 'compact' => true])
            @empty
                <div class="col-span-full df-panel p-6 text-center text-slate-400">No loadouts for this weapon yet.
                </div>
            @endforelse
        </div>
        <div class="mt-6">{{ $loadouts->links() }}</div>
    </section>
</x-app-layout>
