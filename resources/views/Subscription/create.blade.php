<x-guest-layout>

    <x-form-card>

        <x-slot name="title">
            <h2 class="text-lg text-bold">Become a Regular Donor</h2>
            <p class="">
                @if (!empty($message))
                    <div class="alert alert-success"> {{ $message }}</div>
                @endif
            </p>

        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('subscriptions.store') }}">
            @csrf

            <div>
                <fieldset class="">
                    <legend class="">Daily Donation Amount :<span class=""><span
                                class="">(Required)</span></span>
                    </legend>
                    <div class="">
                        <div class="">

                            @foreach ($paymentAmounts as $amount)
                                <div class="">
                                    <input class="payment_amount" name="amount" type="radio"
                                        value="{{ $amount->amount }}">
                                    <label for="" class="">{{ $amount->amount }}
                                        {{ $amount->currency }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </fieldset>
            </div>

            <div class=""><label class="" for="">Select
                    Donation Frequecy:<span class=""><span class="">(Required)</span></span></label>
                <div class="">

                    <select name="payment_frequency" class="" aria-required="true" aria-invalid="false">

                        @foreach ($PaymentFrequencys as $PaymentFrequency)
                            <option value="{{ $PaymentFrequency->name }}">
                                {{ $PaymentFrequency->merchant_display_name ?? $PaymentFrequency->display_name }}
                            </option>
                        @endforeach

                    </select>

                </div>
            </div>


            <fieldset class="s">
                <legend class="">Choose your preferred donation sector :</legend>

                @foreach ($donationSectors as $donationSector)
                    <div class="">
                        <input name="donation_sector_id" type="radio" value="{{ $donationSector->id }}">
                        <label for="" class="">
                            {{ $donationSector->name }}
                        </label>
                    </div>
                @endforeach

            </fieldset>

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                    placeholder="Type your Name here" />
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input class="block w-full mt-1" type="email" name="email" :value="old('email')"
                placeholder="Type your E-Mail here"
                required
                     />
            </div>

            <div class="" aria-atomic="true" aria-live="polite" ><label class=""
                    for="">Amount</label>
                <div class="">

                    <x-input class="block w-full mt-1 selected_amount" type="text" readonly disabled
                         value="৳ 0.00" required />

                </div>
            </div>


            <div class="flex items-center justify-center mt-4">

                <x-button-primary class="justify-center w-full">
                    {{ __('Submit') }}
                </x-button-primary>

            </div>
        </form>


        <script type="text/javascript">
            $(document).ready(function() {

                $('.payment_amount').click(function() {

                    const amont = "৳" + $(this).val() + ".00"
                    $('.selected_amount').val(amont)

                });

            });
        </script>


    </x-form-card>

</x-guest-layout>
