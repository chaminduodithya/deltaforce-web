<x-app-layout>
    <section class="df-panel p-6">
        <div class="flex items-center gap-4">
            <div class="df-avatar !h-14 !w-14 !text-xl">{{ strtoupper(substr($profileUser->name, 0, 1)) }}</div>
            <div>
                <h1 class="df-section-title text-3xl">{{ $profileUser->name }}</h1>
                <p class="mt-1 text-slate-300">{{ $profileUser->bio ?: 'No bio yet.' }}</p>
            </div>
        </div>
    </section>

    <section class="mt-6">
        <h2 class="df-section-title mb-4 text-xl">Published Loadouts</h2>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($profileUser->loadouts as $loadout)
                @include('components.loadout-card', ['loadout' => $loadout])
            @empty
                <div class="col-span-full rounded-lg border border-slate-700 bg-slate-900/50 p-8 text-center">
                    <svg class="mx-auto h-10 w-10 text-slate-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p class="mt-3 text-slate-400">No published loadouts yet.</p>
                    <a href="{{ route('loadouts.create') }}" class="mt-3 inline-block df-btn-primary">Create Your First
                        Build</a>
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>
