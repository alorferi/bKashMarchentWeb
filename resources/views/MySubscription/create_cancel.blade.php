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

                    <div class="py-2 text-center text-white bg-green-600 rounded">
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

                    {{ $subscription->status }}

                </x-list-item-prop>

                <x-slot name="footer">







                </x-slot>






            </x-list-item-card>





        </x-slot>


        <x-card>

            <x-slot name="title">
                Are you confirm!
            </x-slot>


            <div class="text-center">
                Do you want to cancel this subscription?
            </div>
            <div class="text-center">


                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />




                <form action="{{ route('my-subscriptions.confirm-cancel', $subscription->id) }}" method="POST">


                    @csrf

                    <div>
                        <x-input class="mt-3 w-96" type="text" name="reason" required
                            placeholder="Type reason of the cancel here" />
                    </div>

                    <div class="mt-3">
                        <x-button-success>
                            Yes</x-button-success>
                        <x-a-danger href="{{ route('my-subscriptions.show', $subscription->id) }}">
                            No</x-a-danger>
                    </div>



                </form>



            </div>


        </x-card>

    </x-list-card>




</x-guest-layout>
