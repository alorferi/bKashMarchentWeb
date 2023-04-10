<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Images') }}
        </h2>
    </x-slot>


                <a href="{{ route('admin.images.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Create</a>

            <div class="p-2">
                {!! $images->links() !!}
            </div>

            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}

            @forelse($images as $image)

            @include("admin.image.image_h_card_item")

            @empty
                <p>No Images</p>
            @endforelse
            {{-- </div> --}}

            <div class="p-2">
                {!! $images->links() !!}
            </div>



</x-admin-layout>
