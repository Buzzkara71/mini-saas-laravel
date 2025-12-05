<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'plan_id' => ['required', 'exists:plans,id'],
        ]);

        $user = $request->user();
        $plan = Plan::findOrFail($request->plan_id);
        $user->subscriptions()
            ->whereIn('status', ['active', 'on_trial', 'past_due'])
            ->update(['status' => 'canceled', 'canceled_at' => now()]);

        $subscription = Subscription::create([
            'user_id'               => $user->id,
            'plan_id'               => $plan->id,
            'name'                  => 'default',
            'status'                => $plan->price_monthly > 0 ? 'active' : 'on_trial',
            'starts_at'             => now(),
            'renews_at'             => now()->addMonth(),
            'payment_gateway'       => 'manual', 
            'gateway_subscription_id' => null,
            'meta'                  => [],
        ]);

        if ($plan->price_monthly > 0) {
            Payment::create([
                'user_id'               => $user->id,
                'subscription_id'       => $subscription->id,
                'plan_id'               => $plan->id,
                'amount'                => $plan->price_monthly,
                'currency'              => $plan->currency,
                'status'                => 'paid',
                'provider'              => 'manual',
                'provider_payment_id'   => null,
                'provider_raw_response' => [],
                'invoice_number'        => 'INV-' . now()->format('YmdHis') . '-' . $user->id,
                'description'           => 'Manual payment for plan ' . $plan->name,
                'paid_at'               => now(),
            ]);
        }

            $request->validate([
                'plan_id' => 'required|exists:plans,id',
            ]);

            $user = $request->user();
            $newPlan = Plan::findOrFail($request->plan_id);

            $activeSubscription = $user->subscriptions()
                ->where('status', 'active')
                ->latest()
                ->first();

            // if user has no active subscription -> create new subscription
            if (!$activeSubscription) {
                $user->subscriptions()->create([
                    'plan_id' => $newPlan->id,
                    'status' => 'active',
                    'starts_at' => now(),
                    'renews_at' => now()->addMonth(),
                ]);

                return redirect()->route('app.billing.index')
                    ->with('status', 'Plan activated successfully.');
            }

            // if user has existing active subscription
            if ($activeSubscription->plan_id == $newPlan->id) {
                return redirect()->route('app.billing.index')
                    ->with('status', 'You are already on this plan.');
            }

            // Update active subscription 
            $activeSubscription->update([
                'plan_id' => $newPlan->id,
                'updated_at' => now(),
            ]);

            return redirect()->route('app.billing.index')
                ->with('status', 'Plan changed to ' . $newPlan->name . ' successfully.');
        }
}    