<?php

namespace App\Http\Controllers;

use App\customer;
use App\product;
use App\sales_invoice;
use App\sales_invoice_details;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SalesInvoiceController extends Controller
{
    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة
    public function index()
    {
        //ووضعها في متغيرDatabaseسطر خاص باحضار جميع البيانات من ال 
        $sales_invoice = DB::select('select * from sales_invoices ');

        //All salesسطر خاص بارسال البيانات الي الشاشة 
        return view('pages.invoices.sales.sales', compact('sales_invoice'));
    }
    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة


    //ADDدالة الخاصة بالاضافة
    public function store(Request $request)
    {

        // Validationالجزء الخاص بالتأمين علي الشاشة
        $request->validate([
            'customer_id' => ['required'],
            'product_id' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],

        ], [
            //تعديل رسالة الايرور
            'customer_id.required' => 'you must enter customer name'
        ]);
        $subTotal = 0;

        //يتم حساب المجموع واضافتة الي المجموع الكليLoopمع كل 
        for ($i = 0; $i < count($request->price); $i++) {
            $total = $request->price[$i] * $request->quantity[$i];
            $subTotal += +$total;
        }

        //لوضع تاريخ اليوم
        $data_naw = date("Y-m-d h:i:s");

        //الخاص بالفاتورة التي تم اضافتهاIDمع احضار ADDالجزء الخاص بال
        $id_invoice = DB::table('sales_invoices')->insertGetID([
            'sub_total' => $subTotal,
            'notes' => $request->note,
            'user_id' => Auth::user()->id, //المسخدم الحالي السي سجل الفاتورةIDوضع 
            'customer_id' => $request->customer_id,
            'created_at' => $data_naw
        ]);

        //لاضافة اكثر من منتج داخل الفاتورة
        for ($i = 0; $i < count($request->price); $i++) {
            $details = sales_invoice_details::where('sales_invoice_id', '=', $id_invoice)->where('product_id', '=', $request->product_id[$i])->first();

            //اذا كان المنتج غير مسجل فيتم اضافتة
            if (!isset($details)) {

                $total = $request->price[$i] * $request->quantity[$i];
                sales_invoice_details::create([
                    'sales_invoice_id' => $id_invoice,
                    'product_id' => $request->product_id[$i],
                    'quantity' => $request->quantity[$i],
                    'price' => $request->price[$i],
                    'total' => $total
                ]);

                $product_quantity = product::where('id', '=', $request->product_id[$i])->first();
                $quantity = $product_quantity->quantity;
                $newQuantity = $quantity - $request->quantity[$i];
                $product_quantity->update([
                    'quantity' => $newQuantity
                ]);
            }
        }
        //خاص باظهار رسالة نجاح اضافة الفاتورة
        $request->session()->flash('add', 'adedd Successfully');

        //All salesخاص بالعودة الي شاشة 
        return redirect('/sales');
    }
    //الدالة الخاصة بالاضافة

    //========================================

    //لارجاع بيانات المورد الي فاتورة المشتريات حتي اسجل الفاتورة باسمة
    public function show(Request $request)
    {
        $customer_data = customer::all();
        $product_data = product::all();
        return view('pages.Invoices.sales.AddSales', compact(['customer_data', 'product_data']));
    }
    //لارجاع بيانات المورد الي فاتورة المشتريات حتي اسجل الفاتورة باسمة

    // ===================================================

    //الدالة الخاصة بارسال البيانات الي شاشة التعديل
    public function edit($id)
    {
        //ID = IDاحضار الفاتورة اذا كان ال
        $d_sales_invoice = sales_invoice::where('id', '=', $id)->get()->first();

        //ID = IDاحضار  تفاصيل الفاتورة اذا كان ال
        $sales_invoices_details = sales_invoice_details::where('sales_invoice_id', '=', $id)->get();

        //احضار بيانات العميل
        $customer_data = customer::get();

        //احضار بيانات المنتجات
        $product_data = product::all();

        //وارسال بيانات الفاتورة وتفاصيلها وبيانات العميل والمنتجاتUpdate Salesالرجوع الي شاشة 
        return view('pages.Invoices.sales.salesUpdate', compact(['product_data', 'd_sales_invoice', 'sales_invoices_details', 'customer_data']));
    }
    //الدالة الخاصة بارسال البيانات الي شاشة التعديل

    //Updateألدالة الخاصة بال 

    public function update($id, Request $request)
    {
        $request->validate([

            'note' => ['required'],
            'customer_id' => ['required'],
            'product_id' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],

        ], [
            'customer_id.required' => 'you must enter customer name'
        ]);
        $subTotal = 0;
        for ($i = 0; $i < count($request->price); $i++) {

            if ($request->status[$i] == 'unDelete') {

                $Total = $request->price[$i] * $request->quantity[$i];

                $subTotal += +$Total;
            }
        }
        $sales_invoice = sales_invoice::where('id', $id)->first();
        $sales_invoice->update([
            'sub_total' => $subTotal,
            'notes' => $request->note,
            'customer_id' => $request->customer_id,
        ]);
        if (isset($request->price)) {


            for ($i = 0; $i < count($request->price); $i++) {
                $total = $request->price[$i] * $request->quantity[$i];

                //case (1) old invoice
                if (isset($request->sales_id[$i])) { //-> if isset

                    //get data

                    // case (A) delete Invoice
                    if ($request->status[$i] == 'delete') { //->if Delete
                        // delete Invoice

                        $quantity = 0;
                        $details = sales_invoice_details::where('id', '=', $request->sales_id[$i])->first();

                        $productSelect = product::where('id', '=', $request->product_id[$i])->first();
                        $product_quantity = $productSelect->quantity;
                        $request_quantity = $request->quantity;

                        $quantity = floatval($product_quantity) + floatval($request_quantity);
                        $productSelect->update([
                            'quantity' => $quantity,
                        ]);

                        $details->delete();
                    } //->if Delete

                    // case (B) UnDelete invoice
                    elseif ($request->status[$i] == 'unDelete') { //-> if Undelete invoice
                        // update invoice = update

                        $Update_product = sales_invoice_details::where('id', '=', $request->sales_id[$i])->first();
                        $Update_product->update([
                            'product_id' => $request->product_id[$i],
                            'price' => $request->price[$i],
                            'quantity' => $request->quantity[$i],
                            'total' => $total,
                        ]);
                    } //-> if Undelete invoice  = update
                } //-> if isset
                //case (2) new invoice
                elseif (empty($request->sales_id[$i])) { //->if not isset
                    // case (A) UnDelete invoice

                    if ($request->status[$i] == 'unDelete') { //->if unDelete

                        //this product new
                        $uniquePur = sales_invoice_details::where('sales_invoice_id', '=', $id)->where('product_id', '=', $request->product_id[$i])->first();
                        if (empty($uniquePur)) {

                            // create invoice
                            sales_invoice_details::create([
                                'sales_invoice_id' => $id,
                                'product_id' => $request->product_id[$i],
                                'price' => $request->price[$i],
                                'quantity' => $request->quantity[$i],
                                'total' => $total,
                            ]);
                        }
                        //this product new
                        //this product old
                        elseif (isset($uniquePur)) {

                            $newQuantity = $request->quantity[$i] + $uniquePur->quantity;
                            $newTotal = $newQuantity * $uniquePur->price;

                            // update invoice
                            $uniquePur->update([
                                'quantity' => $newQuantity,
                                'total' => $newTotal,
                            ]);
                        }
                        //this product old

                    } //->if unDelete
                } //->if not isset
            }
        }

        $request->session()->flash('update', 'update successfully');
        return redirect('/sales');
    }
    //Updateألدالة الخاصة بال 

    //دالة الحذف Delete
    public function destroy(Request $request)
    {
        $d_sales_invoice = sales_invoice::where('id', '=', $request->id)->first();
        $details = sales_invoice_details::where('sales_invoice_id', '=', $request->id)->get();
        // $product_data=product::where('id','$d_sales_invoice->product_id')->first();
        $quantity = 0;
        for ($i = 0; $i < count($details); $i++) {
            $productSelect = product::where('id', '=', $details[$i]->product_id)->first();
            $quantity = $productSelect->quantity + $details[$i]->quantity;
            $productSelect->update([
                'quantity' => $quantity,
            ]);
        }
        $d_sales_invoice->delete();
        session()->flash('delete', 'deleted successfully');
        return back();
    }
    //دالة الحذف Delete




    public function detials($id)
    {
        $d_sales_invoice = sales_invoice::where('id', '=', $id)->get()->first();
        $sales_invoice_details = sales_invoice_details::where('sales_invoice_id', '=', $id)->get();
        return view('pages.Invoices.sales.salesDetails', compact(['d_sales_invoice', 'sales_invoice_details']));
    }
    public function showReport($id)
    {
        if ($id == 'allInvoice') {
            $d_sales_invoice = DB::select('select * from sales_invoices ');
            return view('pages.reportes.sales.allSalesReportes', compact('d_sales_invoice'));
        } else {


            $d_sales_invoice = sales_invoice::where('id', '=', $id)->get()->first();
            $sales_invoice_details = sales_invoice_details::where('sales_invoice_id', '=', $id)->get();
            return view('pages.reportes.sales.salesReportes', compact(['d_sales_invoice', 'sales_invoice_details']));
        }
    }



    public function salesSearch(Request $request)
    {
        $from = date($request->date_from);
        $to = date($request->date_to);
        $id = $request->id;
        $customer_name = $request->customer_name;
        if ($request->search_to == 'from_date') {
            if (!empty($from && $to)) {

                $invoice_data = sales_invoice::whereBetween('created_at', [$from . '%', $to . '%'])->get();
            } else {
                $invoice_data = sales_invoice::where('created_at', 'like', "%$from%")->get();
            }
        } else {
            if (isset($id)) {

                $invoice_data = sales_invoice::where('id', 'like', "%$id%")->get();
            } else {
                $id_customer = customer::where('name', 'like', "%$customer_name%")->get();
                for ($i = 0; $i < count($id_customer); $i++) {
                    $invoice_data[$i] = sales_invoice::where('customer_id', '=', $id_customer[$i]->id)->get();
                }
            }
        }
        if (empty($invoice_data)) {

            return view('pages.reportes.sales.search', compact('id', 'customer_name', 'from', 'to'));
        } else {

            return view('pages.reportes.sales.search', compact('invoice_data', 'id', 'customer_name', 'from', 'to'));
        }
    }
}
