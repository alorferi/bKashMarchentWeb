<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <a href="{{ route('admin.users.index') }}"
            class="bg-blue-500 text-white font-bold py-2 px-4 mx-4 my-4 rounded-full">Back</a>

        <div class="p-6 m-6 bg-white border-b border-gray-200">
            {{ Html::ul($errors->all(), ['class' => 'text-danger']) }}

            {{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT', 'files' => true]) }}

            @csrf

            @include('admin.user.input_fields')

            <div class="flex items-center justify-end mt-4">

                {{ Form::submit('Save', ['class' => 'ml-4']) }}

                {{ Form::close() }}

                {{-- <x-button-dark class="ml-4">
                                {{ __('Save') }}
                            </x-button> --}}
            </div>
        </div>
    </div>

</x-admin-layout>
