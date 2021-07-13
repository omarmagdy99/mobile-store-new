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
    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة


    //دالة الAdd
    public function store(Request $request)
    {
        //Validationالجزء الخاص بالتأمين علي الشاشة 
        $request->validate([
            'name' => ['required', 'unique:suppliers'], //يجب ادخالة وان يكون مميز وغير مكرر

            'phone' => 'required|numeric|digits:11|starts_with:0', // ان يكون عدد خاناتة 11 فقط ويجب ان يكونوا ارقام وان يبدا برقم 0

            'company_name' => ['required'],
        ]);
        //    Add الجزء الخاص بال
        supplier::create([
            'name' => $request->name,

            'phone' => $request->phone,

            'company_name' => $request->company_name,
        ]);
        //الجزء الخاص باظهار رسالة نجاح الاضافة
        session()->flash('add', 'Supplier Added Successfuly');
        // AllSuppliersالرجوع الي شاشة 
        return redirect('/suppliers');
    }
    //دالة الAdd



    // دالة Update
    public function update(Request $request)
    {
        //Validationالجزء الخاص بالتأمين علي الشاشة
        $request->validate([
            'name' => ['required'],

            'phone' => 'required|numeric|digits:11|starts_with:0', // ان يكون عدد خاناتة 11 فقط ويجب ان يكونوا ارقام وان يبدا برقم 0

            'company_name' => ['required'],
        ]);

        //ID = IDاحضار المورد اذا كان ال 
        $data = supplier::where('id', $request->id)->first();
        //Updateالجزء الخاص بال
        $data->update([
            'name' => $request->f_name,
            'phone' => $request->phone,
            'company_name' => $request->company_name,
        ]);
        //الجزء الخاص باظهار رسالة نجاح التعديل
        session()->flash('update', 'Supplier updated Successfuly');
        // All Suppliersالرجوع الي شاشة 
        return redirect('/suppliers');
    }
    // دالة Update


    //دالة الحذف Delete
    public function destroy(Request $request)
    {
        // وحذفهID = IDاحضار المورد اذا كان ال 
        supplier::find($request->id)->delete();
        session()->flash('delete', 'deleted successfully');
        return redirect('suppliers');
    }
    //دالة الحذف Delete

}
