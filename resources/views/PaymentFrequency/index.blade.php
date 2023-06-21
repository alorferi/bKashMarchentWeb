<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Payment Cycles') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $paymentFrequencies->links() !!}
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

        @forelse($paymentFrequencies as $paymentFrequency)
            <tr>

                <td>
                    {{ $paymentFrequency->name }}
                </td>



                <td> {{ $paymentFrequency->display_name }}</td>
                <td> {{ $paymentFrequency->merchant_display_name }}</td>
                <td> {{ $paymentFrequency->pre_notification_day }}</td>
                <td> {{ $paymentFrequency->no_of_retrial }}</td>
                <td> {{ $paymentFrequency->retrial_period }}</td>
                <td> {{ $paymentFrequency->display_serial }}</td>
                <td> {{ $paymentFrequency->is_active? "True" : "False" }}</td>

            </tr>




        @empty
            <tr>
                <td>No Posts</td>
            </tr>
        @endforelse
    </table>

    <div class="p-2">
        {!! $paymentFrequencies->links() !!}
    </div>


</x-admin-layout>
