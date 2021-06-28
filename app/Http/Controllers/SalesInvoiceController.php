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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $subTotal=0;
        for($i=0;$i<count($request->price);$i++){
            $total=$request->price[$i]*$request->quantity[$i];
            $subTotal+=+$total;
        }
        $data_naw=date("Y-m-d h:i:s");
        $id_invoice=DB::table('sales_invoices')->insertGetID([
            'sub_total'=>$subTotal,
            'notes'=>$request->note,
            'user_id'=>Auth::user()->id,
            'customer_id'=>$request->customer_id,
            'created_at'=>$data_naw
    ]);
    for($i=0;$i<count($request->price);$i++){
        $total=$request->price[$i]*$request->quantity[$i];
        sales_invoice_details::create([
            'sales_invoice_id'=>$id_invoice,
            'product_id'=>$request->product_id[$i],
            'qunatity'=>$request->quantity[$i],
            'price'=>$request->price[$i],
            'total'=>$total
    ]);
    }
    return redirect('AddSales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sales_invoice  $sales_invoice
     * @return \Illuminate\Http\Response
     */
    public function show(sales_invoice $sales_invoice)
    {
        $customer_data=customer::all();
        $product_data=product::all();
        return view('pages.Invoices.sales.AddSales', compact(['customer_data','product_data']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sales_invoice  $sales_invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(sales_invoice $sales_invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sales_invoice  $sales_invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sales_invoice $sales_invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sales_invoice  $sales_invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(sales_invoice $sales_invoice)
    {
        //
    }
}
