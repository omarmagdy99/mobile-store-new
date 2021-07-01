@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Invoice</span>
        </div>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <div class="pr-1 mb-3 mb-xl-0">
            <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
        </div>
        <div class="pr-1 mb-3 mb-xl-0">
            <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
        </div>
        <div class="pr-1 mb-3 mb-xl-0">
            <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
        </div>
        <div class="mb-3 mb-xl-0">
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-primary">14 Aug 2019</button>
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                    id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                    data-x-placement="bottom-end">
                    <a class="dropdown-item" href="#">2015</a>
                    <a class="dropdown-item" href="#">2016</a>
                    <a class="dropdown-item" href="#">2017</a>
                    <a class="dropdown-item" href="#">2018</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@if (empty($reportProduct))
    @php
        header('Location: /productSearch');
    @endphp
@endif
<!-- row -->
<div class="row row-sm" id="div_print">
    <div class="col-md-12 col-xl-12">
        <div class=" main-content-body-invoice">
            <div class="card card-invoice">
                <div class="card-body">
                    <div class="invoice-header">
                        <h1 class="invoice-title">All Product</h1>

                    </div><!-- invoice-header -->
                    <div class="row mg-t-20">


                    </div>
                    <div class="table-responsive mg-t-40">
                        <table class="table table-invoice border text-md-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="tx-center">product name</th>

                                    <th class="tx-right">category name</th>
                                    <th class="tx-center">QNTY</th>
                                    <th class="tx-right">sale Price</th>
                                    <th class="tx-right">total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <span style="display: none">{{$subTotal=0}}{{$quantity=0}}</span>
                                @foreach ($reportProduct as $item)
                                <tr>

                                    <td class="tx-center">{{$item->product_name}}</td>
                                    <td class="tx-right">{{$item->cat->category_name}}</td>
                                    <td class="tx-right">{{$item->quantity}}</td>
                                    <td class="tx-right">${{number_format($item->sale_price)}}</td>
                                    <td class="tx-right">
                                        $ {{number_format($item->quantity*$item->sale_price) }} </td>
                                </tr>
                                <span style="display: none">{{$total=$item->quantity*$item->sale_price}}{{$subTotal+=+$total}}{{$quantity+=+$item->quantity}}</span>
                                @endforeach
                                <tr>

                                    <td class="tx-right" >Sub-Total</td>
                                    <td class="tx-right" colspan="4">${{number_format($subTotal)}}</td>
                                </tr>
                                <tr>

                                    <td class="tx-right" >count All Product</td>
                                    <td class="tx-right" colspan="4">{{$quantity}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <hr class="mg-b-40">
                    <a  class="btn btn-danger float-left mt-3 mr-2 btn_print">
                        <i class="mdi mdi-printer ml-1"></i>Print
                    </a>
                </div>
            </div>
        </div>
    </div><!-- COL-END -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script>
    $('.btn_print').click(function(){
        $(this).hide();
        var mywindow=document.getElementById('div_print');
        $body=$('body').html();
        $('body').empty().html(mywindow);
        window.print();
        location.reload();
    })
</script>

@endsection
