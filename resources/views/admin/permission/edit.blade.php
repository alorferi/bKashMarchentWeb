<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>


	{{ Html::ul($errors->all(),['class' => 'text-danger']) }}

{{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}
@csrf
    <div class="form-group">
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
			{{ Form::label('display_name', 'Display Name') }}
			{{ Form::text('display_name', Request::old('display_name'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::text('description', Request::old('description'), array('class' => 'form-control')) }}
    </div>


	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}


</x-admin-layout>
