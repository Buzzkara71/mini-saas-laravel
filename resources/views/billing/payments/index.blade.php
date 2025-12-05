<x-app-modern title="Payments">
    <div class="glass-panel rounded-3xl p-6 card-hover">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="pill mb-2">Billing</p>
                <h2 class="text-2xl font-bold">Payment History</h2>
                <p class="text-slate-300">Latest transactions associated with your subscriptions.</p>
            </div>
            <a href="{{ route('app.billing.plans.index') }}" class="soft-btn-secondary hidden sm:inline-flex">
                Manage plans
            </a>
            <a href="{{ route('app.billing.export.pdf') }}" class="soft-btn-primary hidden sm:inline-flex">
                Export PDF
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-white/10">
            <table class="min-w-full text-sm text-slate-100">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Invoice</th>
                        <th class="px-4 py-3 text-left font-semibold">Plan</th>
                        <th class="px-4 py-3 text-left font-semibold">Amount</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-left font-semibold">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($payments as $payment)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-4 py-3 font-semibold">{{ $payment->invoice_number }}</td>
                            <td class="px-4 py-3">{{ $payment->plan->name ?? '—' }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full bg-white/10 px-2 py-1 text-xs uppercase tracking-wide border border-white/10">
                                    {{ $payment->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                {{ optional($payment->paid_at ?? $payment->created_at)->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-slate-300">
                                No payments recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    </div>
</x-app-modern>
