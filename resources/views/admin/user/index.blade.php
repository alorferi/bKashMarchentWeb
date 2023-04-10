<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>



    @permission('user_create')
        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Create</a>
    @endpermission

    <div class="p-2">
        {!! $users->links() !!}
    </div>

    @forelse($users as $user)
        <div class="flex flex-wrap p-6 m-6 bg-white border-b border-gray-200">


            @if ($user->image != null && $user->image->url!=null)
                <img class="w-10 h-10 rounded-full mr-6"
                    src="{{$user->image->url}}"
                    alt="Avatar of Jonathan Reinink" />
            @endif


            {{ $user->name }} | {{ $user->email }}


            @permission('user_edit')
                <a href="{{ route('admin.users.edit', $user->id) }}"
                    class="bg-blue-500 text-white font-bold py-2 px-4"
                    >Edit</a>
            @endpermission

            &nbsp;
            <a href="{{ route('admin.users.show', $user->id) }}"
                class="bg-blue-500 text-white font-bold py-2 px-4">Show</a>


        </div>

    @empty
        <p>No Users</p>
    @endforelse

    <div class="p-2">
        {!! $users->links() !!}
    </div>

</x-admin-layout>
