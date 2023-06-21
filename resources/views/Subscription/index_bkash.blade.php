<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>


    @include('Subscription.index_form')


    @if ($subscriptions)
        @include('Subscription.paging')



        @forelse($subscriptions->content as $subscription)
            @php
                $textColor = $subscription->status == 'CANCELLED' ? 'text-red-600' : 'text-gray-600';
                $bgColor = $subscription->status == 'CANCELLED' ? 'bg-red-600' : 'bg-green-600';
            @endphp

            <x-list-item-card>

                <x-slot name="title">
                    <div class="{{ $bgColor }} px-2 py-1 text-white">
                        {{ $subscription->payer }}
                    </div>
                </x-slot>

                <x-list-item-prop>
                    <x-slot name="label">
                        Amount
                    </x-slot>

                    {{ $subscription->amount }}
                </x-list-item-prop>



                <x-list-item-prop>
                    <x-slot name="label">
                        Start Date
                    </x-slot>

                    @php
                        $startDate = date_create($subscription->startDate);

                    @endphp

                    {{ $startDate->format('d-m-Y') }}</td>

                </x-list-item-prop>


                <x-list-item-prop>
                    <x-slot name="label">
                        End Date
                    </x-slot>

                    @php
                        $expiryDate = new \Carbon\Carbon($subscription->expiryDate);
                    @endphp

                    {{ $expiryDate->format('d-m-Y') }}

                    ({{ $expiryDate->diffForHumans() }})
                </x-list-item-prop>

                <x-list-item-prop>
                    <x-slot name="label">
                        Frequency
                    </x-slot>

                    {{ $subscription->frequency }}

                </x-list-item-prop>

                <x-list-item-prop>
                    <x-slot name="label">
                        Status
                    </x-slot>

                    {{ $subscription->status }}

                </x-list-item-prop>

                <x-slot name="footer">

                    {{-- <a href="{{ route('admin.subscriptions.show', $subscription->id) }}"> Show</a> --}}

                    @if (\App\Models\Subscription::find($subscription->id))
                        <span class="text-green-600 "> ✔️ </span>
                    @else
                        <span class="text-danger"> ❌ </span>
                    @endif

                    |
                    <x-a-primary href="{{ route('admin.subscriptions.show', $subscription->id) }}"> Fetch</x-a-primary>

                    {{-- |
                    <a href="{{ route('admin.subscription-payments.index', $subscription->id) }}"> Payments</a> --}}
                </x-slot>

            </x-list-item-card>


        @empty
        @endforelse

        @include('Subscription.paging')

    @endif
</x-admin-layout>
