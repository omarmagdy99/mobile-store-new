@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Empty</span>
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
<!-- row -->
<div class="row row-sm" id="div_print">
    <div class="col-md-12 col-xl-12">
        <div class=" main-content-body-invoice">
            <div class="card card-invoice">
                <div class="card-body" style="height: 70vh">
                    <form action="/productSearch" method="get">

                        <div class="row">
                            <div class="col-4">
                                <label for="">search for barcode</label>
                              {{-- barcode   البحث عن  --}}
                              <input type="text" class="form-control" name="barcode" id="barcode"
                              placeholder="search for barcode">
                              {{-- barcode   البحث عن  --}}
                            </div>

                            <div class="col-4">
                                <label for="">search for product name</label>
                                {{-- product name   البحث عن  --}}
                                <input type="text" class="form-control" name="product_name" id="product_name"
                                placeholder="search for product name">
                                {{-- product name   البحث عن  --}}
                            </div>
                            <div class="col-4">
                                <label for="">search for brand name</label>
                                {{-- brand name   البحث عن  --}}
                                <input type="text" class="form-control" name="brand_name" id="brand_name"
                                placeholder="search for brand name">
                                {{-- brand name   البحث عن  --}}
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-12 text-center">
                                {{-- search  --}}
                                <input type="submit" class="btn btn-primary my-3" value="search">
                                {{-- search  --}}



                                {{-- search for all product  --}}
                                <a href="productReportes/allProduct"  class="btn btn-primary my-3" >all product</a>
                                {{-- search for all product  --}}
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive border-top userlist-table">
                    {{-- الجدول الذي تعرض فيه البيانات --}}

                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0" style="width: 2%">#</th>
                                        <th class="border-bottom-0" style="width: 2%">barcode</th>
                                        <th class="wd-lg-20p">product name</th>
                                        <th class="wd-lg-20p">quantity</th>
                                        <th class="wd-lg-20p">sale price</th>
                                        <th class="wd-lg-20p">brand name</th>


                                    </tr>
                                </thead>
                                <tbody>
                            {{-- product الجزء مسئول عن عرض المعلومات الخاصه ب --}}
                                    @php
                                        $i=1;
                                    @endphp
                                    @if (isset($product_data))

                                    @foreach ($product_data as $item)

                                    <tr>
                                        <td>@php
                                            echo $i++;
                                        @endphp</td>

                                        <td><a href="productReportes/{{$item->id}}">{{$item->barcode}}</a></td>
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->sale_price}}</td>
                                        <td>{{$item->brand_name}}</td>


                                    </tr>
                                    @endforeach
                                    @endif
                            {{-- product الجزء مسئول عن عرض المعلومات الخاصه ب --}}

                                </tbody>
                            </table>
                    {{-- الجدول الذي تعرض فيه البيانات --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script>
    $('#barcode').on('keypress',function(){
        $('#product_name,#brand_name').val('');
    });
    $('#product_name').on('keypress',function(){
        $('#barcode,#brand_name').val('');
    });
    $('#brand_name').on('keypress',function(){
        $('#product_name,#barcode').val('');
    });
</script>
@endsection
