<x-app-layout>
    {{-- Breadcrumb --}}
    <nav class="df-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('loadouts.browse') }}">Browse</a>
        <span class="separator" aria-hidden="true">›</span>
        <span class="current">{{ $loadout->primaryWeapon?->name ?? $loadout->title }}</span>
    </nav>

    <div class="grid gap-6 lg:grid-cols-[2fr,1fr]">
        <section class="space-y-6">
            <div class="df-panel p-6">
                <div class="flex flex-wrap items-center gap-2">
                    <span
                        class="df-chip {{ $loadout->gameMode?->slug === 'operations' ? 'text-orange-300' : 'text-green-300' }}">
                        {{ $loadout->gameMode?->name }}
                    </span>
                    @if ($loadout->playstyle)
                        <span
                            class="df-badge border-violet-400/30 bg-violet-500/10 text-violet-200">{{ ucfirst(str_replace('_', ' ', $loadout->playstyle)) }}</span>
                    @endif
                </div>
                <h1 class="df-title mt-3 text-3xl font-bold">{{ $loadout->title }}</h1>
                <p class="mt-2 text-slate-300 leading-relaxed">{{ $loadout->description }}</p>

                {{-- Weapon image --}}
                @if ($loadout->primaryWeapon && $loadout->primaryWeapon->gunImagePath())
                    <div class="mt-4 overflow-hidden rounded-lg border border-tactical-line bg-slate-950/70">
                        <img src="{{ asset($loadout->primaryWeapon->gunImagePath()) }}"
                            alt="{{ $loadout->primaryWeapon->name }}"
                            class="mx-auto h-32 w-full max-w-md object-contain p-3 sm:h-40">
                    </div>
                @endif

                <div class="mt-4 flex flex-wrap gap-2 text-sm text-slate-300">
                    <span>
                        By
                        @if ($loadout->user?->username)
                            <a href="{{ route('profile.show', $loadout->user) }}"
                                class="text-tactical-accent hover:underline">{{ $loadout->user->name }}</a>
                        @else
                            <span>{{ $loadout->user?->name ?? 'Unknown Operator' }}</span>
                        @endif
                    </span>
                    <span>•</span>
                    <span>{{ $loadout->views_count }} views</span>
                    <span>•</span>
                    <span>{{ $loadout->copies_count }} copies</span>
                </div>
                <div class="mt-3 flex flex-wrap gap-2 text-xs text-slate-300">
                    <span class="df-badge df-badge-platform">Platform:
                        {{ strtoupper($loadout->platform ?? 'PC') }}</span>
                    <span class="df-badge df-badge-server">Server:
                        {{ ($loadout->server_region ?? 'garena') === 'timi' ? 'GLOBAL (TIMI)' : 'GARENA' }}</span>
                </div>
            </div>

            <div class="df-panel p-6">
                <h2 class="df-title text-xl">Attachments</h2>
                <div class="mt-3 space-y-2">
                    @forelse ($loadout->loadoutAttachments as $item)
                        <div class="flex items-center justify-between rounded-lg bg-slate-900/50 px-4 py-2.5">
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                    </path>
                                </svg>
                                <span class="text-slate-300">{{ $item->slot->name }}</span>
                            </div>
                            <span class="font-semibold text-tactical-accent">{{ $item->attachment->name }}</span>
                        </div>
                    @empty
                        <p class="text-slate-400">No attachment data uploaded yet.</p>
                    @endforelse
                </div>
            </div>

            @include('components.comment-section', ['comments' => $loadout->comments])
        </section>

        <aside class="space-y-4">
            @include('components.vote-button', ['loadout' => $loadout])
            <div class="df-panel p-4">
                <h3 class="df-title mb-2">Loadout Code</h3>
                <pre class="overflow-x-auto rounded-lg bg-slate-950/70 p-3 text-sm font-mono">{{ $loadout->loadout_code ?: 'No code provided' }}</pre>
                <div class="mt-3 flex items-center gap-3">
                    <button type="button" class="df-btn-primary min-h-0 px-3 py-1.5" @disabled(empty($loadout->loadout_code))
                        onclick="navigator.clipboard.writeText({{ \Illuminate\Support\Js::from($loadout->loadout_code) }}).then(() => window.dfToast('Loadout code copied!')).catch(() => window.dfToast('Copy failed'))">
                        <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        Copy Code
                    </button>
                </div>
            </div>
            <div class="df-panel p-4">
                <h3 class="df-title mb-2">Suggested Builds</h3>
                <div class="space-y-3">
                    @forelse ($relatedSuggestions as $suggestion)
                        @php($item = $suggestion['loadout'])
                        <article
                            class="rounded-lg border border-tactical-line bg-slate-950/40 p-3 transition-colors duration-200 hover:border-tactical-accent/50">
                            <div class="flex items-start justify-between gap-3">
                                <a href="{{ route('loadouts.show', $item) }}"
                                    class="min-w-0 font-semibold text-slate-100 transition hover:text-tactical-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-tactical-accent">
                                    <span class="block truncate">{{ $item->title }}</span>
                                    <span class="mt-1 block text-xs text-slate-400">
                                        {{ $item->primaryWeapon?->name }} • {{ $item->gameMode?->name }}
                                    </span>
                                </a>
                                <span class="df-chip text-tactical-accent">Match {{ $suggestion['score'] }}</span>
                            </div>
                            <div class="mt-2 flex flex-wrap gap-1">
                                @foreach ($suggestion['reasons'] as $reason)
                                    <span
                                        class="rounded border border-tactical-line px-2 py-0.5 text-xs text-slate-300">{{ $reason }}</span>
                                @endforeach
                            </div>
                        </article>
                    @empty
                        <p class="text-sm text-slate-400">No similar builds yet. Check back after more community
                            submissions.</p>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</x-app-layout>
