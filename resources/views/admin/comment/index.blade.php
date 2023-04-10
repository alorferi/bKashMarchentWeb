<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>





            @permission('comment_create')
                <a href="{{ route('admin.comments.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Create</a>
            @endpermission

            <div class="p-2">
                {!! $comments->links() !!}
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">



                @forelse($comments as $comment)
                    <div class="p-6 m-6 bg-white border-b border-gray-200">
                        {{ $comment->comment_content }}


                        @permission('comment_edit')
                            <a href="{{ route('admin.comments.edit', $comment->id) }}">Edit</a>
                        @endpermission


                    </div>

                @empty
                    <p>No Comments</p>
                @endforelse
            </div>

            <div class="p-2">
                {!! $comments->links() !!}
            </div>

</x-admin-layout>
