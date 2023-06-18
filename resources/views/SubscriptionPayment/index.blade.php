<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscriptiopn Payments') }}
        </h2>
    </x-slot>



    <a href="{{route("admin.subscriptions.index")}}"> &lt; Back </a>

    @if ($subscription)


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

        </x-slot>

    </x-list-item-card>


        {{-- @include('Payment.payment_list', ['payments' => $subscription->payments]) --}}

    @endif


    @foreach ($payments as $payment)
        <div>
            Id : {{ $payment->id }}
        </div>

        <div>
            subscriptionId : {{ $payment->subscriptionId }}
        </div>

        <div>
            subscriptionRequestId : {{ $payment->subscriptionRequestId }}
        </div>

        <div>
            dueDate : {{ $payment->dueDate }}
        </div>

        <div>
            status : {{ $payment->status }}
        </div>

        <div>
            trxId : {{ $payment->trxId }}
        </div>

        <div>
            trxTime : {{ $payment->trxTime }}
        </div>

        <div>
            subscriptionId : {{ $payment->subscriptionId }}
        </div>

        <div>
            amount : {{ $payment->amount }}
        </div>
        <div>
            reverseTrxAmount : {{ $payment->reverseTrxAmount }}
        </div>
        <div>
            reverseTrxId : {{ $payment->reverseTrxId }}
        </div>
        <div>
            reverseTrxTime : {{ $payment->reverseTrxTime }}
        </div>

        <br>
    @endforeach


</x-admin-layout>
