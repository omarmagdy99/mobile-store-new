<?php

namespace App\Http\Controllers;

use App\product;
use App\category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة
    public function index()
    {
        //ووضعها في متغيرModelسطر خاص باحضار جميع البيانات من ال 
        $product_data = product::all();
        //All Productsسطر خاص بارسال البيانات الي الشاشة 
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

            'barcode' => ['required', 'unique:products'], //وجوب ادخال هذا الحقل ويجب ان يكون مميز وغير متكرر
            'product_name' => ['required'],
            'brand_name' => ['required'],
            'category_id' => ['required'],
            'pic' => ['required'],
            'sales_price' => ['required'],
            'quantity' => 'required|min:1' //وجوب ادخال الحقل وان لا يقل عن رقم1

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

    //الدالة الخاصة بارسال البيانات الي شاشة التعديل
    public function edit($barcode)
    {
        //احضار المنتج المراد تعدسلة ووضعة في متغير
        $product = product::where('barcode', $barcode)->first();
        //احضار كل الفثات ووضعها في متغير
        $category_data = category::all();
        //Updateارسال المنتج المراد تعديلة وجميع الفئات وارسالها الي صفحة ال 
        return view('pages.products.UpdateProducts', ['category_data' => $category_data, 'product' => $product]);
    }
    //الدالة الخاصة بارسال البيانات الي شاشة التعديل

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

        // ووضعة في متغيرFormمن الID احضار ال 
        $id = $request->id;
        //احضار المنتج اذا كان 
        //ID = ID
        $p_data = product::where('id', $id)->first();

        //اذا كانت الصورة قديمة فانة سيتم اضافة صورة جديدة
        if ($p_data->image != $request->pic) {

            $file = $request->file('pic')->store('productName', 'public');
            Storage::disk('public')->delete($p_data->image);
            //الاحتفاظ بالصورة القديمة
        } else {
            $file = $request->pic;
        }
        // ===================================

        //Updateالجزء الخاص بال 
        $p_data->update([
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'brand_name' => $request->brand_name,
            'sales_price' => $request->sales_price,
            'quantity' => $request->quantity,
            'image' => $file,
        ]);

        //الجزء الخاص باظهار رسالة تحديث البيانات
        session()->flash('edit', 'edited successfully');

        //All Productsالارجاع الي صفحة ال
        return redirect('/products');
    }
    //Updateالدالة الخاصة بالتعديل

    // =======================================

    //Deleteألدالة الخاصة بالحذف 
    public function destroy(Request $request)
    {
        // المنتج وحذفةID البحث عن 
        product::find($request->product_id)->delete();

        //الجزء الخاص باظهار رسالة حذف البيانات
        session()->flash('delete', 'deleted successfully');

        //خاص بحذف الصورة
        Storage::disk('public')->delete($request->pic);

        //All Productsالارجاع الي صفحة ال
        return redirect('/products');
    }
    //Deleteألدالة الخاصة بالحذف 

    // =============================================
    //الدالة الخاصة بتقارير المنتجات
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
    //الدالة الخاصة بتقارير المنتجات

    // ===================================
    //الدالة الخاصة ب البحث عن المنتجات في التقارير
    public function productSearch(Request $request)
    {
        //اذا كان الباركود متاح يتم البحث عن طريق الباركود
        if (isset($request->barcode)) {
            $product_data = product::where('barcode', 'like', "%$request->barcode%")->get();
            return view('pages.reportes.product.search', compact('product_data'));
        }
        //اذا لم يكن الباركود متاح يتم البحث عن طريق اسم المنتج
        else if (isset($request->product_name)) {
            $product_data = product::where('product_name', 'like', "%$request->product_name%")->get();
            return view('pages.reportes.product.search', compact('product_data'));
        }
        //اذا لم يكن الباركود متاح ابحث بماركة المنتج 
        else if (isset($request->brand_name)) {
            $product_data = product::where('brand_name', 'like', "%$request->brand_name%")->get();
            return view('pages.reportes.product.search', compact('product_data'));
        }
        return view('pages.reportes.product.search');
    }
}
    //الدالة الخاصة ب البحث عن المنتجات في التقارير
