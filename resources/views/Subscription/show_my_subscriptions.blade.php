<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Subscriptiopns') }}
        </h2>
    </x-slot>



    <x-list-card>


        <x-slot name="title">

        </x-slot>



        @if (!empty($message))
            <div class=""> {{ $message }}</div>
        @endif

        @csrf


        @if ($show_otc_dialog)
            <x-form-card>

                <x-slot name="title">


                </x-slot>

                <div class="flex">
                    @if ($otcObject)
                        @if ($otcObject->status == 'OTC_GENERATED')
                            <div class="flex-1 text-green-500 "> {{ $otcObject->message }}</div>
                        @elseif($otcObject->status == 'OTC_REJECTED')
                            <div class="flex-1 text-red-500 "> {{ $otcObject->message }}</div>
                        @endif

                    @endif

                    <div class="">
                        <span id="demo" class="downCounterText"></span>
                    </div>
                </div>

                <form action="">
                    <div class="flex flex-col justify-center">

                        <x-input class="mt-3 w-96" type="tel" name="payer" value="{{ $payer }}" readonly />
                        <x-input class="mt-3 w-96 " type="number" name="ot_code" value="{{ $ot_code }}"
                            placeholder="Type One time code here" />

                        <x-button class="justify-center mt-3">
                            {{ __('Submit') }}
                        </x-button>

                    </div>

                </form>

            </x-form-card>
        @elseif(!session('payer'))
            <x-form-card>

                <x-slot name="title">


                </x-slot>

                <div class="flex">
                    @if ($otcObject)
                        @if ($otcObject->status == 'OTC_GENERATED')
                            <div class=""> {{ $otcObject->message }}</div>
                        @elseif($otcObject->status == 'OTC_REJECTED')
                            <div class=""> {{ $otcObject->message }}</div>
                        @endif

                    @endif
                </div>

                <form action="">
                    <div class="flex flex-col justify-center">

                        <x-input class="mt-3 w-96" type="tel" name="payer" value="{{ $payer }}" required
                            placeholder="Type bKash Wellet Number here" />

                        <x-button class="justify-center mt-3">
                            {{ __('Next') }}
                        </x-button>
                    </div>

                </form>
            </x-form-card>
        @endif

        </form>




        @if ($subscriptions)
            @include('Subscription.my_subscription_list', ['subscriptions' => $subscriptions])
        @endif

    </x-list-card>


    <script>
        var distance = {!! $otcObject && $otcObject->data ? $otcObject->data->otc_expired_after_in_seconds : 0 !!};
        // Update the count down every 1 second
        var x = setInterval(function() {

            // Find the distance between now and the count down date

            console.log(distance);

            var minutes = Math.floor(distance / 60);
            var seconds = distance % 60;

            console.log(distance, minutes, seconds);

            // Display the result in the element with id="demo"
            document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }

            distance--;

        }, 1000);
    </script>

</x-guest-layout>
