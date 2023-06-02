<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscription Requests') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $subscriptionRequests->links() !!}
    </div>



    <table>

        <tr>
            <th>Actions</th>
            <th>Name</th>
            <th>Email</th>
            <th>Time</th>
            <th>Subscribed</th>

        </tr>

        @forelse($subscriptionRequests as $subscriptionRequest)
            <tr>

                <td class="px-3">
                    <a href="{{ route('admin.subscription-requests.show', $subscriptionRequest->id) }}">Show</a>

                </td>

                <td class="px-3">
                    {{ $subscriptionRequest->name }}
                </td>

                <td class="px-3">   {{ $subscriptionRequest->email }} </td>

                <td class="px-3">  {{ $subscriptionRequest->created_at->diffForHumans() }} </td>
                <td>

                    @if($subscriptionRequest->subscription)
                    Yes
                    @else
                    No
                    @endif

                </td>
            </tr>



        @empty
            <tr>
                <td>No Requests</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $subscriptionRequests->links() !!}
    </div>


</x-admin-layout>
