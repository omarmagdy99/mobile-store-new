<?php

namespace App\Http\Controllers;

use App\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_data = brand::all();
        return view('pages.BrandsAndCategories.brands', compact('brand_data'));
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
            'brand_name' => ['required', 'unique:brands'],

        ]);
        brand::create([
            'brand_name' => $request->brand_name,
        ]);
        session()->flash('add', 'added successfully');
        return redirect('/brands');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->brand_id;
        $data = brand::find($id);
        $request->validate([
            'brand_name' => ['required', 'unique:brands'],

        ]);
        $data->update([
            'brand_name' => $request->brand_name,
        ]);
        session()->flash('update', 'updated successfully');
        return redirect('brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        brand::find($request->brand_id)->delete();
        session()->flash('delete', 'deleted successfully');
        return redirect('brands');
    }
}
