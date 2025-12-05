<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment History') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($payments->isEmpty())
                        <p class="text-gray-600">Belum ada pembayaran.</p>
                    @else
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2">Tanggal</th>
                                    <th class="text-left py-2">Invoice</th>
                                    <th class="text-left py-2">Plan</th>
                                    <th class="text-left py-2">Jumlah</th>
                                    <th class="text-left py-2">Status</th>
                                    <th class="text-left py-2">Provider</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr class="border-b">
                                        <td class="py-2">
                                            {{ optional($payment->paid_at ?? $payment->created_at)->format('d M Y H:i') }}
                                        </td>
                                        <td class="py-2">
                                            {{ $payment->invoice_number }}
                                        </td>
                                        <td class="py-2">
                                            {{ $payment->plan->name ?? '-' }}
                                        </td>
                                        <td class="py-2">
                                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="py-2">
                                            <span class="uppercase text-xs px-2 py-1 rounded bg-gray-100">
                                                {{ $payment->status }}
                                            </span>
                                        </td>
                                        <td class="py-2">
                                            {{ strtoupper($payment->provider) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $payments->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
