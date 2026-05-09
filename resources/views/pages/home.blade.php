<x-app-layout>
    <!-- SECTION 1: HERO -->
    <section class="hero-section relative mb-16 overflow-hidden rounded-lg" data-reveal="zoom">
        <!-- Background image with dimmed overlay -->
        <div class="hero-background absolute inset-0">
            <img src="{{ asset('images/df1.webp') }}" alt="Delta Force tactical briefing" class="h-full w-full object-cover">
            <div class="hero-overlay absolute inset-0"></div>
            <!-- Scanline effect -->
            <div class="scanlines absolute inset-0"></div>
        </div>

        <!-- Hero content -->
        <div class="hero-content relative z-10 flex flex-col items-center justify-center px-6 py-32 text-center sm:py-40">
            <h1 class="hero-headline text-5xl font-black tracking-tighter text-white sm:text-6xl lg:text-7xl">
                ARMORY UNLOCKED
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-relaxed text-slate-200 sm:text-xl">
                The community platform for Delta Force weapon builds. Find your next winning setup for Warfare or extract with confidence in Operations.
            </p>
            
            <!-- Hero CTAs -->
            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
                <a href="{{ route('loadouts.browse', ['mode' => 'warfare']) }}" class="df-btn-primary px-8 py-3 text-base font-bold reveal-delay-1" data-reveal>
                    BROWSE WARFARE LOADOUTS
                </a>
                <a href="{{ route('loadouts.browse', ['mode' => 'operations']) }}" class="df-btn-outline px-8 py-3 text-base font-bold reveal-delay-2" data-reveal>
                    BROWSE OPERATIONS LOADOUTS
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION 2: WHY IT MATTERS (Feature Highlights) -->
    <section class="mb-16 px-6 py-12" data-reveal>
        <div class="grid gap-8 md:grid-cols-3">
            <!-- Column 1: Live Meta Briefing -->
            <div class="feature-card" data-reveal="up">
                <div class="mb-4 inline-block">
                    <svg class="h-10 w-10 text-tactical-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="df-title text-xl font-bold">Live Meta Briefing</h3>
                <p class="mt-2 text-slate-300">Stop guessing. See what's actually winning with real community scores and copy data.</p>
            </div>

            <!-- Column 2: Server-Aware Builds -->
            <div class="feature-card reveal-delay-1" data-reveal="up">
                <div class="mb-4 inline-block">
                    <svg class="h-10 w-10 text-tactical-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="df-title text-xl font-bold">Server-Aware Builds</h3>
                <p class="mt-2 text-slate-300">No more invalid codes. Global and Garena builds are separated. See only what works for you.</p>
            </div>

            <!-- Column 3: Save & Share Instantly -->
            <div class="feature-card reveal-delay-2" data-reveal="up">
                <div class="mb-4 inline-block">
                    <svg class="h-10 w-10 text-tactical-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <h3 class="df-title text-xl font-bold">Save & Share Instantly</h3>
                <p class="mt-2 text-slate-300">Build your personal armory, share with your squad, and rate the community's best creations.</p>
            </div>
        </div>
    </section>

    <!-- SECTION 3: MODE SELECTION HUB -->
    <section class="mb-16 grid grid-cols-1 gap-0 md:grid-cols-2" style="height: 500px;" data-reveal>
        <!-- WARFARE Panel -->
        <a href="{{ route('loadouts.browse', ['mode' => 'warfare']) }}" class="mode-panel mode-warfare group relative overflow-hidden" data-reveal="left">
            <img src="{{ asset('images/Game modes/Warfare-mode.webp') }}" alt="Warfare 32v32 Chaos" class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
            <div class="mode-overlay absolute inset-0 transition-all duration-300 group-hover:via-amber-500/20"></div>
            <div class="mode-content relative z-10 flex flex-col items-center justify-center h-full">
                <h2 class="mode-title text-5xl font-black tracking-tighter text-white">WARFARE</h2>
                <p class="mode-subtitle mt-2 text-lg text-slate-100">32v32 Chaos. Dominate the Battlefield.</p>
            </div>
        </a>

        <!-- OPERATIONS Panel -->
        <a href="{{ route('loadouts.browse', ['mode' => 'operations']) }}" class="mode-panel mode-operations group relative overflow-hidden reveal-delay-1" data-reveal="right">
            <img src="{{ asset('images/Game modes/Operations-mode.webp') }}" alt="Operations High Stakes Extract" class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
            <div class="mode-overlay absolute inset-0 transition-all duration-300 group-hover:via-cyan-400/20"></div>
            <div class="mode-content relative z-10 flex flex-col items-center justify-center h-full">
                <h2 class="mode-title text-5xl font-black tracking-tighter text-white">OPERATIONS</h2>
                <p class="mode-subtitle mt-2 text-lg text-slate-100">High Stakes. Plan & Extract.</p>
            </div>
        </a>
    </section>

    <!-- SECTION 4: THE ARMORY FEED -->
    <section class="mb-16 px-6" data-reveal>
        <h2 class="df-title mb-8 text-center text-3xl font-black" data-reveal>LATEST FROM THE ARMORY</h2>
        
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($trending as $loadout)
                <a href="{{ route('loadouts.show', $loadout) }}" class="armory-card group" data-reveal="up">
                    <div class="flex items-start gap-3 p-4">
                        <!-- Weapon icon/silhouette -->
                        <div class="flex-shrink-0">
                            @if ($loadout->primaryWeapon && $loadout->primaryWeapon->gunImagePath())
                                <img src="{{ asset($loadout->primaryWeapon->gunImagePath()) }}" alt="{{ $loadout->primaryWeapon->name }}" class="h-12 w-12 object-contain opacity-80 group-hover:opacity-100 transition-opacity">
                            @else
                                <div class="h-12 w-12 bg-slate-700 rounded flex items-center justify-center text-xs text-slate-400">GUN</div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-baseline gap-2">
                                <h3 class="df-title font-bold text-white truncate">{{ $loadout->primaryWeapon->name ?? 'Unknown' }}</h3>
                                <span class="df-badge text-xs">{{ strtoupper($loadout->gameMode->name ?? 'N/A') }}</span>
                            </div>
                            <p class="mt-1 text-sm text-slate-400 truncate">by {{ $loadout->user->name }}</p>
                            <div class="mt-2 flex items-center gap-1 text-tactical-accent">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span class="text-sm font-semibold">{{ $loadout->vote_score ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full rounded border border-slate-700 bg-slate-900/50 p-8 text-center">
                    <p class="text-slate-400">No armory updates yet. Be the first to publish a build.</p>
                    <a href="{{ route('loadouts.create') }}" class="mt-4 inline-block df-btn-primary">CREATE BUILD</a>
                </div>
            @endforelse
        </div>
    </section>

    <!-- SECTION 5: FOOTER CTA -->
    <section class="footer-cta mb-0 bg-slate-950 px-6 py-16 text-center" data-reveal>
        <h2 class="df-title text-3xl font-bold">Ready to Build Your Legacy?</h2>
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
            <a href="{{ route('loadouts.browse') }}" class="df-btn-outline px-8 py-3 text-base font-bold">GO TO FULL ARMORY</a>
        </div>
        <p class="mt-12 text-xs text-slate-500">Built for the DF community.</p>
    </section>
</x-app-layout>

