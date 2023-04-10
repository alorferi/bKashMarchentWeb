<?php

namespace App\Http\Controllers\Admin;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::paginate();
        return view('admin.term.index', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.term.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request =  $request->merge([

    ]);

        $term = Term::create($request->all());
        // redirect
        Session::flash('message', "Successfully saved!");
        return Redirect::to(route('terms.show', $term->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        return view('admin.term.show', compact('term'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        return view('admin.term.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        $term->update($request->all());
        // redirect
        Session::flash('message', "Successfully saved!");
        return Redirect::to(route('terms.index'));
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
