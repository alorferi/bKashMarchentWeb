<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>


    @include('Subscription.index_form')

    <div class="p-2">
        {!! $subscriptions->links() !!}
    </div>



    <table>

        <tr>
            <th>Actions</th>
            <th>Name & Email</th>
            <th>Payer</th>
            <th>Amount</th>
            <th>Start Date</th>
            <th>Expiry Date</th>
            <th>Frequency</th>
            <th>Status</th>
        </tr>

        @forelse($subscriptions as $subscription)
            <tr>

                <td class="px-3">
                    <a href="{{ route('admin.subscriptions.show', $subscription->id) }}"> Show</a>
                    <br>
                    <a href="{{ route('admin.subscription-payments.index', $subscription->id) }}"> Payments</a>
                </td>


                <td class="px-3">

                    @if ($subscription->subscriptionRequest)
                        {{ $subscription->subscriptionRequest->name }}
                        <br>
                        {{ $subscription->subscriptionRequest->email }}
                        <br>
                        {{ $subscription->created_at->diffForHumans() }}
                    @endif

                </td>


                <td class="px-3">
                    {{ $subscription->payer }}
                </td>
                <td class="px-3"> {{ $subscription->amount }}</td>
                <td class="px-3"> {{ $subscription->startDate->format('d-m-Y') }}</td>
                <td class="px-3"> {{ $subscription->expiryDate->format('d-m-Y') }}
                    ({{ $subscription->expiryDate->diffForHumans() }})
                </td>
                <td class="px-3"> {{ $subscription->frequency }}</td>
                <td class="px-3"> {{ $subscription->status }}</td>

            </tr>




        @empty
            <tr>
                <td>No Posts</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $subscriptions->links() !!}
    </div>


</x-admin-layout>
