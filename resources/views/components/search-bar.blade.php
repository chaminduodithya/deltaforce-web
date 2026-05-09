<form method="GET" action="{{ route('loadouts.browse') }}">
    <div class="df-panel flex items-center gap-2 p-3">
        <input
            type="search"
            name="q"
            value="{{ request('q') }}"
            placeholder="Search loadouts or weapons…"
            class="df-input"
        >
        <button type="submit" class="df-btn-secondary px-3">Search</button>
    </div>
</form>

