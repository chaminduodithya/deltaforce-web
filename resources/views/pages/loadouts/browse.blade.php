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

            {{-- Quick server/platform chips --}}
            <div class="mt-4 flex flex-wrap gap-2">
                <a href="{{ request()->fullUrlWithQuery(['platform' => '', 'server' => '', 'page' => null]) }}"
                    class="df-chip cursor-pointer {{ empty($activePlatform) && empty($activeServer) ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    All
                </a>
                <a href="{{ request()->fullUrlWithQuery(['server' => 'timi', 'page' => null]) }}"
                    class="df-chip cursor-pointer {{ $activeServer === 'timi' ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    Global (TiMi)
                </a>
                <a href="{{ request()->fullUrlWithQuery(['server' => 'garena', 'page' => null]) }}"
                    class="df-chip cursor-pointer {{ $activeServer === 'garena' ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    Garena
                </a>
                <a href="{{ request()->fullUrlWithQuery(['platform' => 'pc', 'page' => null]) }}"
                    class="df-chip cursor-pointer {{ $activePlatform === 'pc' ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    PC
                </a>
                <a href="{{ request()->fullUrlWithQuery(['platform' => 'mobile', 'page' => null]) }}"
                    class="df-chip cursor-pointer {{ $activePlatform === 'mobile' ? 'border-tactical-accent text-tactical-accent' : '' }}">
                    Mobile
                </a>
            </div>

            {{-- Result count --}}
            <div class="mt-4 flex items-center justify-between">
                <p class="text-sm text-slate-400">
                    Showing <span class="font-semibold text-slate-200">{{ $loadouts->total() }}</span> loadouts
                </p>
                @if (request('q'))
                    <a href="{{ route('loadouts.browse') }}" class="text-xs text-tactical-accent hover:underline">Clear
                        search</a>
                @endif
            </div>

            {{-- Loadout grid --}}
            <div class="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($loadouts as $loadout)
                    @include('components.loadout-card', ['loadout' => $loadout])
                @empty
                    <div class="col-span-full rounded-lg border border-slate-700 bg-slate-900/50 p-10 text-center">
                        <svg class="mx-auto h-14 w-14 text-slate-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <p class="mt-3 text-lg font-semibold text-slate-300">No loadouts found</p>
                        <p class="mt-1 text-sm text-slate-400">Try a different weapon, mode, or clear your filters.</p>
                        <a href="{{ route('loadouts.browse') }}" class="mt-4 inline-block df-btn-secondary">Clear
                            Filters</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">{{ $loadouts->links() }}</div>
        </section>
    </div>
</x-app-layout>
