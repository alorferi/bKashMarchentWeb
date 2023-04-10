<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Terms') }}
        </h2>
    </x-slot>





            @permission('term_create')
                <a href="{{ route('admin.terms.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Create</a>
            @endpermission

            <div class="p-2">
                {!! $terms->links() !!}
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">



                @forelse($terms as $term)
                    <div class="p-6 m-6 bg-white border-b border-gray-200">
                        {{ $term->term_name }}:

                        {{ $term->term_value }}
                        @permission('term_edit')
                            <a href="{{ route('admin.terms.edit', $term->id) }}">Edit</a>
                        @endpermission


                    </div>

                @empty
                    <p>No Terms</p>
                @endforelse
            </div>

            <div class="p-2">
                {!! $terms->links() !!}
            </div>

</x-admin-layout>
