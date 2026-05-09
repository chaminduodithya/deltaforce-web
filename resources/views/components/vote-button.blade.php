<div class="df-panel p-4">
    <h3 class="df-title mb-2">Community Score</h3>
    <div class="flex items-center gap-2">
        <button type="button" aria-label="Upvote loadout" class="df-btn-secondary min-h-0 px-2 py-2">
            <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <path d="M8 3 3.5 8h3v5h3V8h3L8 3Z" fill="currentColor" />
            </svg>
        </button>
        <button type="button" aria-label="Downvote loadout" class="df-btn-secondary min-h-0 px-2 py-2">
            <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <path d="m8 13 4.5-5h-3V3h-3v5h-3L8 13Z" fill="currentColor" />
            </svg>
        </button>
        <span class="font-semibold text-tactical-accent">{{ $loadout->vote_score }}</span>
    </div>
    @guest
        <p class="mt-2 text-xs text-slate-400">Login required for voting.</p>
    @endguest
</div>

