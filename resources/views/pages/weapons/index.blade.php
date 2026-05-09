<x-app-layout>
    <h1 class="df-title mb-5 text-3xl">Weapon Browser</h1>

    @foreach ($categories as $category)
        <section class="mb-7">
            <h2 class="df-title mb-3 text-xl">{{ $category->name }}</h2>
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($category->weapons as $weapon)
                    <a href="{{ route('weapons.show', $weapon) }}" class="df-panel df-card-link p-4">
                        <div class="mb-3 overflow-hidden rounded-lg border border-tactical-line bg-slate-950/70">
                            <img
                                src="{{ asset($weapon->gunImagePath()) }}"
                                alt="{{ $weapon->name }} weapon image"
                                class="h-28 w-full object-contain p-2"
                                width="640"
                                height="360"
                                loading="lazy"
                            >
                        </div>
                        <p class="font-semibold">{{ $weapon->name }}</p>
                        <p class="mt-2 text-xs text-slate-400">DMG {{ $weapon->base_damage }} • RPM {{ $weapon->fire_rate }} • MOB {{ $weapon->mobility }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
</x-app-layout>

