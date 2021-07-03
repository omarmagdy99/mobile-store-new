<?php

namespace App\Http\Controllers;

use App\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة
    public function index()
    {
        //ووضعها في متغيرModelسطر خاص باحضار جميع البيانات من ال 
        $suppliers_data = supplier::all();
        
        //All Suppliersسطر خاص بارسال البيانات الي الشاشة 
        return view('pages.suppliers.suppliers', compact('suppliers_data'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            //===============================================================
            'phone' => 'required|numeric|digits:11|starts_with:0',

            'company_name' => ['required'],
        ]);
        supplier::create([
            'name' => $request->name,

            'phone' => $request->phone,

            'company_name' => $request->company_name,
        ]);
        session()->flash('add', 'Supplier Added Successfuly');
        return redirect('/suppliers');
    }





    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],

            'phone' => ['required', 'max:11'],
            's_phone' => ['max:11'],
            'company_name' => ['required'],
        ]);
        $data = supplier::where('id', $request->id)->first();
        $data->update([
            'name' => $request->f_name,

            'phone' => $request->phone,
            's_phone' => $request->s_phone,
            'company_name' => $request->company_name,
        ]);
        session()->flash('update', 'Supplier updated Successfuly');
        return redirect('/suppliers');
    }


    public function destroy(Request $request)
    {
        supplier::find($request->id)->delete();
        session()->flash('delete', 'deleted successfully');
        return redirect('suppliers');
    }
}
