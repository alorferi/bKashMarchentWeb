<div class="m-6 max-w-sm rounded overflow-hidden shadow-lg">

    @if ($post->image != null)
        <img class="w-full" src="{{ asset($post->image->url) }}" alt="Sunset in the mountains" width="300">
    @endif

    <div class="px-6 py-6">
        <div class="font-bold text-xl mb-2"> {{ $post->post_title }}</div>
        <p class="text-gray-700 text-base mb-4">
            {{ $post->post_content }}
        </p>

        <a href="{{ route('posts.show', $post->id) }}" class=" bg-blue-500 text-white font-bold py-2 px-2">Read
            more</a>
    </div>

    @if ($post->author != null)
        <div class="px-6 pt-4 pb-2 flex items-center">

            @if ($post->author->image)
                <img class="w-10 h-10 rounded-full mr-6" src="{{ $post->author->image->url }}"
                    alt="Avatar of Jonathan Reinink" />
            @endif
            <div class="text-sm">
                <p class="text-gray-900 leading-none">{{ $post->author->name }}</p>
                <p class="text-gray-600">{{ $post->post_date->diffForhumans() }}</p>
            </div>
        </div>
    @endif

    <div class="px-6 pt-4 pb-2">

        @foreach ($post->tags as $tag)
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                #{{ $tag->slug }}</span>
        @endforeach


    </div>


</div>
