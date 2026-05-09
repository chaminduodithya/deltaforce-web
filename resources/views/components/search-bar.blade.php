<form method="GET" action="{{ route('loadouts.browse') }}">
    <div class="df-panel flex items-center gap-2 p-3">
        <div class="df-search-wrap flex-1">
            <svg class="df-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search loadouts or weapons…"
                class="df-input" aria-label="Search loadouts">
        </div>
        <button type="submit" class="df-btn-secondary px-4" aria-label="Submit search">
            <svg class="h-4 w-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span class="hidden sm:inline">Search</span>
        </button>
    </div>
</form>
