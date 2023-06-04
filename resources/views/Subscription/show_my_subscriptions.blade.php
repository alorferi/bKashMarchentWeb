<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>



    <x-list-card>


        <x-slot name="title">

        </x-slot>



        <p class="">
            @if (!empty($message))
                <div class=""> {{ $message }}</div>
            @endif
        </p>



        <form action="">

            @csrf

            <!-- Payer -->
            <div class="flex mt-4">

                <x-input class="w-full mt-1" type="tel" name="payer" value="{{ $payer }}" required
                    placeholder="bKash Wellet Number" />


                <x-input class="w-full mt-1" type="number" name="ot_code" value="{{ $ot_code }}"
                    placeholder="Type One time code here" />

                <x-button class="ml-4">
                    {{ __('Submit') }}
                </x-button>

            </div>




        </form>



        @if ($subscriptions)
            @include('Subscription.my_subscription_list', ['subscriptions' => $subscriptions])
        @endif

    </x-list-card>

</x-guest-layout>
