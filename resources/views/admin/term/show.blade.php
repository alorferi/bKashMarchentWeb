<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Terms') }}
        </h2>
    </x-slot>


            @permission('term_edit')
                <a href="{{ route('terms.edit', $term->id) }}"
                    class="bg-blue-500 text-white font-bold py-2 px-4 mx-4 my-4 rounded-full">Edit</a>
            @endpermission
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 m-6 bg-white border-b border-gray-200">
                    {{ $term->term_title }}
                    <a href="{{ route('terms.edit', $term->id) }}">Edit</a>
                </div>

                <div class="p-6 m-6 bg-white border-b border-gray-200">
                    {{ $term->term_content }}
                </div>

            </div>

</x-admin-layout>
