<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('billing.plans.index', compact('plans'));
    }

    public function show(Plan $plan)
    {
        abort_unless($plan->is_active, 404);

        return view('billing.plans.show', compact('plan'));
    }
}
