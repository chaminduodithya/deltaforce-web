<x-app-layout>
    <div class="mb-6 grid gap-4 lg:grid-cols-[260px,1fr]">
        @include('components.filter-sidebar', ['categories' => $categories, 'modes' => $modes, 'platforms' => $platforms, 'servers' => $servers])
        <section>
            @include('components.search-bar')

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

