<x-app-layout>
    <h1 class="df-section-title mb-6">Weapon Browser</h1>

    @foreach ($categories as $category)
        <section class="mb-8">
            <h2 class="df-title mb-3 text-xl">{{ $category->name }}</h2>
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($category->weapons as $weapon)
                    <a href="{{ route('weapons.show', $weapon) }}" class="df-panel df-card-link group p-4">
                        <div class="mb-3 overflow-hidden rounded-lg border border-tactical-line bg-slate-950/70">
                            <img src="{{ asset($weapon->gunImagePath()) }}" alt="{{ $weapon->name }} weapon image"
                                class="h-28 w-full object-contain p-2 transition-transform duration-300 group-hover:scale-105"
                                width="640" height="360" loading="lazy">
                        </div>
                        <p
                            class="font-semibold text-slate-100 group-hover:text-tactical-accent transition-colors duration-200">
                            {{ $weapon->name }}</p>
                        {{-- Visual stat bars --}}
                        <div class="mt-3 space-y-2">
                            <div>
                                <div class="flex items-center justify-between text-[11px]">
                                    <span class="text-slate-500">DMG</span>
                                    <span class="font-medium text-red-300">{{ $weapon->base_damage }}</span>
                                </div>
                                <div class="df-stat-bar mt-0.5">
                                    <div class="df-stat-bar-fill bar-damage"
                                        style="--stat-value: {{ min(($weapon->base_damage / 100) * 100, 100) }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center justify-between text-[11px]">
                                    <span class="text-slate-500">RPM</span>
                                    <span class="font-medium text-amber-300">{{ $weapon->fire_rate }}</span>
                                </div>
                                <div class="df-stat-bar mt-0.5">
                                    <div class="df-stat-bar-fill bar-firerate"
                                        style="--stat-value: {{ min(($weapon->fire_rate / 1200) * 100, 100) }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center justify-between text-[11px]">
                                    <span class="text-slate-500">MOB</span>
                                    <span class="font-medium text-cyan-300">{{ $weapon->mobility }}</span>
                                </div>
                                <div class="df-stat-bar mt-0.5">
                                    <div class="df-stat-bar-fill bar-mobility"
                                        style="--stat-value: {{ min(($weapon->mobility / 100) * 100, 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
</x-app-layout>
