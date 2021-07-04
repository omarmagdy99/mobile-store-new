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

    //دالة الAdd
    public function store(Request $request)
    {
        //Validationالجزء الخاص بالتأمين علي الشاشة 
        $request->validate([
            'name' => ['required', 'unique:customers'], //يجب ادخالة وان يكون مميز وغير مكرر
            'phone' => 'required|digits:11|numeric|starts_with:0', // ان يكون عدد خاناتة 11 فقط ويجب ان يكونوا ارقام وان يبدا برقم 0
        ]);

        //Addالجزء الخاص بال
        customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
        //الجزء الخاص باظهار رسالة نجاح الاضافة
        session()->flash('add', 'added successfully');

        // All Customerالرجوع الي شاشة 
        return redirect('/customers');
    }
    //دالة الAdd

    // =================

    // دالة Update
    public function update(Request $request)
    {
        //Validationالجزء الخاص بالتأمين علي الشاشة
        $request->validate([

            'name' => ['required'],
            'phone' => 'required|digits:11|numeric|starts_with:11', // ان يكون عدد خاناتة 11 فقط ويجب ان يكونوا ارقام وان يبدا برقم 0
        ]);

        //ID = IDاحضار العميل اذا كان ال 
        $customer_data = customer::where('id', $request->id);
        //Updateالجزء الخاص بال
        $customer_data->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
        //الجزء الخاص باظهار رسالة نجاح التعديل
        session()->flash('update', 'updated successfully');

        // All Customerالرجوع الي شاشة 
        return redirect('/customers');
    }
    // دالة Update

    // ==========================================
    //دالة الحذف Delete
    public function destroy(Request $request)
    {
        // وحذفهID = IDاحضار العميل اذا كان ال 
        customer::where('id', $request->id)->delete();
        session()->flash('delete', 'deleted successfully');
        // All Customerالرجوع الي شاشة 
        return redirect('/customers');
    }
    //دالة الحذف Delete

}
