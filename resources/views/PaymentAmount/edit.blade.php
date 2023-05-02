<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Payment Amount - Edit') }}
        </h2>
    </x-slot>



    <x-form-card>


        <x-slot name="title">
            <h2 class="gform_title">Payment Amount - Edit</h2>
        </x-slot>


            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('admin.payment-amounts.update',$paymentAmount->id) }}">
                @csrf

                <!-- Amount -->
                <div>
                    <x-label for="amount" :value="__('Amount')" />

                    <x-input id="amount" class="block w-full mt-1" type="text" name="amount" :value="old('amount')" required autofocus />
                </div>

                <!-- Currency  -->
                <div class="mt-4">
                    <x-label for="currency" :value="__('Currency')" />

                    <x-input id="currency" class="block w-full mt-1" type="text" name="currency" :value="old('currency')" required />
                </div>


                <div class="mt-4">

                    <input id="is_active" class="mt-1" type="checkbox" name="is_active" value="old('is_active')" required />

                    <x-label for="is_active" :value="__('is_active')" />
                </div>


                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>

    </x-form-card>

</x-admin-layout>
