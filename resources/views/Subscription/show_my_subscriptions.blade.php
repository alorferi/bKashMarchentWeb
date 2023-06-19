<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>



    <x-list-card>


        <x-slot name="title">

        </x-slot>



        @if (!empty($message))
            <div class=""> {{ $message }}</div>
        @endif



        <form action="">

            @csrf






            <div class="mt-4">


                @if ($show_otc_dialog)
                    <x-input class="mt-1 w-96" type="tel" name="payer" value="{{ $payer }}" readonly />

                    <x-input class="w-full mt-1" type="number" name="ot_code" value="{{ $ot_code }}"
                        placeholder="Type One time code here" />

                    <x-button class="ml-4">
                        {{ __('Submit') }}
                    </x-button>
                @else
                    <div class="flex justify-center">

                        <x-input class="mt-1 w-96" type="tel" name="payer" value="{{ $payer }}" required
                            placeholder="Type bKash Wellet Number here" />

                        <x-button class="ml-4">
                            {{ __('Submit') }}
                        </x-button>
                    </div>
                @endif





                {{-- @if ($show_otc_dialog) --}}

                @if ($otcObject)
                    @if ($otcObject->status == 'OTC_GENERATED')
                        <div class=""> {{ $otcObject->message }}</div>
                    @elseif($otcObject->status == 'OTC_REJECTED')
                        <div class=""> {{ $otcObject->message }}</div>
                    @endif

                @endif






            </div>




        </form>



        @if ($subscriptions)
            @include('Subscription.my_subscription_list', ['subscriptions' => $subscriptions])
        @endif

    </x-list-card>

</x-guest-layout>
