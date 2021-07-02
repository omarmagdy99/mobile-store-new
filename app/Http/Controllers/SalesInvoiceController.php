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
    {  $sales_invoice=DB::select('select * from sales_invoices ');
        return view('pages.invoices.sales.sales',compact('sales_invoice'));
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
        $request->validate([

            'note'=>['required'],
            'customer_id'=>['required'],
            'product_id'=>['required'],
            'quantity'=>['required'],
            'price'=>['required'],

        ],[
            'customer_id.required'=>'you must enter customer name'
        ]);
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
            $details=sales_invoice_details::where('sales_invoice_id','=',$id_invoice)->where('product_id','=',$request->product_id[$i])->first();
            if(!isset($details)){

                $total=$request->price[$i]*$request->quantity[$i];
                sales_invoice_details::create([
                    'sales_invoice_id'=>$id_invoice,
                    'product_id'=>$request->product_id[$i],
                    'quantity'=>$request->quantity[$i],
                    'price'=>$request->price[$i],
                    'total'=>$total
                ]);
                $product_quantity=product::where('id','=',$request->product_id[$i])->first();
                $quantity=$product_quantity->quantity;
               $newQuantity=$quantity-$request->quantity[$i];
               $product_quantity->update([
                   'quantity'=>$newQuantity
                ]);
            }
        }
        $request->session()->flash('add','adedd Successfully');
        return redirect('/sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sales_invoice  $sales_invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
    public function edit($id)
    {
        $d_sales_invoice=sales_invoice::where('id','=',$id)->get()->first();
        $sales_invoices_details=sales_invoice_details::where('sales_invoice_id','=',$id)->get();
        $customer_data=customer::get();
        $product_data=product::all();
        return view('pages.Invoices.sales.salesUpdate',compact(['product_data','d_sales_invoice','sales_invoices_details','customer_data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sales_invoice  $sales_invoice
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $request->validate([

            'note'=>['required'],
            'customer_id'=>['required'],
            'product_id'=>['required'],
            'quantity'=>['required'],
            'price'=>['required'],

        ],[
            'customer_id.required'=>'you must enter customer name'
        ]);
        $subTotal=0;
        for($i=0;$i<count($request->price);$i++){

            if($request->status[$i]=='unDelete'){

                    $Total=$request->price[$i]*$request->quantity[$i];

                    $subTotal+=+$Total;
            }
        }
        $sales_invoice=sales_invoice::where('id',$id)->first();
        $sales_invoice->update([
        'sub_total'=>$subTotal,
        'notes'=>$request->note,
        'customer_id'=>$request->customer_id,
        ]);
        // if(isset($request->price)){


        // for($i=0;$i<count($request->price);$i++){
        //     $total=$request->price[$i]*$request->quantity[$i];

        //     //case (1) old invoice
        //     if(isset($request->product_id[$i])){ //-> if isset

        //         //get data

        //             // case (A) delete Invoice
        //         if($request->status[$i]=='delete'){//->if Delete
        //             // delete Invoice
        //             $product=sales_invoices_details::find($request->product_id[$i])->get()->first();
        //             $product->forceDelete();
        //         } //->if Delete

        //         // case (B) UnDelete invoice
        //         elseif($request->status[$i]=='unDelete'){ //-> if Undelete invoice
        //             // update invoice = update

        //             $Update_product=sales_invoices_details::where('id','=',$request->product_id[$i])->first();
        //             $Update_product->update([
        //                 'product_name'=>$request->product_name[$i],
        //                 'price'=>$request->price[$i],
        //                 'quantity'=>$request->quantity[$i],
        //                 'total'=>$total,
        //             ]);
        //         }//-> if Undelete invoice  = update
        //     }//-> if isset
        //     //case (2) new invoice
        //     elseif(empty($request->product_id[$i])){//->if not isset
        //         // case (A) UnDelete invoice

        //         if($request->status[$i]=='unDelete'){//->if unDelete

        //             //this product new
        //             $uniquePur=sales_invoices_details::where('invoice_id','=',$id)->where('product_name','=',$request->product_name[$i])->first();
        //             if(empty($uniquePur)){

        //                 // create invoice
        //                 sales_invoices_details::create([
        //                     'invoice_id'=>$id,
        //                     'product_name'=>$request->product_name[$i],
        //                     'price'=>$request->price[$i],
        //                     'quantity'=>$request->quantity[$i],
        //                     'total'=>$total,
        //                 ]);
        //             }
        //             //this product new
        //             //this product old
        //             elseif(isset($uniquePur)){
        //                 // $uniquePur=sales_invoices_details::where('invoice_id','=',$id)->where('product_name','=',$request->product_name[$i])->first();

        //                 $newQuantity=$request->quantity[$i]+$uniquePur->quantity;
        //                 $newTotal=$newQuantity*$uniquePur->price;

        //                 // update invoice
        //                 $uniquePur->update([
        //                     'quantity'=>$newQuantity,
        //                     'total'=>$newTotal,
        //                 ]);


        //             }
        //             //this product old

        //             } //->if unDelete
        //     }//->if not isset
        // }
        // }

        $request->session()->flash('update', 'update successfully');
        return redirect('/sales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sales_invoice  $sales_invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $d_sales_invoice=sales_invoice::where('id','=',$request->id)->first();
        $details=sales_invoice_details::where('sales_invoice_id','=',$request->id)->get();
        // $product_data=product::where('id','$d_sales_invoice->product_id')->first();
        $quantity=0;
        for ($i=0; $i < count($details); $i++) {
            $productSelect=product::where('id','=',$details[$i]->product_id)->first();
            $quantity=$productSelect->quantity+$details[$i]->quantity;
            $productSelect->update([
            'quantity'=>$quantity,
        ]);
        }
        $d_sales_invoice->delete();
        session()->flash('delete', 'deleted successfully');
        return back();


    }
    public function detials($id){
        $d_sales_invoice=sales_invoice::where('id','=',$id)->get()->first();
        $sales_invoice_details=sales_invoice_details::where('sales_invoice_id','=',$id)->get();
        return view('pages.Invoices.sales.salesDetails',compact(['d_sales_invoice','sales_invoice_details']));

    }
}
