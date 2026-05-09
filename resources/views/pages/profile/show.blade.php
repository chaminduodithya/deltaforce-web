<x-app-layout>
    <section class="df-panel p-6">
        <h1 class="df-title text-3xl">{{ $profileUser->name }}</h1>
        <p class="mt-2 text-slate-300">{{ $profileUser->bio ?: 'No bio yet.' }}</p>
    </section>

    <section class="mt-6">
        <h2 class="df-title mb-3 text-xl">My Loadouts</h2>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($profileUser->loadouts as $loadout)
                @include('components.loadout-card', ['loadout' => $loadout])
            @empty
                <div class="df-panel p-6 text-slate-400">No published loadouts yet.</div>
            @endforelse
        </div>
    </section>
</x-app-layout>

