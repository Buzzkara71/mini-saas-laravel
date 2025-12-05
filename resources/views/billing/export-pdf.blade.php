<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Billing Summary</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        .section-title { font-size: 16px; font-weight: bold; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        table th, table td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        .highlight { background-color: #f2f2f2; padding: 10px; border-radius: 6px; }
    </style>
</head>
<body>

<div class="header">Billing Summary</div>

<div>
    <strong>User:</strong> {{ $user->name }}  
    <br>
    <strong>Email:</strong> {{ $user->email }}
</div>

<div class="section-title">Current Subscription</div>

@if ($subscription)
    <div class="highlight">
        <strong>Plan:</strong> {{ $subscription->plan->name }} <br>
        <strong>Renews On:</strong> {{ $subscription->renews_at?->format('d M Y') }} <br>
        <strong>Status:</strong> {{ ucfirst($subscription->status) }}
    </div>
@else
    <p>No active subscription.</p>
@endif


<div class="section-title">Payment History</div>

@if ($payments->isEmpty())
    <p>No payments recorded.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Paid At</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->invoice_number }}</td>
                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                <td>{{ ucfirst($payment->status) }}</td>
                <td>{{ $payment->paid_at?->format('d M Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

</body>
</html>
