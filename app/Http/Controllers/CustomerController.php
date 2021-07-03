<?php

namespace App\Http\Controllers;

use App\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة

    public function index()
    {
        //ووضعها في متغيرModelسطر خاص باحضار جميع البيانات من ال 
        $customer_data = customer::all();

        //All customerسطر خاص بارسال البيانات الي الشاشة 
        return view('pages.customers.customers', compact('customer_data'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:customers'],
            'phone' => ['required'],
        ]);

        customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
        session()->flash('add', 'added successfully');
        return redirect('/customers');
    }






    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'phone' => ['required', 'max:14'],
        ]);
        $customer_data = customer::where('id', $request->id);
        $customer_data->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
        session()->flash('update', 'updated successfully');
        return redirect('/customers');
    }

    public function destroy(Request $request)
    {
        customer::where('id', $request->id)->delete();
        session()->flash('delete', 'deleted successfully');
        return redirect('/customers');
    }
}
