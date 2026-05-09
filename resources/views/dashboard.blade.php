<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="df-panel p-6">
        <p class="text-slate-300">{{ __("You're logged in!") }}</p>
        <div class="mt-4 flex gap-2">
            <a href="{{ route('loadouts.create') }}" class="df-btn-primary">Create Loadout</a>
            <a href="{{ route('loadouts.browse') }}" class="df-btn-secondary">Browse Builds</a>
        </div>
    </div>
</x-app-layout>
