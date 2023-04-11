<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Cycles') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $paymentSectors->links() !!}
    </div>



    <table>

        <tr>
            <th>Name</th>
            <th>Is Active</th>
        </tr>

        @forelse($paymentSectors as $paymentSector)
            <tr>

                <td>
                    {{ $paymentSector->name }}
                </td>




                <td> {{ $paymentSector->is_active ? 'True' : 'False' }}</td>

            </tr>




        @empty
            <tr>
                <td>No Posts</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $paymentSectors->links() !!}
    </div>


</x-admin-layout>
