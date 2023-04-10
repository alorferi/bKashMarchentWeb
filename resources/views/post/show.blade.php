<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <div class="p-6 bg-white border-gray-200 text-xl font-bold">
           {{ $post->post_title }}
        </div>
        @if ($post->image != null)
            <img class="w-full" src="{{ asset($post->image->url) }}" alt="Sunset in the mountains" width="300">
        @endif
        <div class="p-6 m-6 bg-white border-b border-gray-200">
            {{ $post->post_content }}
        </div>
    </div>

</x-guest-layout>
