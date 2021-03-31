<?php

namespace App\Http\Controllers;

use App\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers_data = supplier::all();
        return view('pages.suppliers.suppliers',compact('suppliers_data'));
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
            'f_name'=> ['required'],
            'l_name'=> ['required'],
            'phone'=> ['required','max:11'],
            's_phone'=> ['max:11'],
            'company_name'=> ['required'],
        ]);
        supplier::create([
            'f_name' =>$request->f_name,
            'l_name' =>$request->l_name,
            'phone' =>$request->phone,
            's_phone' =>$request->s_phone,
            'company_name' =>$request->company_name,
        ]);
        session()->flash('add','Supplier Added Successfuly');
        return redirect('/suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'f_name'=> ['required'],
            'l_name'=> ['required'],
            'phone'=> ['required','max:11'],
            's_phone'=> ['max:11'],
            'company_name'=> ['required'],
        ]);
        $data=supplier::where('id',$request->id)->first();
        $data->update([
            'f_name' =>$request->f_name,
            'l_name' =>$request->l_name,
            'phone' =>$request->phone,
            's_phone' =>$request->s_phone,
            'company_name' =>$request->company_name,
        ]);
        session()->flash('update','Supplier updated Successfuly');
        return redirect('/suppliers');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        supplier::find($request->id)->delete();
        session()->flash('delete','deleted successfully');
        return redirect('suppliers');
    }
}
