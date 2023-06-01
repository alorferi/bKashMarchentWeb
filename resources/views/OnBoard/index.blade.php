<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('onBoards') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $onBoards->links() !!}
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

        @forelse($onBoards as $onBoard)
            <tr>



                <td class="px-3">
                    {{ $onBoard->id }}
                </td>

                <td class="px-3">
                    {{ $onBoard->name }}
                </td>
                <td class="px-3">
                    {{ $onBoard->email }}
                </td>

                <td class="px-3"> {{ $onBoard->amount }}</td>
                <td class="px-3"> {{ $onBoard->frequency }}</td>
                <td class="px-3"> {{ $onBoard->startDate }}</td>
                <td class="px-3"> {{ $onBoard->expiryDate }}</td>

                <td class="px-3"> {{ $onBoard->expirationTime }}</td>
            </tr>




        @empty
            <tr>
                <td>No Posts</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $onBoards->links() !!}
    </div>


</x-admin-layout>
