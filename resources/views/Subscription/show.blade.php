<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>



    @if ($subscription)
        <tr>

            <td class="px-3">
                {{ $subscription->payer }}
            </td>
            <td class="px-3"> {{ $subscription->amount }}</td>
            <td class="px-3"> {{ $subscription->startDate }}</td>
            <td class="px-3"> {{ $subscription->expiryDate }}</td>
            <td class="px-3"> {{ $subscription->frequency }}</td>
            <td class="px-3"> {{ $subscription->status }}</td>

        </tr>

        @include('Payment.payment_list', ['payments' => $subscription->payments])

    @endif







</x-admin-layout>
