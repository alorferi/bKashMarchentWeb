<x-form-card>


    <x-slot name="title">
        <h2 class="gform_title">Become a Regular Donor</h2>
        <p class="gform_description"></p>
    </x-slot>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf


        <div>
            <fieldset id="field_1_6"
                class="gfield gfield--type-product gfield--type-choice gfield--input-type-radio gfield--width-full gfield_price gfield_price_1_6 gfield_product_1_6 gfield_contains_required field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
                data-js-reload="field_1_6">
                <legend class="gfield_label gform-field-label">Daily Donation Amount :<span class="gfield_required"><span
                            class="gfield_required gfield_required_text">(Required)</span></span>
                </legend>
                <div class=" ginput_container_radio">
                    <div class="gfield_radio" id="input_1_6">

                        @foreach ($paymentAmounts as $amount)
                            <div class=" _1_6_0">
                                <input class="" name="input_6" type="radio" value="{{ $amount->amount }}">
                                <label for="choice_1_6_0" id="label_1_6_0"
                                    class="gform-field-label gform-field-label--type-inline">{{ $amount->amount }}
                                    {{ $amount->currency }}</label>
                            </div>
                        @endforeach


                    </div>
                </div>
            </fieldset>
        </div>

        <div id="field_1_13"
            class="gfield gfield--type-select gfield--width-full gfield_contains_required field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
            data-js-reload="field_1_13"><label class="gfield_label gform-field-label" for="input_1_13">Select
                Donation Type:<span class="gfield_required"><span
                        class="gfield_required gfield_required_text">(Required)</span></span></label>
            <div class=" ginput_container_select">

                <select name="input_13" id="input_1_13" class="large gfield_select" aria-required="true"
                    aria-invalid="false">

                    @foreach ($paymentCycles as $paymentCycle)
                        <option>
                            {{ $paymentCycle->merchant_display_name ?? $paymentCycle->display_name }}
                        </option>
                    @endforeach

                </select>

            </div>
        </div>


        <fieldset id="field_1_18"
            class="gfield gfield--type-post_custom_field gfield--type-choice gfield--input-type-checkbox gfield--width-full field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
            data-js-reload="field_1_18">
            <legend class="gfield_label gform-field-label gfield_label_before_complex">Choose your
                preferred donation sector :</legend>

            @foreach ($paymentSectors as $paymentSector)
                <div class="">
                    <input class="" type="checkbox" value="General Donation">
                    <label for="choice_1_18_1" class="">
                        {{ $paymentSector->name }}
                    </label>
                </div>
            @endforeach

        </fieldset>

        <!-- Name -->
        <div>
            <x-label for="name" :value="__('Name')" />

            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
        </div>

        <div id="field_1_9"
            class="gfield gfield--type-total gfield--width-full gfield_price gfield_price_1_ gfield_total gfield_total_1_ field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
            aria-atomic="true" aria-live="polite" data-js-reload="field_1_9"><label
                class="gfield_label gform-field-label" for="input_1_9">Total</label>
            <div class=" ginput_container_total">
                <input type="text" readonly="" name="input_9" id="input_1_9" value="৳ 0.00"
                    class="gform-text-input-reset ginput_total ginput_total_1">
            </div>
        </div>


        <div class="flex items-center justify-end mt-4">

            <x-button class="ml-4">
                {{ __('Submit') }}
            </x-button>
        </div>
    </form>
</x-form-card>
