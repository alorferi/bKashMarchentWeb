<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $subscriptions->links() !!}
    </div>



    <table>

        <tr>
            <th>Actions</th>
            <th>Payer</th>
            <th>Amount</th>
            <th>Start Date</th>
            <th>Expiry Date</th>
            <th>Frequency</th>
            <th>Status</th>
        </tr>

        @forelse($subscriptions as $subscription)
            <tr>

                <td class="px-3">
                        <a href="{{route('admin.subscriptions.show',$subscription->id)}}"> Show</a>
                </td>

                <td class="px-3">
                    {{ $subscription->payer }}
                </td>
                <td class="px-3"> {{ $subscription->amount }}</td>
                <td class="px-3"> {{ $subscription->startDate }}</td>
                <td class="px-3"> {{ $subscription->expiryDate }}</td>
                <td class="px-3"> {{ $subscription->frequency }}</td>
                <td class="px-3"> {{ $subscription->status }}</td>

            </tr>




        @empty
            <tr>
                <td>No Posts</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $subscriptions->links() !!}
    </div>


</x-admin-layout>
