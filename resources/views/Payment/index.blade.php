<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payments') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $payments->links() !!}
    </div>



    <table>

        <tr>
            <th>Payer</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>trx Id</th>
            <th>Trx Time</th>
            <th>Amount</th>
            {{-- <th> reverseTrxAmount</th>
            <th> reverseTrxId </th>
            <th> reverseTrxTime </th> --}}
        </tr>

        @forelse($payments as $payment)
            <tr>

                <td class="px-3">
                    {{ $payment->subscription->payer }}
                </td>

                <td class="px-3"> {{ $payment->dueDate }}</td>
                <td class="px-3"> {{ $payment->status }}</td>
                <td class="px-3"> {{ $payment->trxId }}</td>
                <td class="px-3"> {{ $payment->trxTime }}</td>
                <td class="px-3"> {{ $payment->amount }}</td>
                {{-- <td> {{ $payment->reverseTrxAmount }}</td>
                <td> {{ $payment->reverseTrxId }}</td>
                <td> {{ $payment->reverseTrxTime }}</td> --}}

            </tr>




        @empty
            <tr>
                <td>No Posts</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $payments->links() !!}
    </div>


</x-admin-layout>
