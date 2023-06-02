<x-guest-layout>



    <x-form-card>


        <x-slot name="title">
            <h2 class="">Become a Regular Donor</h2>
            <p class=""></p>
        </x-slot>

        @if (!empty($message))
            <div class="alert alert-success"> {{ $message }}</div>
        @endif

    </x-form-card>



</x-guest-layout>
