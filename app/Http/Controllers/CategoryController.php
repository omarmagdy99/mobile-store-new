<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة
    public function index()
    {
        //ووضعها في متغيرModelسطر خاص باحضار جميع البيانات من ال 
        $category_data = category::all();

        //All Categoriesسطر خاص بارسال البيانات الي الشاشة 
        return view('pages.Categories.categories', compact('category_data'));
    }

    // ADDدالة خاصة بال 
    public function store(Request $request)
    {
        //Valicationجزء خاص بالتامين علي الشاشة
        $request->validate([
            'category_name' => ['required', 'unique:categories'],

        ]);
        // جزء خاص بالاضافة 
        category::create([

            'category_name' => $request->category_name,
        ]);
        //سطر خاص باظهار رسالة نجاح هملية الاضافة
        session()->flash('add', 'added successfully');
        return redirect('/categories');
    }
    // ADDدالة خاصة بال 

    // ====================================

    //Updateدالة خاصة بال
    public function update(Request $request)

    {
        // ووضعة في متغيرFormمن الID احضار ال 
        $id = $request->category_id;

        //احضار الفئة اذا كان 
        //ID = ID
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
    //Updateدالة خاصة بال


    //Deleteدالة خاصة بال
    public function destroy(Request $request)
    {
        category::find($request->category_id)->delete();
        session()->flash('delete', 'deleted successfully');
        return redirect('categories');
    }
    //Deleteدالة خاصة بال

}
