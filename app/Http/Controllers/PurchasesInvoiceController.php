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
    {   $subTotal=0;
        for($i=0;$i<count($request->price);$i++){
        $Total=$request->price[$i]*$request->quantity[$i];

        $subTotal+=+$Total;
        }

        $dateStamp=date("Y-m-d h:i:s");
        $p_id=DB::table('purchases_invoices')->insertGetId([
        'sub_total'=>$subTotal,
        'notes'=>$request->note,
        'supplier_id'=>$request->supplier_id,
        'user_id'=>Auth::user()->id,
        'created_at'=>$dateStamp
    ]);


    for($i=0;$i<count($request->price);$i++){
        $total=$request->price[$i]*$request->quantity[$i];
        purchases_invoices_details::create([
            'invoice_id'=>$p_id,
            'product_name'=>$request->product_name[$i],
            'price'=>$request->price[$i],
            'quantity'=>$request->quantity[$i],
            'total'=>$total,
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
    public function edit( $id)
    {
        $d_purchases_invoice=purchases_invoice::where('id','=',$id)->get()->first();
        $purchases_invoices_details=purchases_invoices_details::where('invoice_id','=',$id)->get();
        $supplier_data=supplier::get();
        return view('pages.Invoices.purchases.purchasesUpdate',compact(['d_purchases_invoice','purchases_invoices_details','supplier_data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\purchases_invoice  $purchases_invoice
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {


        $purchases_invoice=purchases_invoice::find($id)->get()->first();
        $purchases_invoice->update([
        'sub_total'=>$request->sub_total,
        'notes'=>$request->note,
        'supplier_id'=>$request->supplier_id,
        ]);
        if(isset($request->price)){


            for($i=0;$i<count($request->price);$i++){


                //case (1) old invoice
                if(isset($request->product_id[$i])){ //-> if isset
                    //get data
                    $product=purchases_invoices_details::find($request->product_id[$i])->get()->first();

                        // case (A) delete Invoice
                    if($request->status[$i]=='delete'){//->if Delete
                        // delete Invoice
                        $product->forceDelete();
                    } //->if Delete

                    // case (B) UnDelete invoice
                    else{ //-> if Undelete invoice
                        // update invoice = update

                        $product->update([
                            'product_name'=>$request->product_name[$i],
                            'price'=>$request->price[$i],
                            'quantity'=>$request->quantity[$i],
                            'total'=>$request->total[$i],
                        ]);
                    }//-> if Undelete invoice  = update
                }//-> if isset
                //case (2) new invoice
                else{//->if not isset
                    // case (A) UnDelete invoice

                    if($request->status[$i]=='unDelete'){//->if unDelete

                        // create invoice
                        purchases_invoices_details::create([
                            'invoice_id'=>$id,
                            'product_name'=>$request->product_name[$i],
                            'price'=>$request->price[$i],
                            'quantity'=>$request->quantity[$i],
                            'total'=>$request->total[$i],
                        ]);
                    } //->if unDelete
                }//->if not isset
            }
        }

        $request->session()->flash('update', 'update successfully');
        return redirect('/purchases');
    }
    public function detials($id){
        $d_purchases_invoice=purchases_invoice::where('id','=',$id)->get()->first();
        $purchases_invoices_details=purchases_invoices_details::where('invoice_id','=',$id)->get();
        return view('pages.Invoices.purchases.purchasesDetails',compact(['d_purchases_invoice','purchases_invoices_details']));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\purchases_invoice  $purchases_invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rowInvoice=purchases_invoice::where('id','=',$request->id)->get()->first();
        $rowInvoice->delete();
        session()->flash('delete', 'deleted successfully');
        return back();
    }
}
