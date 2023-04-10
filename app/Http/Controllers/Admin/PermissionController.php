<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
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

        $permissions = Permission::orderBy('name')
        ->where(function($query) use ($term){

            if($term){
                $query->where('name','like',"%{$term}%")->orWhere('display_name','like',"%$term%");;
            }


        })

        ->paginate();


        $permissions->appends($request->all());

        return view('admin.permission.index', compact('permissions','term'));
    }

    /**
     * Create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();

        return redirect()->route('permissions.index')->withMessage('Permission Created!');
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
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact(['permission']));
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
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();
        return redirect()->route('permissions.index')->withMessage('Permission Updated!');
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
