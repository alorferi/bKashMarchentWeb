@forelse($subscriptions as $subscription)
    <x-list-item-card>

        <x-slot name="title">
            {{ $subscription->payer }}
        </x-slot>

        @if ($subscription->subscriptionRequest)
                <x-list-item-prop>

                    <x-slot name="label">
                        Name
                    </x-slot>
                    {{ $subscription->subscriptionRequest->name }}

                </x-list-item-prop>

                <x-list-item-prop>

                    <x-slot name="label">
                        Email
                    </x-slot>

                    {{ $subscription->subscriptionRequest->email }}

                </x-list-item-prop>
            @endif

        <x-list-item-prop>
            <x-slot name="label">
                Amount
            </x-slot>

            {{ $subscription->amount }}
        </x-list-item-prop>



        <x-list-item-prop>
            <x-slot name="label">
                Start Date
            </x-slot>

            {{ $subscription->startDate->format('d-m-Y') }}

        </x-list-item-prop>


        <x-list-item-prop>
            <x-slot name="label">
                Expiry Date
            </x-slot>

            {{ $subscription->expiryDate->format('d-m-Y') }}
            ({{ $subscription->expiryDate->diffForHumans() }})
        </x-list-item-prop>

        <x-list-item-prop>
            <x-slot name="label">
                Frequency
            </x-slot>

            {{ $subscription->frequency }}

        </x-list-item-prop>

        <x-list-item-prop>
            <x-slot name="label">
                Status
            </x-slot>

            {{ $subscription->status }}

        </x-list-item-prop>

        <x-slot name="footer">


            <x-a-primary href="{{ route('subscription-payments.my-payments-by-subscription-id', $subscription->id) }}">
                Payments</x-a-primary>

                |
                <x-a-danger href="{{ route('subscription-payments.my-payments-by-subscription-id', $subscription->id) }}">
                    Cancel</x-a-danger>

        </x-slot>

    </x-list-item-card>







@empty

@endforelse
</table>
