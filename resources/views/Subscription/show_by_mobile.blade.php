<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>


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



    @include('Payment.payment_list',['payments'=>$subscription->payments])


</x-admin-layout>
