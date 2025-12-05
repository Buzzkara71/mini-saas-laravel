{{-- resources/views/layouts/app-modern.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Mini SaaS App' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-['Plus_Jakarta_Sans'] bg-slate-950 text-slate-100">
<div class="relative min-h-screen overflow-hidden">

    {{-- Ambient background --}}
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 bg-grid opacity-20"></div>
        <div class="absolute -top-24 -left-24 h-72 w-72 bg-indigo-500/25 blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 h-96 w-96 bg-purple-500/20 blur-3xl"></div>
    </div>

    <div x-data="{ open: false }" class="relative flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="hidden lg:flex w-72 flex-col gap-6 p-6 glass-panel border-white/10">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-500/40">
                    MS
                </div>
                <div>
                    <p class="text-sm text-slate-300">Mini SaaS</p>
                    <p class="text-lg font-semibold">{{ auth()->user()->name ?? 'User' }}</p>
                </div>
            </div>

            <nav class="space-y-1 text-sm font-semibold">
                <a href="{{ route('app.dashboard') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 transition card-hover {{ request()->routeIs('app.dashboard') ? 'bg-white/15 border border-white/20 text-white' : 'text-slate-200 hover:bg-white/10' }}">
                    <span class="h-2 w-2 rounded-full {{ request()->routeIs('app.dashboard') ? 'bg-indigo-400 shadow-[0_0_0_4px_rgba(99,102,241,0.25)]' : 'bg-slate-500' }}"></span>
                    Dashboard
                </a>

                <a href="{{ route('app.projects.index') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 transition card-hover {{ request()->routeIs('app.projects.*') ? 'bg-white/15 border border-white/20 text-white' : 'text-slate-200 hover:bg-white/10' }}">
                    <span class="h-2 w-2 rounded-full {{ request()->routeIs('app.projects.*') ? 'bg-indigo-400 shadow-[0_0_0_4px_rgba(99,102,241,0.25)]' : 'bg-slate-500' }}"></span>
                    Projects
                </a>

                <a href="{{ route('app.billing.index') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 transition card-hover {{ request()->routeIs('app.billing.*') ? 'bg-white/15 border border-white/20 text-white' : 'text-slate-200 hover:bg-white/10' }}">
                    <span class="h-2 w-2 rounded-full {{ request()->routeIs('app.billing.*') ? 'bg-indigo-400 shadow-[0_0_0_4px_rgba(99,102,241,0.25)]' : 'bg-slate-500' }}"></span>
                    Billing
                </a>
            </nav>

            <div class="mt-auto flex items-center gap-3 rounded-2xl bg-white/5 border border-white/10 px-4 py-3">
                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-400 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="text-sm">
                    <p class="font-semibold">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-slate-300">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
        </aside>

        {{-- MOBILE HEADER --}}
        <div class="lg:hidden fixed top-0 inset-x-0 z-20 px-4 pt-4">
            <div class="glass-panel flex items-center justify-between rounded-2xl px-4 py-3 border border-white/10">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold">MS</div>
                    <div>
                        <p class="text-xs text-slate-300">Mini SaaS</p>
                        <p class="font-semibold">{{ $title ?? 'Dashboard' }}</p>
                    </div>
                </div>
                <button @click="open = !open" class="rounded-xl bg-white/10 p-2 hover:bg-white/20 transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'block': !open }" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'block': open, 'hidden': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div x-show="open" x-transition class="mt-3 glass-panel rounded-2xl px-4 py-3 space-y-2 border border-white/10">
                <a href="{{ route('app.dashboard') }}" class="block rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('app.dashboard') ? 'bg-white/15 text-white' : 'text-slate-200' }}">Dashboard</a>
                <a href="{{ route('app.projects.index') }}" class="block rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('app.projects.*') ? 'bg-white/15 text-white' : 'text-slate-200' }}">Projects</a>
                <a href="{{ route('app.billing.index') }}" class="block rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('app.billing.*') ? 'bg-white/15 text-white' : 'text-slate-200' }}">Billing</a>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 pt-24 lg:pt-10 px-4 lg:px-10 pb-10">
            <div class="glass-panel rounded-3xl border-white/15 px-6 py-5 mb-6 card-hover">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="pill mb-2">Mini SaaS</p>
                        <h1 class="text-3xl font-bold">{{ $title ?? '' }}</h1>
                        <p class="text-slate-300 mt-1">Curated metrics and actions tailored for you.</p>
                    </div>
                    <div class="hidden sm:flex items-center gap-3">
                        <a href="{{ route('app.projects.create') }}" class="soft-btn-secondary">New project</a>
                        <a href="{{ route('app.billing.index') }}" class="soft-btn-primary">Billing</a>
                    </div>
                </div>
            </div>

            <div class="relative z-10">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
</body>
</html>
