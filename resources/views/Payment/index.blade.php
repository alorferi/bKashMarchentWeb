<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Payments') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $payments->links() !!}
    </div>


    @include('Payment.payment_list')

    <div class="p-2">
        {!! $payments->links() !!}
    </div>


</x-admin-layout>
