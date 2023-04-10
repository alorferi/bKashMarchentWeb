<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>


            @permission('post_create')
                <a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Create</a>
            @endpermission

            @include('layouts.partials.search')

            <div class="p-2">
                {!! $posts->links() !!}
            </div>

            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}

            @forelse($posts as $post)

            @include("admin.post.post_h_card_item")

            @empty
                <p>No Posts</p>
            @endforelse
            {{-- </div> --}}

            <div class="p-2">
                {!! $posts->links() !!}
            </div>



</x-admin-layout>
