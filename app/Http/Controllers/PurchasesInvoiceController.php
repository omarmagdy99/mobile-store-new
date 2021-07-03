<?php

namespace App\Http\Controllers;

use App\purchases_invoice;
use App\purchases_invoices_details;
use App\supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class PurchasesInvoiceController extends Controller
{
    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة
    public function index()
    {
        //ووضعها في متغيرDatabaseسطر خاص باحضار جميع البيانات من ال 
        $purchases_invoice = DB::select('select * from purchases_invoices ');

        //All purchasesسطر خاص بارسال البيانات الي الشاشة 
        return view('pages.Invoices.purchases.purchases', compact('purchases_invoice'));
    }
    // دالة خاصة باحضار البيانات المخزنة في قواعد البيانات لعرضها في الشاشة

    //ADDدالة الخاصة بالاضافة
    public function store(Request $request)
    {

        // Validationالجزء الخاص بالتأمين علي الشاشة
        $request->validate([

            'supplier_id' => ['required'], //وجوب ادخال الحقل
            'product_name' => ['required'],
            'quantity' => 'required|min:1', //وجوب ادخال الحقل وان لا يقل عن رقم1
            'price' => ['required'],

        ], [
            //تعديل رسالة الايرور
            'supplier_id.required' => 'you must enter supplier name'
        ]);

        $subTotal = 0;
        //يتم حساب المجموع واضافتة الي المجموع الكليLoopمع كل 
        for ($i = 0; $i < count($request->price); $i++) {
            $Total = $request->price[$i] * $request->quantity[$i];

            $subTotal += +$Total;
        }

        //لوضع تاريخ اليوم
        $dateStamp = date("Y-m-d h:i:s");

        //الخاص بالفاتورة التي تم اضافتهاIDمع احضار ADDالجزء الخاص بال
        $p_id = DB::table('purchases_invoices')->insertGetId([
            'sub_total' => $subTotal,
            'notes' => $request->note,
            'supplier_id' => $request->supplier_id,
            'user_id' => Auth::user()->id, //المسخدم الحالي السي سجل الفاتورةIDوضع 
            'created_at' => $dateStamp
        ]);

        //لاضافة اكثر من منتج داخل الفاتورة
        for ($i = 0; $i < count($request->price); $i++) {
            $uniquePur = purchases_invoices_details::where('invoice_id', '=', $p_id)->where('product_name', '=', $request->product_name[$i])->first();
            //اذا كان المنتج غير مسجل فيتم اضافتة
            if (empty($uniquePur)) {
                $total = $request->price[$i] * $request->quantity[$i];
                purchases_invoices_details::create([
                    'invoice_id' => $p_id,
                    'product_name' => $request->product_name[$i],
                    'price' => $request->price[$i],
                    'quantity' => $request->quantity[$i],
                    'total' => $total,
                ]);
            }
            //اذا كان منتج مسجلا فيتم جمع الكمية الجديدة الي الكمية القديمة والمجموع الجديد الي المجموع القديم
            else {
                $total = $request->price[$i] * $request->quantity[$i];
                $oldTotal = $uniquePur->total;
                $oldQuantity = $uniquePur->quantity;
                $newTotal = $total + $oldTotal;
                $newQuantity = $request->quantity[$i] + $oldQuantity;
                $uniquePur->update([
                    'quantity' => $newQuantity,
                    'total' => $newTotal,
                ]);
            }
        }
        //خاص باظهار رسالة نجاح اضافة الفاتورة
        $request->session()->flash('add', 'adedd Successfully');

        //AllPurchasesخاص بالعودة الي شاشة 
        return redirect('/purchases');
    }
    //الدالة الخاصة بالاضافة

    // ========================================================

    //لارجاع بيانات المورد الي فاتورة المشتريات حتي اسجل الفاتورة باسمة
    public function show(purchases_invoice $purchases_invoice)
    {
        $supplier_data = supplier::all();
        return view('pages.Invoices.purchases.AddPurchases', compact('supplier_data'));
    }

    // =============================
    //الدالة الخاصة بارسال البيانات الي شاشة التعديل
    public function edit($id)
    {
        //ID = IDاحضار الفاتورة اذا كان ال
        $d_purchases_invoice = purchases_invoice::where('id', '=', $id)->get()->first();

        //ID = IDاحضار  تفاصيل الفاتورة اذا كان ال
        $purchases_invoices_details = purchases_invoices_details::where('invoice_id', '=', $id)->get();

        //احضار بيانات المورد
        $supplier_data = supplier::get();

        //وارسال بيانات الفاتورة وتفاصيلها وبيانات الموردUpdate Purchasesالرجوع الي شاشة 
        return view('pages.Invoices.purchases.purchasesUpdate', compact(['d_purchases_invoice', 'purchases_invoices_details', 'supplier_data']));
    }
    //الدالة الخاصة بارسال البيانات الي شاشة التعديل


    //==================================================

    //Updateألدالة الخاصة بال 
    public function update($id, Request $request)
    {
        // Validationالجزء الخاص بالتأمين علي الشاشة 
        $request->validate([

            'supplier_id' => ['required'],
            'product_name' => ['required'],
            'quantity' => 'required||min:1',
            'price' => ['required'],

        ], [
            //تعديل رسالة الايرور
            'supplier_id.required' => 'you must enter supplier name'
        ]);

        $subTotal = 0;

        for ($i = 0; $i < count($request->price); $i++) {
            //Purchasesاذا كان المنتج موجود بالجدول الخاص بشاشة ال
            if ($request->status[$i] == 'unDelete') {

                $Total = $request->price[$i] * $request->quantity[$i];

                $subTotal += +$Total;
            }
        }



        $purchases_invoice = purchases_invoice::where('id', $id)->first();
        $purchases_invoice->update([
            'sub_total' => $subTotal,
            'notes' => $request->note,
            'supplier_id' => $request->supplier_id,
        ]);
        if (isset($request->price)) {


            for ($i = 0; $i < count($request->price); $i++) {
                $total = $request->price[$i] * $request->quantity[$i];

                //case (1) old invoice
                if (isset($request->product_id[$i])) { //-> if isset

                    //get data

                    // case (A) delete Invoice
                    if ($request->status[$i] == 'delete') { //->if Delete
                        // delete Invoice
                        $product = purchases_invoices_details::find($request->product_id[$i])->get()->first();
                        $product->forceDelete();
                    } //->if Delete

                    // case (B) UnDelete invoice
                    elseif ($request->status[$i] == 'unDelete') { //-> if Undelete invoice
                        // update invoice = update

                        $Update_product = purchases_invoices_details::where('id', '=', $request->product_id[$i])->first();
                        $Update_product->update([
                            'product_name' => $request->product_name[$i],
                            'price' => $request->price[$i],
                            'quantity' => $request->quantity[$i],
                            'total' => $total,
                        ]);
                    } //-> if Undelete invoice  = update
                } //-> if isset
                //case (2) new invoice
                elseif (empty($request->product_id[$i])) { //->if not isset
                    // case (A) UnDelete invoice

                    if ($request->status[$i] == 'unDelete') { //->if unDelete

                        //this product new
                        $uniquePur = purchases_invoices_details::where('invoice_id', '=', $id)->where('product_name', '=', $request->product_name[$i])->first();
                        if (empty($uniquePur)) {

                            // create invoice
                            purchases_invoices_details::create([
                                'invoice_id' => $id,
                                'product_name' => $request->product_name[$i],
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
        return redirect('/purchases');
    }
    public function detials($id)
    {
        $d_purchases_invoice = purchases_invoice::where('id', '=', $id)->get()->first();
        $purchases_invoices_details = purchases_invoices_details::where('invoice_id', '=', $id)->get();
        return view('pages.Invoices.purchases.purchasesDetails', compact(['d_purchases_invoice', 'purchases_invoices_details']));
    }

    public function destroy(Request $request)
    {
        $rowInvoice = purchases_invoice::where('id', '=', $request->id)->get()->first();
        $rowInvoice->delete();
        session()->flash('delete', 'deleted successfully');
        return back();
    }
    public function showReport($id)
    {
        if ($id == 'allInvoice') {
            $d_Purchases_invoice = DB::select('select * from purchases_invoices ');
            return view('pages.reportes.Purchases.allPurchasesReportes', compact('d_Purchases_invoice'));
        } else {


            $d_Purchases_invoice = purchases_invoice::where('id', '=', $id)->get()->first();
            $purchases_invoices_details = purchases_invoices_details::where('invoice_id', '=', $id)->get();
            return view('pages.reportes.Purchases.PurchasesReportes', compact(['d_Purchases_invoice', 'purchases_invoices_details']));
        }
    }



    public function PurchasesSearch(Request $request)
    {
        $from = date($request->date_from);
        $to = date($request->date_to);
        $id = $request->id;
        $supplier_name = $request->supplier_name;
        if ($request->search_to == 'from_date') {
            if (!empty($from && $to)) {

                $invoice_data = purchases_invoice::whereBetween('created_at', [$from . '%', $to . '%'])->get();
            } else {
                $invoice_data = purchases_invoice::where('created_at', 'like', "%$from%")->get();
            }
        } else {
            if (isset($id)) {
                $invoice_data = purchases_invoice::where('id', 'like', "%$id%")->get();
            } else {
                $id_supplier = supplier::where('name', 'like', "%$supplier_name%")->get();
                for ($i = 0; $i < count($id_supplier); $i++) {
                    $invoice_data[$i] = purchases_invoice::where('supplier_id', '=', $id_supplier[$i]->id)->get();
                }
            }
        }
        if (empty($invoice_data)) {

            return view('pages.reportes.Purchases.search', compact('id', 'supplier_name', 'from', 'to'));
        } else {

            return view('pages.reportes.Purchases.search', compact('invoice_data', 'id', 'supplier_name', 'from', 'to'));
        }
    }
}
