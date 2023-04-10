<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>


                <a href="{{ route('admin.tags.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Create</a>

            <div class="p-2">
                {!! $tags->links() !!}
            </div>

            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}

            @forelse($tags as $tag)

            <p class="text-gray-700 text-base"> {{ $tag->slug }} | {{ $tag->name }}</p>
            @empty
                <p>No Tags</p>
            @endforelse
            {{-- </div> --}}

            <div class="p-2">
                {!! $tags->links() !!}
            </div>



</x-admin-layout>
