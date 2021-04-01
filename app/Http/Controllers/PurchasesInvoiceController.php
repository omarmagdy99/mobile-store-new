<?php

namespace App\Http\Controllers;

use App\purchases_invoice;
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
        return view('pages.invoices.purchases.AddPurchases');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\purchases_invoice  $purchases_invoice
     * @return \Illuminate\Http\Response
     */
    public function show(purchases_invoice $purchases_invoice)
    {
        //
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
