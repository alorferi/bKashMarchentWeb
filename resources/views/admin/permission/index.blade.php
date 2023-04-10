<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <a class="btn btn-success" href="{{ route('admin.permissions.create') }}">Create</a>


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


@include("layouts.partials.paginate_info",['paginator'=>$permissions,'label'=>"Permissions"])


    <table class="table">
        <tr>
            <th> Action</th>
            <th> Name</th>
            <th> Display Name</th>
            <th> Description</th>


        </tr>
        @forelse($permissions as $permission)
            <tr>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.permissions.edit',$permission) }}">Edit</a>
                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-sm btn-danger" type="submit" name="submit" value="Delete">
                    </form>
                </td>

                <td> {{ $permission->name }} </td>
                <td> {{ $permission->display_name }}</td>
                <td> {{ $permission->description }} </td>


            </tr>
        @empty
            <tr>
                <td> No roles.</td>
            </tr>
        @endforelse
    </table>

    @include("layouts.partials.paginate_info",['paginator'=>$permissions,'label'=>"Permissions"])

</x-admin-layout>
