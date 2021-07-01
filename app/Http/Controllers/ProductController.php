<?php

namespace App\Http\Controllers;

use App\product;
use App\category;

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
    public function cat()
    {

        $category_data = category::all();
        return view('pages.products.AddProducts', [ 'category_data' => $category_data]);
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
            'brand_name' => ['required'],
            'category_id' => ['required'],
            'pic' => ['required'],
            'sales_price' => ['required'],
            'quantity' => ['required'],

        ]);
        product::create([
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'brand_name' => $request->brand_name,
            'category_id' => $request->category_id,
            'image' => $request->file('pic')->store('productName', 'public'),
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

        $category_data = category::all();
        return view('pages.products.UpdateProducts', [ 'category_data' => $category_data, 'product' => $product]);
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
        $request->validate([
            'barcode' => ['required'],
            'product_name' => ['required'],
            'brand_name' => ['required'],
            'category_id' => ['required'],
            'pic' => ['required'],
            'sales_price' => ['required'],
            'quantity' => ['required'],

        ]);
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
            'brand_name' => $request->brand_name,
            'sales_price' => $request->sales_price,
            'quantity' => $request->quantity,
            'image' => $file,
        ]);
        session()->flash('edit', 'edited successfully');
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

    public function showReport($id){
        if($id=='allProduct'){
            $reportProduct=product::get();
            if(isset($reportProduct)){

                return view('pages.reportes.allProductReportes',compact('reportProduct'));
            }

        }else {

            $reportProduct=product::where('id','=',$id)->first();
            if(isset($reportProduct)){

                return view('pages.reportes.productReportes',compact('reportProduct'));
            }else{
                return view('pages.reportes.search');

            }
        }
    }



    public function productSearch(Request $request){

        if(isset($request->barcode)){
            $product_data=product::where('barcode','like',"%$request->barcode%")->get();
            return view('pages.reportes.search',compact('product_data'));
        }
        else if (isset($request->product_name)){
            $product_data=product::where('product_name','like',"%$request->product_name%")->get();
            return view('pages.reportes.search',compact('product_data'));
        }
        else if(isset($request->brand_name))
        {
            $product_data=product::where('brand_name','like',"%$request->brand_name%")->get();
            return view('pages.reportes.search',compact('product_data'));
        }
        return view('pages.reportes.search');
    }
}
