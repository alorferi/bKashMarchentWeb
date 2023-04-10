<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <a class="btn btn-success" href="{{ route('admin.roles.create') }}">Create </a>



    <form action="" method="get">
        @csrf

        <div class="d-flex align-items-center">



            <div class="p-2">
                <input name="term" type="text" value="{{ $term }}" placeholder="Type text here" />
            </div>

            <div class="pt-2 pb-2">
                <button class="btn btn-primary" type="submit">
                    Search
                </button>
            </div>


        </div>

    </form>

	<div class="table-responsive">

        @include("layouts.partials.paginate_info",['paginator'=>$roles,'label'=>"Roles"])

	<table class="table">
    	<tr>
				<th> Action </th>
    		<th> Name </th>
    		<th> Display Name </th>
    		<th> Description </th>
    		<th> Permisions </th>

    	</tr>
    	@forelse($roles as $role)
    	<tr>
				<td>
						<a class="btn btn-info btn-sm" href="{{ route('admin.roles.edit',$role) }}">Edit</a>
						<form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
							@csrf
							{{ method_field('DELETE') }}
							<input class="btn btn-sm btn-danger" type="submit" name="submit" value="Delete">
						</form>
					</td>

    		<td> {{ $role->name }} </td>
    		<td> {{ $role->display_name }}</td>
    		<td> {{ $role->description }} </td>
			<td>
					@forelse($role->permissions as $permission)
						{{ $permission->name }}, <br/>
					@empty
						 No Permission.
					@endforelse
			</td>

    	</tr>
    	@empty
    	<tr>
    		<td> No roles. </td>
    	</tr>
    	@endforelse
	</table>
    @include("layouts.partials.paginate_info",['paginator'=>$roles,'label'=>"Roles"])
	</div>

</x-admin-layout>
