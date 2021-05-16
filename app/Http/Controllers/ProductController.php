<?php

namespace App\Http\Controllers;

use App\product;
use App\category;
use App\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_data = product::all();
        return view('pages.products.products', compact('product_data'));
    }
    public function brand_cat()
    {
        $brand_data = brand::all();
        $category_data = category::all();
        return view('pages.products.AddProducts', ['brand_data' => $brand_data, 'category_data' => $category_data]);
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
            'barcode' => ['required', 'unique:products'],
            'product_name' => ['required'],
            'brand_id' => ['required'],
            'category_id' => ['required'],
            'pic' => ['required'],
            'purchase_price' => ['required'],
            'sales_price' => ['required'],
            'quantity' => ['required'],

        ]);
        product::create([
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'image' => $request->file('pic')->store('productName', 'public'),
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sales_price,
            'quantity' => $request->quantity,
        ]);
        session()->flash('add', 'added successfully');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($barcode)
    {
        $product = product::where('barcode', $barcode)->first();
        $brand_data = brand::all();
        $category_data = category::all();
        return view('pages.products.UpdateProducts', ['brand_data' => $brand_data, 'category_data' => $category_data, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $id = $request->id;
        $p_data = product::where('id', $id)->first();
        if($p_data->image!=$request->pic){
            
            $file=$request->file('pic')->store('productName', 'public');
            Storage::disk('public')->delete($p_data->image);
        }else{
            $file = $request->pic;
        }

        $p_data->update([
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'sales_price' => $request->sales_price,
            'purchase_price' => $request->purchase_price,
            'quantity' => $request->quantity,
            'image' => $file,
        ]);
        session()->flash('edit','edited sucessfuly');
        return redirect('/products');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        product::find($request->product_id)->delete();
        session()->flash('delete', 'deleted successfully');
        Storage::disk('public')->delete($request->pic);
        return redirect('/products');
    }
}
