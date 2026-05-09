<aside class="df-panel h-fit p-4">
    <h2 class="df-title text-lg">Filters</h2>
    <form method="GET" action="{{ route('loadouts.browse') }}" class="mt-4 space-y-4">
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
                    <option value="{{ $value }}" @selected(request('platform') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="mb-1 block text-xs text-slate-400">Server</span>
            <select name="server" class="df-input">
                <option value="">All</option>
                @foreach ($servers as $value => $label)
                    <option value="{{ $value }}" @selected(request('server') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="mb-1 block text-xs text-slate-400">Sort</span>
            <select name="sort" class="df-input">
                @foreach (['popular', 'newest', 'top-rated', 'most-copied'] as $sort)
                    <option value="{{ $sort }}" @selected(request('sort', 'popular') === $sort)>{{ ucwords(str_replace('-', ' ', $sort)) }}</option>
                @endforeach
            </select>
        </label>

        <button type="submit" class="df-btn-primary w-full">Apply Filters</button>
    </form>
</aside>

