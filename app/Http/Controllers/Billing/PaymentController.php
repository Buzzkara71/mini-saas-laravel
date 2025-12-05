<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = $request->user()
            ->payments()
            ->with('plan')
            ->latest()
            ->paginate(15);

        return view('billing.payments.index', compact('payments'));
    }
}
