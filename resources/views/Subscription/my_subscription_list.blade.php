{{-- <tr>

    <td class="px-3">
        {{ $subscription->payer }}
    </td>
    <td class="px-3"> {{ $subscription->amount }}</td>
    <td class="px-3"> {{ $subscription->startDate }}</td>
    <td class="px-3"> {{ $subscription->expiryDate }}</td>
    <td class="px-3"> {{ $subscription->frequency }}</td>
    <td class="px-3"> {{ $subscription->status }}</td>

</tr> --}}


<table>

    <tr>
        <th>Actions</th>
        <th>Name & Email</th>
        <th>Payer</th>
        <th>Amount</th>
        <th>startDate</th>
        <th>expiryDate</th>
        <th>frequency</th>
        <th>Status</th>

    </tr>

    @forelse($subscriptions as $subscription)
        <tr>

            <td class="px-3">
                <a href="{{ route('subscription-payments.my-payments-by-subscription-id', $subscription->id) }}"> Payments</a>
            </td>

            <td class="px-3">

                @if ($subscription->subscriptionRequest)
                    {{ $subscription->subscriptionRequest->name }}
                    <br>
                    {{ $subscription->subscriptionRequest->email }}
                @else
                    None
                @endif

            </td>

            <td class="px-3">
                {{ $subscription->payer }}
            </td>

            <td class="px-3"> {{ $subscription->amount }}</td>
            <td class="px-3">  {{ $subscription->startDate->format('d-m-Y') }}</td>
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
