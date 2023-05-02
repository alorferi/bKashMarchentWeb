<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Payment Amounts') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $paymentAmounts->links() !!}
    </div>



    <table>

        <tr>
            <th>Actions</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Is Active</th>
        </tr>

        @forelse($paymentAmounts as $paymentAmount)
            <tr>

                <td>
                    <a href="{{route('admin.payment-amounts.edit',$paymentAmount->id)}}">Edit</a>
                </td>

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
