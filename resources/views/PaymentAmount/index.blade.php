<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Cycles') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $paymentAmounts->links() !!}
    </div>



    <table>

        <tr>
            <th>Amount</th>
            <th>Currency</th>
            <th>Is Active</th>
        </tr>

        @forelse($paymentAmounts as $paymentAmount)
            <tr>

                <td>
                    {{ $paymentAmount->amount }}
                </td>

                <td> {{ $paymentAmount->currency }}</td>

                <td> {{ $paymentAmount->is_active? "True" : "False" }}</td>

            </tr>




        @empty
            <tr>
                <td>No Posts</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $paymentAmounts->links() !!}
    </div>


</x-admin-layout>
