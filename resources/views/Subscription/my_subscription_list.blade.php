{{-- <tr>

    <td class="px-3">
        {{ $subscription->payer }}
    </td>
    <td class="px-3"> {{ $subscription->amount }}</td>
    <td class="px-3"> {{ $subscription->startDate }}</td>
    <td class="px-3"> {{ $subscription->expiryDate }}</td>
    <td class="px-3"> {{ $subscription->frequency }}</td>
    <td class="px-3"> {{ $subscription->status }}</td>

</tr> --}}


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

    @forelse($subscriptions as $subscription)
        <tr>

            <td class="px-3">
                {{ $subscription->payer }}
            </td>

            <td class="px-3"> {{ $subscription->dueDate }}</td>
            <td class="px-3"> {{ $subscription->status }}</td>
            <td class="px-3"> {{ $subscription->trxId }}</td>
            <td class="px-3"> {{ $subscription->trxTime }}</td>
            <td class="px-3"> {{ $subscription->amount }}</td>
            {{-- <td> {{ $subscription->reverseTrxAmount }}</td>
            <td> {{ $subscription->reverseTrxId }}</td>
            <td> {{ $subscription->reverseTrxTime }}</td> --}}

        </tr>




    @empty
        <tr>
            <td>No Posts</td>
        </tr>
    @endforelse
</table>
