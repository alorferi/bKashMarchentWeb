<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos') }}
        </h2>
    </x-slot>


                <a href="{{ route('admin.videos.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Create</a>

            <div class="p-2">
                {!! $videos->links() !!}
            </div>

            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}

            @forelse($videos as $video)

            @include("admin.video.video_h_card_item")

            @empty
                <p>No Videos</p>
            @endforelse
            {{-- </div> --}}

            <div class="p-2">
                {!! $videos->links() !!}
            </div>



</x-admin-layout>
