<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Cycles') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $paymentCycles->links() !!}
    </div>



    <table>

        <tr>
            <th>name</th>
            <th>display_name</th>
            <th>merchant_display_name</th>
            <th>pre_notification_day</th>
            <th>no_of_retrial</th>
            <th>retrial_period</th>
            <th>display_serial</th>
            <th>is_active</th>
        </tr>

        @forelse($paymentCycles as $paymentCycle)
            <tr>

                <td>
                    {{ $paymentCycle->name }}
                </td>



                <td> {{ $paymentCycle->display_name }}</td>
                <td> {{ $paymentCycle->merchant_display_name }}</td>
                <td> {{ $paymentCycle->pre_notification_day }}</td>
                <td> {{ $paymentCycle->no_of_retrial }}</td>
                <td> {{ $paymentCycle->retrial_period }}</td>
                <td> {{ $paymentCycle->display_serial }}</td>
                <td> {{ $paymentCycle->is_active? "True" : "False" }}</td>

            </tr>




        @empty
            <tr>
                <td>No Posts</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $paymentCycles->links() !!}
    </div>


</x-admin-layout>
