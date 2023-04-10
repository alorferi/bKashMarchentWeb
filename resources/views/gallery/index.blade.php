<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Images') }}
        </h2>
    </x-slot>

    <div class="p-2">
        {!! $images->links() !!}
    </div>

    {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}

    @php
        $i = 0;
    @endphp

    @forelse($images as $image)
        @if ($i == 0)
            <div class="flex justify-between flex-wrap">
        @endif

        @include('gallery.image_v_card_item')

        @if ($i == 2)
            </div>
        @endif

        @php
            $i++;

            if ($i == 3) {
                $i = 0;
            }

        @endphp



    @empty
        <p>No Images</p>
    @endforelse
    {{-- </div> --}}

    <div class="p-2">
        {!! $images->links() !!}
    </div>



</x-guest-layout>
