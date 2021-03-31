<?php

namespace App\Http\Controllers;

use App\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_data=customer::all();
        return view('pages.customers.customers',compact('customer_data'));
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
            'name'=>['required','unique:customers'],
            'phone'=>['required'],
        ]);
        
        customer::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
        ]);
            session()->flash('add','added successfully');
            return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'=>['required'],
            'name'=>['required'],
            'phone'=>['required','max:14'],
        ]);
        $customer_data=customer::where('id',$request->id);
            $customer_data->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
            ]);
            session()->flash('update','updated successfully');
        return redirect('/customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        customer::where('id',$request->id)->delete();
        session()->flash('delete','deleted successfully');
        return redirect('/customers');
    }
}
