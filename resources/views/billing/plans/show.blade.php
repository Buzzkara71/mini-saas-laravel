<x-app-modern :title="$plan->name">
    <div class="max-w-4xl space-y-6">
        <div class="glass-panel rounded-3xl p-8 card-hover">
            <p class="pill mb-2">Plan detail</p>
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold">{{ $plan->name }}</h1>
                    <p class="text-slate-300 mt-2">{{ $plan->description }}</p>
                </div>
                <div class="text-right">
                    <p class="text-4xl font-extrabold text-indigo-200">
                        @if ($plan->price_monthly > 0)
                            Rp {{ number_format($plan->price_monthly, 0, ',', '.') }}
                        @else
                            Free
                        @endif
                    </p>
                    <p class="text-slate-400">per month</p>
                </div>
            </div>
        </div>

        <div class="glass-panel rounded-3xl p-8 card-hover">
            <h2 class="text-xl font-semibold mb-4">What's included</h2>
            <ul class="space-y-3 text-slate-200">
                @forelse ($plan->data['features'] ?? [] as $feature)
                    <li class="flex items-start gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-emerald-400"></span>
                        <span>{{ $feature }}</span>
                    </li>
                @empty
                    <li class="text-slate-400">No features listed.</li>
                @endforelse
            </ul>
        </div>

        <div class="flex flex-wrap gap-3">
            <form method="POST" action="{{ route('app.billing.subscribe') }}">
                @csrf
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                <button class="soft-btn-primary">Choose this plan</button>
            </form>

            <a href="{{ route('app.billing.plans.index') }}" class="soft-btn-secondary">
                Back to plans
            </a>
        </div>
    </div>
</x-app-modern>
