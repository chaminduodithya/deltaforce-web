<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#070b11">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Delta Force Hub') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="df-main-shell min-h-screen">
            <header class="sticky top-0 z-30 border-b border-tactical-line bg-tactical-bg/90 backdrop-blur">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6">
                    <a href="{{ route('home') }}" class="df-title rounded-md px-1 text-xl font-bold text-tactical-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-tactical-accent">
                        DELTA FORCE HUB
                    </a>
                    <nav class="hidden items-center gap-6 text-sm md:flex">
                        <a class="df-nav-link" href="{{ route('home') }}">Home</a>
                        <a class="df-nav-link" href="{{ route('loadouts.browse') }}">Browse</a>
                        <a class="df-nav-link" href="{{ route('loadouts.create') }}">Create</a>
                        <a class="df-nav-link" href="{{ route('weapons.index') }}">Weapons</a>
                    </nav>
                    <div class="flex items-center gap-2 text-sm">
                        @auth
                            <a class="df-btn-secondary min-h-0 px-3 py-1.5 normal-case tracking-normal" href="{{ route('profile.edit') }}">{{ auth()->user()->name }}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="df-btn-secondary min-h-0 px-3 py-1.5" type="submit">Logout</button>
                            </form>
                        @else
                            <a class="df-btn-secondary min-h-0 px-3 py-1.5" href="{{ route('login') }}">Login</a>
                            <a class="df-btn-primary min-h-0 px-3 py-1.5" href="{{ route('register') }}">Register</a>
                        @endauth
                    </div>
                </div>
            </header>

            @isset($header)
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6">
                    <h1 class="df-title text-2xl">{{ $header }}</h1>
                </div>
            @endisset

            <main class="df-mobile-main mx-auto max-w-7xl px-4 py-6 sm:px-6">
                {{ $slot }}
            </main>

            <footer class="border-t border-tactical-line py-5 text-center text-sm text-slate-400">
                Built for the DF community.
            </footer>

            <nav class="df-mobile-nav" aria-label="Mobile Navigation">
                <div class="mx-auto flex max-w-7xl items-stretch">
                    <a href="{{ route('home') }}" class="df-mobile-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M4 10.5 12 4l8 6.5V20H4v-9.5Z" stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('loadouts.browse') }}" class="df-mobile-nav-link {{ request()->routeIs('loadouts.browse', 'loadouts.show') ? 'is-active' : '' }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <span>Browse</span>
                    </a>
                    <a href="{{ route('loadouts.create') }}" class="df-mobile-nav-link {{ request()->routeIs('loadouts.create') ? 'is-active' : '' }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <span>Create</span>
                    </a>
                    <a href="{{ route('weapons.index') }}" class="df-mobile-nav-link {{ request()->routeIs('weapons.*') ? 'is-active' : '' }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M3 13h8l3-3 7 7-2 2-7-7-3 3H3v-2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        </svg>
                        <span>Weapons</span>
                    </a>
                </div>
            </nav>
        </div>
    </body>
</html>
