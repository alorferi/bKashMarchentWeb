<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;

use Redirect;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Tag;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $term = $request->term ?? null;

        $posts = Post::where(function ($query) use ($term) {
            if ($term) {
                $query->where('post_title', 'like', "%$term%");
            }
        })
        ->orderBy('created_at', 'desc')->paginate();

        return view('admin.post.index', compact('posts', 'term'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = User::pluck('name', 'id')->prepend('Please Select...', null);
        $tags = Tag::pluck('name', 'id')->prepend('Please Select...', null);

        return view('admin.post.create', compact('tags', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request =  $request->merge(['post_excerpt'=>'',
    'to_ping'=>'',
    'pinged'=>'',
    'post_content_filtered'=>'',
    ]);

        $post = Post::create($request->except('image'));

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            Image::createX($imageFile, 1024, $post);
        }

        // redirect
        Session::flash('message', "Successfully saved!");
        return Redirect::to(route('admin.posts.index'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $authors = User::pluck('name', 'id')->prepend('Please Select...', null);
        $tags = Tag::pluck('name', 'id')->prepend('Please Select...', null);
        $post_author = $post->post_author;

        return view('admin.post.edit', compact('post', 'authors', 'post_author','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        //  dump($request->post_tag_ids);

        $post->update($request->except('image','post_tag_ids'));


        $post->tags()->sync($request->post_tag_ids);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');

            if ($post->image==null) {
                Image::createX($imageFile, 1024, $post);
            } else {
                $post->image->updateX($imageFile, 1024);
            }
        }

        // redirect
        Session::flash('message', "Successfully saved!");
        return Redirect::to(route('admin.posts.index', $post->id));
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
