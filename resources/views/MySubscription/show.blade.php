<x-guest-layout>


    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('My Payments') }}
        </h2>
    </x-slot>



    <x-list-card>


        <x-slot name="title">

            <x-list-item-card>

                <x-slot name="title">


                    @php
                        $textColor = $subscription->status == 'CANCELLED' ? 'text-red-600' : 'text-gray-600';
                        $bgColor = $subscription->status == 'CANCELLED' ? 'bg-red-600' : 'bg-green-600';
                    @endphp


                    <div class="py-2 text-center text-white {{ $bgColor }} rounded">
                        bKash Wallet: {{ $subscription->payer }}
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



                    <div class="{{ $textColor }}">
                        {{ $subscription->status }}
                    </div>


                </x-list-item-prop>

                <x-slot name="footer">

                    <x-a-danger href="{{ route('my-subscriptions.cancel', $subscription->id) }}" :visibility="$subscription->status != 'CANCELLED'">
                        Cancel</x-a-danger>

                </x-slot>






            </x-list-item-card>





        </x-slot>


        <div class="px-2">

            <div class="text-xl font-bold text-center text-white bg-gray-400 rounded-sm">
                Payments
            </div>

            @foreach ($payments as $payment)
                <x-list-item-card>

                    <x-slot name="title">
                    </x-slot>


                    <x-list-item-prop>
                        <x-slot name="label">
                            Id
                        </x-slot>

                        {{ $payment->id }}

                    </x-list-item-prop>

                    <x-list-item-prop>
                        <x-slot name="label">
                            Due Date
                        </x-slot>

                        {{ $payment->dueDate }}

                    </x-list-item-prop>


                    <x-list-item-prop>
                        <x-slot name="label">
                            Status
                        </x-slot>

                        {{ $payment->status }}

                    </x-list-item-prop>


                    <x-list-item-prop :visibility="$payment->trxId != null">

                        <x-slot name="label">
                            Trx Id
                        </x-slot>

                        {{ $payment->trxId }}
                    </x-list-item-prop>

                    <x-list-item-prop :visibility="$payment->trxTime != null">
                        <x-slot name="label">
                            Trx Time
                        </x-slot>
                        {{ $payment->trxTime }}
                    </x-list-item-prop>

                    <x-list-item-prop :visibility="$payment->reverseTrxAmount != null">
                        <x-slot name="label">
                            Reverse TrxAmount
                        </x-slot>
                        {{ $payment->reverseTrxAmount }}
                    </x-list-item-prop>

                    <x-list-item-prop :visibility="$payment->reverseTrxId != null">
                        <x-slot name="label">
                            Reverse Trx Id
                        </x-slot>
                        {{ $payment->reverseTrxId }}
                    </x-list-item-prop>


                    <x-list-item-prop :visibility="$payment->reverseTrxTime != null">
                        <x-slot name="label">
                            Reverse Trx Time
                        </x-slot>

                        {{ $payment->reverseTrxTime }}
                    </x-list-item-prop>


                    <x-slot name="footer">
                    </x-slot>

                </x-list-item-card>
            @endforeach
        </div>



    </x-list-card>

</x-guest-layout>
