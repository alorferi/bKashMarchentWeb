<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $term = $request->term;

        $roles = Role::
        where(function($query) use ($term){
            if($term){
                $query->where('name','like',"%$term%")->orWhere('display_name','like',"%$term%");
            }
        })
        ->orderBy("name")->paginate();

        $roles->appends($request->all());
        return view('admin.role.index', compact('roles','term'));
    }

    /**
     * Create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $role = Role::create($request->except(['permission', '_token']));

        $role = new Role;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        $role->permissions()->sync($request->permission_ids);

        // if($request->permission!=null){
        //     foreach ($request->permission as $value) {
        //         $role->attachPermission($value);
        //     }
        // }

        return redirect()->route('roles.index')->withMessage('Role Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::orderBy('name')->get();
        $role_permissions = $role->permissions->pluck('id', 'id')->toArray();

        return view('admin.role.edit', compact(['role', 'role_permissions', 'permissions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        $role->permissions()->sync($request->permission_ids);

        // DB::table('permission_role')->where('role_id', $id)->delete();
        // if($request->permission!=null){
        // foreach ($request->permission as $value) {
        //     $role->attachPermission($value);
        //     }
        // }

        return redirect()->route('roles.index')->withMessage('Role Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
