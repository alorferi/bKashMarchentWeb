<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>



    <x-list-card>


        <x-slot name="title">

        </x-slot>


    <form action="">

        @csrf

        <!-- Mobile -->
        <div class="mt-4 flex">
            {{-- <x-label for="mobile" :value="__('mobile')" /> --}}

            <x-input id="mobile" class="mt-1 w-full" type="tel" name="mobile" value="{{$mobile}}" required
            placeholder="bKash Wellet Number"
            />

            <x-button class="ml-4">
                {{ __('Submit') }}
            </x-button>

            {{-- <input type="submit" value="show"> --}}
        </div>




    </form>



    @if ($subscription)
        @include('Payment.payment_list', ['payments' => $subscription->payments])
    @endif

</x-list-card>

</x-guest-layout>
