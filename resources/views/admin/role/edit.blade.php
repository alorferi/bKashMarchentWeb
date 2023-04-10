<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>


	{{ Html::ul($errors->all(),['class' => 'text-danger']) }}

{{ Form::model($role, array('route' => array('admin.roles.update', $role->id), 'method' => 'PUT')) }}



	@csrf
    <div class="form-group">
    	<label for="name"></label>
    	<input type="text" class="form-control" name="name" id="" placeholder="Name of role" value="{{$role->name}}">
    </div>

    <div class="form-group">
    	<label for="display_name"></label>
    	<input type="text" class="form-control" name="display_name" id="" placeholder="Display name" value="{{$role->display_name}}">
    </div>

    <div class="form-group">
    	<label for="description"></label>
    	<input type="text" class="form-control" name="description" id="" placeholder="Description" value="{{ $role->description}}">
    </div>

    <div class="form-group text-left">
    	<h3> Permissions </h3>
    	@foreach($permissions as $permission)
    	<input type="checkbox" name="permission_ids[]" {{in_array($permission->id, $role_permissions)? "checked":""}} value="{{ $permission->id }}"> {{ $permission->name }} <br />
    	@endforeach
    </div>
	{{--  <button type="submit" class="btn btn-primary">Submit</button>  --}}
	{{--  </form>  --}}

	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

</x-admin-layout>
