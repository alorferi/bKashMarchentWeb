<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('OnBoards') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $onboards->links() !!}
    </div>



    <table>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Frequency</th>
            <th>Start Date</th>
            <th>Expiry Date</th>

            <th>Expiration Time</th>


        </tr>

        @forelse($onboards as $onboard)
            <tr>



                <td class="px-3">
                    {{ $onboard->id }}
                </td>

                <td class="px-3">
                    {{ $onboard->name }}
                </td>
                <td class="px-3">
                    {{ $onboard->email }}
                </td>

                <td class="px-3"> {{ $onboard->amount }}</td>
                <td class="px-3"> {{ $onboard->frequency }}</td>
                <td class="px-3"> {{ $onboard->startDate }}</td>
                <td class="px-3"> {{ $onboard->expiryDate }}</td>

                <td class="px-3"> {{ $onboard->expirationTime }}</td>
            </tr>




        @empty
            <tr>
                <td>No Posts</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $onboards->links() !!}
    </div>


</x-admin-layout>
