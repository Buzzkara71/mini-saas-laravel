<x-app-modern title="Dashboard">
    <div class="space-y-6">

        {{-- Hero --}}
        <div class="glass-panel rounded-3xl border-white/15 p-6 md:p-8 card-hover">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <p class="pill">Welcome back</p>
                    <h2 class="text-3xl md:text-4xl font-bold mt-3">Hi {{ $user->name }} 👋</h2>
                    <p class="text-slate-300 mt-2">Track your product usage, manage projects, and stay on top of billing in one place.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('app.projects.create') }}" class="soft-btn-primary">Create project</a>
                    <a href="{{ route('app.billing.index') }}" class="soft-btn-secondary">Billing overview</a>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid md:grid-cols-3 gap-4">
            <div class="glass-panel rounded-2xl p-5 card-hover">
                <p class="text-sm text-slate-300">Total Projects</p>
                <p class="text-4xl font-bold mt-2">{{ $stats['projects_count'] }}</p>
                <div class="mt-4 h-2 rounded-full bg-white/10 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500" style="width: {{ min(100, $stats['projects_count'] * 10) }}%"></div>
                </div>
            </div>

            <div class="glass-panel rounded-2xl p-5 card-hover">
                <p class="text-sm text-slate-300">Active Plan</p>
                <p class="text-2xl font-semibold mt-2 text-indigo-200">
                    {{ $stats['active_plan'] ?? 'No plan yet' }}
                </p>
                <a href="{{ route('app.billing.plans.index') }}" class="text-indigo-200 text-sm mt-3 inline-flex items-center gap-2 hover:text-white transition">
                    Manage Plan
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <div class="glass-panel rounded-2xl p-5 card-hover">
                <p class="text-sm text-slate-300">Next Renewal</p>
                <p class="text-xl font-medium mt-2">
                    {{ $stats['next_renewal'] ?? '—' }}
                </p>
                <p class="text-xs text-slate-400 mt-1">Stay ahead of your billing cycle.</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <div class="glass-panel rounded-2xl p-6 card-hover lg:col-span-2">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Quick actions</h3>
                    <span class="text-xs text-slate-400">Fast tracks</span>
                </div>
                <div class="mt-4 grid sm:grid-cols-3 gap-3">
                    <a href="{{ route('app.projects.create') }}" class="rounded-xl bg-white/10 border border-white/10 px-4 py-3 hover:bg-white/20 transition flex flex-col gap-1">
                        <span class="text-sm text-slate-300">New project</span>
                        <span class="font-semibold">Start something fresh</span>
                    </a>
                    <a href="{{ route('app.projects.index') }}" class="rounded-xl bg-white/10 border border-white/10 px-4 py-3 hover:bg-white/20 transition flex flex-col gap-1">
                        <span class="text-sm text-slate-300">All projects</span>
                        <span class="font-semibold">Review recent work</span>
                    </a>
                    <a href="{{ route('app.billing.index') }}" class="rounded-xl bg-white/10 border border-white/10 px-4 py-3 hover:bg-white/20 transition flex flex-col gap-1">
                        <span class="text-sm text-slate-300">Billing</span>
                        <span class="font-semibold">Check status &amp; renewals</span>
                    </a>
                </div>
            </div>

            <div class="glass-panel rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Account pulse</h3>
                    <span class="text-xs text-emerald-300">Live</span>
                </div>
                <ul class="mt-4 space-y-3 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-emerald-400"></span>
                        <div>
                            <p class="font-semibold">Plan status</p>
                            <p class="text-slate-300">{{ $stats['active_plan'] ? 'On ' . $stats['active_plan'] : 'No active plan yet' }}</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-indigo-400"></span>
                        <div>
                            <p class="font-semibold">Projects</p>
                            <p class="text-slate-300">{{ $stats['projects_count'] }} total created</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-purple-400"></span>
                        <div>
                            <p class="font-semibold">Next renewal</p>
                            <p class="text-slate-300">{{ $stats['next_renewal'] ?? '—' }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</x-app-modern>
