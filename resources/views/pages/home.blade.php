<x-app-layout>
    <!-- SECTION 1: HERO -->
    <section class="hero-section relative mb-16 overflow-hidden rounded-lg" data-reveal="zoom">
        <!-- Background image with dimmed overlay -->
        <div class="hero-background absolute inset-0">
            <img src="{{ asset('images/df1.webp') }}" alt="Delta Force tactical briefing"
                class="h-full w-full object-cover">
            <div class="hero-overlay absolute inset-0"></div>
            <!-- Scanline effect -->
            <div class="scanlines absolute inset-0"></div>
        </div>

        <!-- Hero content -->
        <div
            class="hero-content relative z-10 flex flex-col items-center justify-center px-6 py-32 text-center sm:py-40">
            <h1 class="hero-headline text-5xl font-black tracking-tighter text-white sm:text-6xl lg:text-7xl">
                ARMORY UNLOCKED
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-relaxed text-slate-200 sm:text-xl">
                The community platform for Delta Force weapon builds. Find your next winning setup for Warfare or
                extract with confidence in Operations.
            </p>

            <!-- Hero CTAs -->
            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
                <a href="{{ route('loadouts.browse', ['mode' => 'warfare']) }}"
                    class="df-btn-primary px-8 py-3 text-base font-bold reveal-delay-1" data-reveal>
                    BROWSE WARFARE LOADOUTS
                </a>
                <a href="{{ route('loadouts.browse', ['mode' => 'operations']) }}"
                    class="df-btn-outline px-8 py-3 text-base font-bold reveal-delay-2" data-reveal>
                    BROWSE OPERATIONS LOADOUTS
                </a>
            </div>

            <!-- Live Stats Bar -->
            <div class="mt-10 inline-flex items-center gap-0 rounded-xl border border-white/10 bg-slate-950/60 backdrop-blur-md"
                data-reveal>
                <div class="px-6 py-3 text-center reveal-delay-1">
                    <p class="text-2xl font-black text-tactical-accent sm:text-3xl"
                        data-count-to="{{ $stats['loadouts'] }}">0</p>
                    <p class="mt-0.5 text-[10px] uppercase tracking-widest text-slate-400">Loadouts</p>
                </div>
                <div class="h-10 w-px bg-white/10"></div>
                <div class="px-6 py-3 text-center reveal-delay-2">
                    <p class="text-2xl font-black text-tactical-accent sm:text-3xl"
                        data-count-to="{{ $stats['users'] }}">0</p>
                    <p class="mt-0.5 text-[10px] uppercase tracking-widest text-slate-400">Operators</p>
                </div>
                <div class="h-10 w-px bg-white/10"></div>
                <div class="px-6 py-3 text-center reveal-delay-3">
                    <p class="text-2xl font-black text-tactical-accent sm:text-3xl"
                        data-count-to="{{ $stats['copies'] }}">0</p>
                    <p class="mt-0.5 text-[10px] uppercase tracking-widest text-slate-400">Copies Made</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: WHY IT MATTERS (Feature Highlights) -->
    <section class="mb-16 px-6 py-12" data-reveal>
        <div class="grid gap-8 md:grid-cols-3">
            <!-- Column 1: Live Meta Briefing -->
            <div class="feature-card" data-reveal="up">
                <div class="mb-4 inline-block">
                    <svg class="h-10 w-10 text-tactical-accent" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>
                <h3 class="df-title text-xl font-bold">Live Meta Briefing</h3>
                <p class="mt-2 text-slate-300">Stop guessing. See what's actually winning with real community scores and
                    copy data.</p>
            </div>

            <!-- Column 2: Server-Aware Builds -->
            <div class="feature-card reveal-delay-1" data-reveal="up">
                <div class="mb-4 inline-block">
                    <svg class="h-10 w-10 text-tactical-accent" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="df-title text-xl font-bold">Server-Aware Builds</h3>
                <p class="mt-2 text-slate-300">No more invalid codes. Global and Garena builds are separated. See only
                    what works for you.</p>
            </div>

            <!-- Column 3: Save & Share Instantly -->
            <div class="feature-card reveal-delay-2" data-reveal="up">
                <div class="mb-4 inline-block">
                    <svg class="h-10 w-10 text-tactical-accent" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <h3 class="df-title text-xl font-bold">Save & Share Instantly</h3>
                <p class="mt-2 text-slate-300">Build your personal armory, share with your squad, and rate the
                    community's best creations.</p>
            </div>
        </div>
    </section>

    <!-- SECTION 3: MODE SELECTION HUB -->
    <section class="mb-16" data-reveal>
        <h2 class="df-section-title mb-6 text-center text-2xl">CHOOSE YOUR BATTLEFIELD</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- WARFARE Panel -->
            <a href="{{ route('loadouts.browse', ['mode' => 'warfare']) }}"
                class="group relative overflow-hidden rounded-xl border border-tactical-line" data-reveal="left">
                {{-- Background --}}
                <img src="{{ asset('images/df2.webp') }}" alt="Warfare 32v32 Chaos"
                    class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-slate-950/30 transition-all duration-300 group-hover:via-amber-900/30">
                </div>

                {{-- Content --}}
                <div class="relative z-10 flex min-h-[320px] flex-col justify-end p-6 sm:min-h-[360px] sm:p-8">
                    {{-- Mode badge --}}
                    <div class="mb-auto">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full border border-green-400/30 bg-green-500/15 px-3 py-1 text-xs font-bold uppercase tracking-wider text-green-300">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-400 animate-pulse"></span>
                            {{ $warfareHot->count() }} Loadouts
                        </span>
                    </div>

                    <h2 class="font-heading text-4xl font-black tracking-tight text-white sm:text-5xl">WARFARE</h2>
                    <p class="mt-2 text-base text-slate-200">32v32 Chaos. Dominate the Battlefield.</p>

                    {{-- Features --}}
                    <ul class="mt-4 space-y-1.5 text-sm text-slate-300">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Large-scale team battles
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Respawn-based combat
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Aggressive loadout meta
                        </li>
                    </ul>

                    {{-- CTA --}}
                    <div class="mt-5">
                        <span
                            class="inline-flex items-center gap-2 rounded-lg border border-green-400/40 bg-green-500/10 px-4 py-2 text-sm font-semibold text-green-300 transition-all duration-200 group-hover:bg-green-500/20 group-hover:border-green-400/60">
                            Explore Warfare Builds
                            <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>

            <!-- OPERATIONS Panel -->
            <a href="{{ route('loadouts.browse', ['mode' => 'operations']) }}"
                class="group relative overflow-hidden rounded-xl border border-tactical-line reveal-delay-1"
                data-reveal="right">
                {{-- Background --}}
                <img src="{{ asset('images/Game modes/Operations-mode.webp') }}" alt="Operations High Stakes Extract"
                    class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-slate-950/30 transition-all duration-300 group-hover:via-orange-900/30">
                </div>

                {{-- Content --}}
                <div class="relative z-10 flex min-h-[320px] flex-col justify-end p-6 sm:min-h-[360px] sm:p-8">
                    {{-- Mode badge --}}
                    <div class="mb-auto">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full border border-orange-400/30 bg-orange-500/15 px-3 py-1 text-xs font-bold uppercase tracking-wider text-orange-300">
                            <span class="h-1.5 w-1.5 rounded-full bg-orange-400 animate-pulse"></span>
                            {{ $operationsHot->count() }} Loadouts
                        </span>
                    </div>

                    <h2 class="font-heading text-4xl font-black tracking-tight text-white sm:text-5xl">OPERATIONS</h2>
                    <p class="mt-2 text-base text-slate-200">High Stakes. Plan & Extract.</p>

                    {{-- Features --}}
                    <ul class="mt-4 space-y-1.5 text-sm text-slate-300">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Tactical extraction gameplay
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            No respawns — play smart
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Stealth & precision builds
                        </li>
                    </ul>

                    {{-- CTA --}}
                    <div class="mt-5">
                        <span
                            class="inline-flex items-center gap-2 rounded-lg border border-orange-400/40 bg-orange-500/10 px-4 py-2 text-sm font-semibold text-orange-300 transition-all duration-200 group-hover:bg-orange-500/20 group-hover:border-orange-400/60">
                            Explore Operations Builds
                            <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <!-- SECTION 3.5: WEAPON CATEGORY QUICK NAV -->
    @if ($categories->isNotEmpty())
        <section class="mb-16 px-6" data-reveal>
            <h2 class="df-section-title text-center text-2xl">BROWSE BY WEAPON TYPE</h2>
            <div class="mt-6 flex flex-wrap justify-center gap-2">
                @foreach ($categories as $category)
                    <a href="{{ route('loadouts.browse', ['category' => $category->slug]) }}"
                        class="df-chip cursor-pointer transition-all duration-200 hover:border-tactical-accent hover:text-tactical-accent hover:-translate-y-0.5">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <!-- SECTION 4: THE ARMORY FEED -->
    <section class="mb-16 px-6" data-reveal>
        <h2 class="df-section-title mb-8 text-center" data-reveal>LATEST FROM THE ARMORY</h2>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($trending as $loadout)
                <a href="{{ route('loadouts.show', $loadout) }}" class="armory-card group" data-reveal="up">
                    <div class="flex items-start gap-3 p-4">
                        <!-- Weapon icon/silhouette -->
                        <div class="flex-shrink-0">
                            @if ($loadout->primaryWeapon && $loadout->primaryWeapon->gunImagePath())
                                <img src="{{ asset($loadout->primaryWeapon->gunImagePath()) }}"
                                    alt="{{ $loadout->primaryWeapon->name }}"
                                    class="h-12 w-12 object-contain opacity-80 group-hover:opacity-100 transition-opacity">
                            @else
                                <div
                                    class="h-12 w-12 bg-slate-700 rounded flex items-center justify-center text-xs text-slate-400">
                                    GUN</div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-baseline gap-2">
                                <h3 class="df-title font-bold text-white truncate">
                                    {{ $loadout->primaryWeapon->name ?? 'Unknown' }}</h3>
                                <span
                                    class="df-badge text-xs">{{ strtoupper($loadout->gameMode->name ?? 'N/A') }}</span>
                            </div>
                            <p class="mt-1 text-sm text-slate-400 truncate">by {{ $loadout->user->name }}</p>
                            <div class="mt-2 flex items-center gap-3">
                                <div class="flex items-center gap-1 text-tactical-accent">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <span class="text-sm font-semibold">{{ $loadout->vote_score ?? 0 }}</span>
                                </div>
                                <span class="text-xs text-slate-500">{{ $loadout->copies_count ?? 0 }} copies</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full rounded-lg border border-slate-700 bg-slate-900/50 p-10 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p class="mt-3 text-slate-400">No armory updates yet. Be the first to publish a build.</p>
                    <a href="{{ route('loadouts.create') }}" class="mt-4 inline-block df-btn-primary">CREATE
                        BUILD</a>
                </div>
            @endforelse
        </div>
    </section>

    <!-- SECTION 5: FOOTER CTA -->
    <section class="footer-cta relative mb-0 overflow-hidden rounded-t-xl px-6 py-20 text-center" data-reveal>
        <img src="{{ asset('images/df3.jpg') }}" alt="" aria-hidden="true"
            class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/85 to-slate-950/70"></div>
        <div class="relative z-10">
            <h2 class="df-section-title text-center text-3xl">Ready to Build Your Legacy?</h2>
            <p class="mt-4 text-slate-300">Join the community and share your best builds.</p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
                <a href="{{ route('loadouts.browse') }}" class="df-btn-outline px-8 py-3 text-base font-bold">GO TO
                    FULL ARMORY</a>
                <a href="{{ route('loadouts.create') }}" class="df-btn-primary px-8 py-3 text-base font-bold">CREATE
                    YOUR BUILD</a>
            </div>
        </div>
    </section>
</x-app-layout>
