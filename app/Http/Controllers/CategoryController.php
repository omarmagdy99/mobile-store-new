<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_data = category::all();
        return view('pages.Categories.categories', compact('category_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => ['required', 'unique:categories'],

        ]);
        category::create([
            'category_name' => $request->category_name,
        ]);
        session()->flash('add', 'added successfully');
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)

    {
        $id = $request->category_id;
        $data = category::find($id);
        $request->validate([
            'category_name' => ['required', 'unique:categories'],

        ]);
        $data->update([
            'category_name' => $request->category_name,
        ]);
        session()->flash('update', 'updated successfully');
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        category::find($request->category_id)->delete();
        session()->flash('delete', 'deleted successfully');
        return redirect('categories');
    }
}
