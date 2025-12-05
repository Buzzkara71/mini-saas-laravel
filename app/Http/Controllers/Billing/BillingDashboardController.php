<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class BillingDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $currentSubscription = $user->subscriptions()
            ->with('plan')
            ->latest('starts_at')
            ->first();

        $payments = $user->payments()
            ->with('plan')
            ->latest()
            ->take(10)
            ->get();

        return view('billing.dashboard-modern', [
            'user'               => $user,
            'currentSubscription'=> $currentSubscription,
            'payments'           => $payments,
        ]);
    }

    public function exportPdf(Request $request)
{
    $user = $request->user();
    $subscription = $user->currentSubscription();
    $payments = $user->payments()->latest()->get();

    $pdf = Pdf::loadView('billing.export-pdf', [
        'user' => $user,
        'subscription' => $subscription,
        'payments' => $payments
    ]);

    return $pdf->download('billing-summary-' . now()->format('Ymd') . '.pdf');
    }
}
