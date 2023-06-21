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

    @forelse($subscriptions as $subscription)
        @php
            $textColor = $subscription->status == 'CANCELLED' ? 'text-red-600' : 'text-gray-600';
            $bgColor = $subscription->status == 'CANCELLED' ? 'bg-red-600' : 'bg-green-600';
        @endphp

        <x-list-item-card>

            <x-slot name="title">

                <div class="{{ $bgColor }} px-2 py-1 text-white">
                    {{ $subscription->payer }}
                </div>

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

                <x-list-item-prop>

                    <x-slot name="label">
                        Donaion Sector
                    </x-slot>

                    {{ $subscription->subscriptionRequest->donationSector->name }}

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
                    End Date
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

                <x-a-primary href="{{ route('admin.subscriptions.show', $subscription->id) }}"> Update</x-a-primary>
                |
                <x-a-success href="{{ route('admin.subscription-payments.index', $subscription->id) }}"> Payments
                </x-a-success>

            </x-slot>

        </x-list-item-card>

    @empty
    @endforelse
    </table>

    <div class="p-2">
        {!! $subscriptions->links() !!}
    </div>


</x-admin-layout>
