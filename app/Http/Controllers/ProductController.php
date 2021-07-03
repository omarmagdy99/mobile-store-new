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

    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة
    public function index()
    {
        //ووضعها في متغيرModelسطر خاص باحضار جميع البيانات من ال 
        $product_data = product::all();
        //سطر خاص بارسال البيانات الي الشاشة المراده
        return view('pages.products.products', compact('product_data'));
    }
    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة
    // ========================================
    //دالة خاصة باحضار جميع الفئات المخزنة في قواعد البيانات لعرضها في الشاشة
    public function cat()
    {
        //ووضعها في متغيرModelسطر خاص باحضار جميع البيانات من ال 
        $category_data = category::all();
        //سطر خاص بارسال البيانات الي الشاشة المراده
        return view('pages.products.AddProducts', ['category_data' => $category_data]);
    }
    // =========================================================================

    //ADDدالة الخاصة بالاضافة 
    public function store(Request $request)
    {
        // ====================
        // Validationالجزء الخاص بالتأمين علي الشاشة
        $request->validate([

            'barcode' => ['required', 'unique:products'], //الزامية ادخال هذا الحقل ويجب ان يكون مميز وغير متكرر
            'product_name' => ['required'],
            'brand_name' => ['required'],
            'category_id' => ['required'],
            'pic' => ['required'],
            'sales_price' => ['required'],
            'quantity' => 'required|min:1' //الزامية ادخال الحقل وان لا يقل عن رقم1

        ]);

        //==========================================

        // Add productالجزء الخاص بال
        //Modelوارسالها الي ال Formوهو عبارة عن وضع البيانات المرسلة من ال
        product::create([
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'brand_name' => $request->brand_name,
            'category_id' => $request->category_id,
            'image' => $request->file('pic')->store('productName', 'public'),
            'sale_price' => $request->sales_price,
            'quantity' => $request->quantity,
        ]);

        //سطر خاص بظهور رسالة نجاح عملية الاضافة
        session()->flash('add', 'added successfully');

        //Productsبعد نجاح العمليات السابقة يتم ارسالي الي شاشة ال
        return redirect('/products');
    }
    //ADDدالة الخاصة بالاضافة 

    // =================================================================================

    //Updateدالة خاصة بالرسال البيانات الي صفحة ال 
    public function edit($barcode)
    {
        //احضار المنتج المراد تعدسلة ووضعة في متغير
        $product = product::where('barcode', $barcode)->first();
        //احضار كل الفثات ووضعها في متغير
        $category_data = category::all();
        //Updateارسال المنتج المراد تعديلة وجميع الفئات وارسالها الي صفحة ال 
        return view('pages.products.UpdateProducts', ['category_data' => $category_data, 'product' => $product]);
    }
    //Updateدالة خاصة بالرسال البيانات الي صفحة ال 

    //Updateالدالة الخاصة بالتعديل
    public function update(Request $request)
    {
        //Update الجزء الخاص بالتأمين علي شاشة 
        $request->validate([
            'barcode' => ['required'],
            'product_name' => ['required'],
            'brand_name' => ['required'],
            'category_id' => ['required'],
            'pic' => ['required'],
            'sales_price' => ['required'],
            'quantity' => ['required'],

        ]);
        //==================================================
        $id = $request->id;
        $p_data = product::where('id', $id)->first();

        if ($p_data->image != $request->pic) {

            $file = $request->file('pic')->store('productName', 'public');
            Storage::disk('public')->delete($p_data->image);
        } else {
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
    //Updateالدالة الخاصة بالتعديل


    public function destroy(Request $request)
    {

        product::find($request->product_id)->delete();
        session()->flash('delete', 'deleted successfully');
        Storage::disk('public')->delete($request->pic);
        return redirect('/products');
    }

    public function showReport($id)
    {
        if ($id == 'allProduct') {
            $reportProduct = product::get();
            if (isset($reportProduct)) {

                return view('pages.reportes.product.allProductReportes', compact('reportProduct'));
            }
        } else {

            $reportProduct = product::where('id', '=', $id)->first();
            if (isset($reportProduct)) {

                return view('pages.reportes.product.productReportes', compact('reportProduct'));
            } else {
                return view('pages.reportes.product.search');
            }
        }
    }



    public function productSearch(Request $request)
    {

        if (isset($request->barcode)) {
            $product_data = product::where('barcode', 'like', "%$request->barcode%")->get();
            return view('pages.reportes.product.search', compact('product_data'));
        } else if (isset($request->product_name)) {
            $product_data = product::where('product_name', 'like', "%$request->product_name%")->get();
            return view('pages.reportes.product.search', compact('product_data'));
        } else if (isset($request->brand_name)) {
            $product_data = product::where('brand_name', 'like', "%$request->brand_name%")->get();
            return view('pages.reportes.product.search', compact('product_data'));
        }
        return view('pages.reportes.product.search');
    }
}
