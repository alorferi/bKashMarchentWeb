<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscriptiopn Payments') }}
        </h2>
    </x-slot>


    @foreach ($payments as $payment)
        <div>
            Id : {{ $payment->id }}
        </div>

        <div>
            subscriptionId : {{ $payment->subscriptionId }}
        </div>

        <div>
            subscriptionRequestId : {{ $payment->subscriptionRequestId }}
        </div>

        <div>
            dueDate : {{ $payment->dueDate }}
        </div>

        <div>
            status : {{ $payment->status }}
        </div>

        <div>
            trxId : {{ $payment->trxId }}
        </div>

        <div>
            trxTime : {{ $payment->trxTime }}
        </div>

        <div>
            subscriptionId : {{ $payment->subscriptionId }}
        </div>

        <div>
            amount : {{ $payment->amount }}
        </div>
        <div>
            reverseTrxAmount : {{ $payment->reverseTrxAmount }}
        </div>
        <div>
            reverseTrxId : {{ $payment->reverseTrxId }}
        </div>
        <div>
            reverseTrxTime : {{ $payment->reverseTrxTime }}
        </div>

        <br>
    @endforeach


</x-admin-layout>
