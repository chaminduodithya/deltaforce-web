<aside x-data="{ open: window.innerWidth >= 1024 }" class="df-panel h-fit p-4">
    <button @click="open = !open" class="flex w-full items-center justify-between lg:pointer-events-none"
        aria-expanded="true">
        <h2 class="df-title text-lg">Filters</h2>
        <svg class="h-4 w-4 text-slate-400 transition-transform lg:hidden" :class="{ 'rotate-180': open }" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <form method="GET" action="{{ route('loadouts.browse') }}" class="mt-4 space-y-4" x-show="open" x-collapse>
        <label class="block">
            <span class="mb-1 block text-xs text-slate-400">Category</span>
            <select name="category" class="df-input">
                <option value="">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="mb-1 block text-xs text-slate-400">Mode</span>
            <select name="mode" class="df-input">
                <option value="">All</option>
                @foreach ($modes as $mode)
                    <option value="{{ $mode->slug }}" @selected(request('mode') === $mode->slug)>{{ $mode->name }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="mb-1 block text-xs text-slate-400">Platform</span>
            <select name="platform" class="df-input">
                <option value="">All</option>
                @foreach ($platforms as $value => $label)
                    <option value="{{ $value }}" @selected(($activePlatform ?? request('platform')) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="mb-1 block text-xs text-slate-400">Server</span>
            <select name="server" class="df-input">
                <option value="">All</option>
                @foreach ($servers as $value => $label)
                    <option value="{{ $value }}" @selected(($activeServer ?? request('server')) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="mb-1 block text-xs text-slate-400">Sort</span>
            <select name="sort" class="df-input">
                @foreach (['popular', 'newest', 'top-rated', 'most-copied'] as $sort)
                    <option value="{{ $sort }}" @selected(request('sort', 'popular') === $sort)>
                        {{ ucwords(str_replace('-', ' ', $sort)) }}</option>
                @endforeach
            </select>
        </label>

        <button type="submit" class="df-btn-primary w-full">Apply Filters</button>
    </form>
</aside>
