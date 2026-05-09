<x-app-layout>
    <section class="mb-8 grid gap-6 lg:grid-cols-[1.35fr,1fr]">
        <div class="df-panel p-6">
            <p class="df-chip border-tactical-accent/60 text-tactical-accent">Community Tactical Intel</p>
            <h1 class="df-title mt-3 text-3xl font-bold">Build Better Delta Force Loadouts</h1>
            <p class="mt-2 max-w-prose text-base text-slate-300">Discover, share, and rate community weapon builds for Warfare and Operations.</p>
            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('loadouts.browse') }}" class="df-btn-primary">Browse Loadouts</a>
                <a href="{{ route('loadouts.create') }}" class="df-btn-secondary">Create Build</a>
            </div>
        </div>
        <div class="df-hero-media min-h-[260px]">
            <img src="{{ asset('images/df1.webp') }}" alt="Delta Force squad moving through urban combat zone" width="1600" height="900" fetchpriority="high">
            <div class="df-media-caption">
                <p class="df-title text-lg">Meta Briefing</p>
                <p class="mt-1 text-xs text-slate-300">Track top-performing builds & sharpen your setup each match.</p>
            </div>
        </div>
    </section>

    <section class="mb-8 grid gap-4 md:grid-cols-3">
        <div class="df-panel p-5 md:col-span-2">
            @include('components.stats-bar', ['stats' => $stats])
        </div>
        <article class="df-panel p-5">
            <p class="df-title text-base">Modern Tactical Interface</p>
            <p class="mt-2 text-sm text-slate-300">Minimal chrome, high contrast, and focused actions to keep attention on loadout decisions.</p>
        </article>
    </section>

    <section class="mb-8">
        <h2 class="df-title mb-4 text-2xl">Operations Visual Feed</h2>
        <div class="grid gap-4 md:grid-cols-3">
            <article class="df-gallery-card">
                <img src="{{ asset('images/df2.webp') }}" alt="Delta Force operator aiming with rifle in close-quarters interior" width="1200" height="700" loading="lazy">
                <p class="df-gallery-label">CQB Configuration Focus</p>
            </article>
            <article class="df-gallery-card">
                <img src="{{ asset('images/df3.jpg') }}" alt="Delta Force team preparing long-range engagement in open terrain" width="1200" height="700" loading="lazy">
                <p class="df-gallery-label">Long-Range Engagement Setup</p>
            </article>
            <article class="df-gallery-card">
                <img src="{{ asset('images/df1.webp') }}" alt="Delta Force squad breaching under night operations lighting" width="1200" height="700" loading="lazy">
                <p class="df-gallery-label">Night Ops Tactical Build</p>
            </article>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="df-title mb-4 text-2xl">Trending Loadouts</h2>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            @forelse ($trending as $loadout)
                @include('components.loadout-card', ['loadout' => $loadout])
            @empty
                <p class="text-slate-400">No published loadouts yet.</p>
            @endforelse
        </div>
    </section>

    <section class="mb-8 grid gap-6 lg:grid-cols-2">
        <div>
            <h2 class="df-title mb-4 text-xl">Hot in Warfare</h2>
            <div class="space-y-3">
                @foreach ($warfareHot as $loadout)
                    @include('components.loadout-card', ['loadout' => $loadout, 'compact' => true])
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="df-title mb-4 text-xl">Hot in Operations</h2>
            <div class="space-y-3">
                @foreach ($operationsHot as $loadout)
                    @include('components.loadout-card', ['loadout' => $loadout, 'compact' => true])
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <h2 class="df-title mb-4 text-xl">Browse by Category</h2>
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($categories as $category)
                <a href="{{ route('loadouts.browse', ['category' => $category->slug]) }}" class="df-panel df-card-link p-4">
                    <p class="font-semibold">{{ $category->name }}</p>
                </a>
            @endforeach
        </div>
    </section>
</x-app-layout>

