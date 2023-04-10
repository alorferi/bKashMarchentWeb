<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

{{ Html::ul($errors->all(),['class' => 'text-danger']) }}

{{Form::open(['route' => 'roles.store'])}}
	@csrf
    <div class="form-group">
    	<label for="name"></label>
    	<input type="text" class="form-control" name="name" id="" placeholder="Name of role">
    </div>

    <div class="form-group">
    	<label for="display_name"></label>
    	<input type="text" class="form-control" name="display_name" id="" placeholder="Display name">
    </div>

    <div class="form-group">
    	<label for="description"></label>
    	<input type="text" class="form-control" name="description" id="" placeholder="Description">
    </div>

    <div class="form-group text-left">
    	<h3> Permissions </h3>
    	@foreach($permissions as $permission)
    	<input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}"> {{ $permission->name }} <br />
    	@endforeach
    </div>
	{{--  <button type="submit" class="btn btn-primary">Submit</button>  --}}
	{{--  </form>  --}}

	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

</x-admin-layout>
