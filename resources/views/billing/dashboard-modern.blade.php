<x-app-modern title="Billing">
    <div class="space-y-6">
        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Current Plan --}}
            <div class="glass-panel rounded-2xl p-6 card-hover lg:col-span-2">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="pill mb-2">Current plan</p>
                        <h2 class="text-2xl font-bold">
                            {{ $currentSubscription?->plan->name ?? 'No plan selected' }}
                        </h2>
                        <p class="text-slate-300 mt-2">
                            {{ $currentSubscription ? 'Renews ' . optional($currentSubscription->renews_at)->format('d M Y') : 'Pick a plan to unlock all features.' }}
                        </p>
                    </div>
                    <a href="{{ route('app.billing.plans.index') }}" class="soft-btn-primary">
                        Manage plan
                    </a>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="glass-panel rounded-2xl p-6 card-hover">
                <h3 class="text-lg font-semibold">Quick actions</h3>
                <div class="mt-4 space-y-3 text-sm">
                    <a href="{{ route('app.billing.plans.index') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 hover:bg-white/20 transition">
                        <span>Change plan</span>
                        <span aria-hidden="true">→</span>
                    </a>
                    <a href="{{ route('app.billing.export.pdf') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 hover:bg-white/20 transition">
                        <span>Export PDF</span>
                        <span aria-hidden="true">→</span>
                    </a>
                    <a href="{{ route('app.billing.payments.index') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 hover:bg-white/20 transition">
                        <span>View payments</span>
                        <span aria-hidden="true">→</span>
                    </a>
                    <a href="{{ route('app.projects.index') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 hover:bg-white/20 transition">
                        <span>Back to projects</span>
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="glass-panel rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Recent payments</h3>
                <span class="text-xs text-slate-300">Last 10</span>
            </div>

            <div class="mt-4 divide-y divide-white/5">
                @forelse ($payments as $payment)
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="font-semibold">Invoice {{ $payment->invoice_number }}</p>
                            <p class="text-slate-300 text-sm">
                                {{ optional($payment->paid_at ?? $payment->created_at)->format('d M Y H:i') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                            <span class="text-xs uppercase px-2 py-1 rounded-full bg-white/10 border border-white/10">
                                {{ $payment->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-300 py-4">No payments yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-modern>
