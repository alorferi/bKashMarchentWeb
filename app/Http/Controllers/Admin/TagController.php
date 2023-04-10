<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Session;
use Redirect;

class TagController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->paginate();
        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if($request->has('slug') && $request->slug!=""){
          $slug =  str_replace(' ', '_', $request->slug);
        }else{
            $slug =  str_replace(' ', '_', $request->name);
        }

        $request =  $request->merge([
            'slug'=>$slug,
        ]);

        $tag = Tag::create($request->all());


        // redirect
        Session::flash('message', "Successfully saved!");
        return Redirect::to(route('admin.tags.index'));
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
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->except('tag'));

        if ($request->hasFile('tag')) {
            $tagFile = $request->file('tag');
            $tag->updateX($tagFile, 1024);
        }

        // redirect
        Session::flash('message', "Successfully saved!");
        return Redirect::to(route('admin.tags.index', $tag->id));
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
