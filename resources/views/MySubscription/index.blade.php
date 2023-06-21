<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>

    <x-list-card>


        <x-slot name="title">

                <div class="py-2 text-xl font-bold text-center text-white bg-blue-600 rounded-sm">My Subscriptions</div>

        </x-slot>


        @if ($subscriptions)
            @include('MySubscription.my_subscription_list', ['subscriptions' => $subscriptions])
        @endif

    </x-list-card>

</x-guest-layout>
