<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPlanLimit
{
    public function handle(Request $request, Closure $next, string $resource, string $column)
    {
        $user = $request->user();
        $plan = $user?->currentPlan();

        if (! $plan) {
            return redirect()
                ->route('app.billing.plans.index')
                ->with('status', 'You need an active plan to use this feature.');
        }

        $limit = $plan->$column;

        // unlimited
        if ($limit === null) {
            return $next($request);
        }

        $count = match ($resource) {
            'projects' => $user->projects()->count(),
            default    => 0,
        };

        if ($count >= $limit) {
            return redirect()
                ->route('app.billing.plans.index')
                ->with('status', "You have reached your {$resource} limit. Please upgrade your plan.");
        }

        return $next($request);
    }
}
