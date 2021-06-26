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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases_invoice=DB::select('select * from purchases_invoices ');
        return view('pages.Invoices.purchases.purchases',compact('purchases_invoice'));
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
        $dateStamp=date("Y-m-d");
        $p_id=DB::table('purchases_invoices')->insertGetId([
        'sub_total'=>$request->sub_total,
        'notes'=>$request->note,
        'supplier_id'=>$request->supplier_id,
        'user_id'=>Auth::user()->id,
        'created_at'=>$dateStamp
    ]);


    for($i=0;$i<count($request->price);$i++){
        purchases_invoices_details::create([
            'invoice_id'=>$p_id,
            'product_name'=>$request->product_name[$i],
            'price'=>$request->price[$i],
            'quantity'=>$request->quantity[$i],
            'total'=>$request->total[$i],
    ]);


    }
    return redirect('/purchases');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\purchases_invoice  $purchases_invoice
     * @return \Illuminate\Http\Response
     */
    public function show(purchases_invoice $purchases_invoice)
    {
        $supplier_data=supplier::all();
        return view('pages.Invoices.purchases.AddPurchases', compact('supplier_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\purchases_invoice  $purchases_invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(purchases_invoice $purchases_invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\purchases_invoice  $purchases_invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchases_invoice $purchases_invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\purchases_invoice  $purchases_invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchases_invoice $purchases_invoice)
    {
        //
    }
}
