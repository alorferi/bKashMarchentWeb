<x-form-card>


    <x-slot name="title">
        <h2 class="">Become a Regular Donor</h2>
        <p class=""></p>
    </x-slot>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <fieldset class="">
                <legend class="">Daily Donation Amount :<span class=""><span
                            class="">(Required)</span></span>
                </legend>
                <div class="">
                    <div class="" >

                        @foreach ($paymentAmounts as $amount)
                            <div class="">
                                <input class="" name="amount" type="radio" value="{{ $amount->amount }}">
                                <label for=""  class="">{{ $amount->amount }}
                                    {{ $amount->currency }}</label>
                            </div>
                        @endforeach


                    </div>
                </div>
            </fieldset>
        </div>

        <div  class=""><label class="" for="">Select
                Donation Type:<span class=""><span class="">(Required)</span></span></label>
            <div class="">

                <select name="" class="" aria-required="true" aria-invalid="false">

                    @foreach ($paymentCycles as $paymentCycle)
                        <option>
                            {{ $paymentCycle->merchant_display_name ?? $paymentCycle->display_name }}
                        </option>
                    @endforeach

                </select>

            </div>
        </div>


        <fieldset  class="s">
            <legend class="">Choose your
                preferred donation sector :</legend>

            @foreach ($paymentSectors as $paymentSector)
                <div class="">
                    <input name="payment_sectors[]" type="checkbox" value="{{$paymentSector->id}}">
                    <label for="" class="">
                        {{ $paymentSector->name }}
                    </label>
                </div>
            @endforeach

        </fieldset>

        <!-- Name -->
        <div>
            <x-label for="name" :value="__('Name')" />

            <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required/>
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                required />
        </div>

        <div  class="" aria-atomic="true" aria-live="polite" data-js-reload="field_1_9"><label
                class="" for="">Total</label>
            <div class="">
                <input type="text" readonly="" name="input_9"  value="৳ 0.00" class="">
            </div>
        </div>


        <div class="flex items-center justify-end mt-4">

            <x-button class="ml-4">
                {{ __('Submit') }}
            </x-button>
        </div>
    </form>
</x-form-card>
