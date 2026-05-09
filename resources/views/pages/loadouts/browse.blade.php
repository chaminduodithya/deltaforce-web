<x-app-layout>
    <div class="mb-6 grid gap-4 lg:grid-cols-[260px,1fr]">
        @include('components.filter-sidebar', [
            'categories' => $categories,
            'modes' => $modes,
            'platforms' => $platforms,
            'servers' => $servers,
            'activePlatform' => $activePlatform,
            'activeServer' => $activeServer,
        ])
        <section>
            @include('components.search-bar')

            <div class="mt-4 flex flex-wrap gap-2">
                <a href="{{ request()->fullUrlWithQuery(['platform' => '', 'server' => '', 'page' => null]) }}"
                    class="df-chip {{ empty($activePlatform) && empty($activeServer) ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    All
                </a>
                <a href="{{ request()->fullUrlWithQuery(['server' => 'timi', 'page' => null]) }}"
                    class="df-chip {{ $activeServer === 'timi' ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    Global (TiMi)
                </a>
                <a href="{{ request()->fullUrlWithQuery(['server' => 'garena', 'page' => null]) }}"
                    class="df-chip {{ $activeServer === 'garena' ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    Garena
                </a>
                <a href="{{ request()->fullUrlWithQuery(['platform' => 'pc', 'page' => null]) }}"
                    class="df-chip {{ $activePlatform === 'pc' ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    PC
                </a>
                <a href="{{ request()->fullUrlWithQuery(['platform' => 'mobile', 'page' => null]) }}"
                    class="df-chip {{ $activePlatform === 'mobile' ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    Mobile
                </a>
            </div>

            <div class="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($loadouts as $loadout)
                    @include('components.loadout-card', ['loadout' => $loadout])
                @empty
                    <div class="df-panel col-span-full p-6 text-slate-400">No results. Try a different weapon or mode.</div>
                @endforelse
            </div>

            <div class="mt-6">{{ $loadouts->links() }}</div>
        </section>
    </div>
</x-app-layout>

