<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payments') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $payments->links() !!}
    </div>


    @includeIf('Payment.payment_list')

    <div class="p-2">
        {!! $payments->links() !!}
    </div>


</x-admin-layout>
