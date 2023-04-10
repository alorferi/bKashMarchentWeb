<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>


    @permission('user_edit')
        <a href="{{ route('admin.users.edit', $user->id) }}"
            class="bg-blue-500 text-white font-bold py-2 px-4 mx-4 my-4 rounded-full">Edit</a>
    @endpermission
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


        <div class="p-6 m-6 bg-white border-b border-gray-200">

            @if ($user->image != null && $user->image->url != null)
            <img class="w-10 h-10 rounded-full mr-6" src="{{ $user->image->url }}" alt="Avatar of Jonathan Reinink" />
        @endif

            {{ $user->name }}
            <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
        </div>

        <div class="p-6 m-6 bg-white border-b border-gray-200">
            {{ $user->email }}
        </div>

    </div>


    @foreach ($user->roles as $role)
        Roles:
        <div class="p-6 m-6 bg-white border-b border-gray-200">
            {{ $role->name }}
        </div>
        {{-- <input type="checkbox" {{in_array($role->id, $user_roles)? "checked":""}} name="role_ids[]" value="{{ $role->id }}"> {{ $role->name }} <br /> --}}
    @endforeach

</x-admin-layout>
