<div class="df-panel p-4">
    <h3 class="df-title mb-3">Community Score</h3>
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-1">
            <button type="button" aria-label="Upvote loadout"
                class="df-btn-secondary min-h-0 px-2.5 py-2 hover:border-green-400 hover:text-green-400">
                <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M8 3 3.5 8h3v5h3V8h3L8 3Z" fill="currentColor" />
                </svg>
            </button>
            <button type="button" aria-label="Downvote loadout"
                class="df-btn-secondary min-h-0 px-2.5 py-2 hover:border-red-400 hover:text-red-400">
                <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="m8 13 4.5-5h-3V3h-3v5h-3L8 13Z" fill="currentColor" />
                </svg>
            </button>
        </div>
        <span class="text-2xl font-black text-tactical-accent">{{ $loadout->vote_score }}</span>
        <span class="text-xs text-slate-500">points</span>
    </div>
    @guest
        <p class="mt-3 rounded-lg bg-slate-950/50 px-3 py-2 text-xs text-slate-400">
            <a href="{{ route('login') }}" class="text-tactical-accent hover:underline">Login</a> to vote on this loadout.
        </p>
    @endguest
</div>
