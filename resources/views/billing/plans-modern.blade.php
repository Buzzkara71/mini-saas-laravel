<x-app-modern title="Choose a Plan">
    <div class="space-y-6">
        <div>
            <p class="pill mb-2">Pricing</p>
            <h2 class="text-2xl font-bold">Pick the plan that fits</h2>
            <p class="text-slate-300">Simple tiers with transparent pricing and curated features.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($plans as $plan)
                <div class="glass-panel rounded-2xl p-6 card-hover flex flex-col gap-4">
                    <div>
                        <h3 class="text-xl font-semibold">{{ $plan->name }}</h3>
                        <p class="text-slate-300 mt-1">{{ $plan->description }}</p>
                    </div>

                    <div>
                        <p class="text-4xl font-extrabold text-indigo-200">
                            @if ($plan->price_monthly > 0)
                                Rp {{ number_format($plan->price_monthly, 0, ',', '.') }}
                            @else
                                Free
                            @endif
                        </p>
                        <p class="text-slate-400">per month</p>
                    </div>

                    <ul class="space-y-2 text-slate-200 text-sm">
                        @foreach ($plan->data['features'] ?? [] as $feature)
                            <li class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>

                    <form method="POST" action="{{ route('app.billing.subscribe') }}" class="mt-auto">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                        <button class="w-full soft-btn-primary justify-center">
                            Choose {{ $plan->name }}
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-modern>
