@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />


@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Add
                    Purchases Invoice</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                <div class="alert alert-danger mg-b-0" role="alert">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Oh snap!</strong> {{ $error }}
                </div>
            @endforeach

        </div>
    @endif


    <!-- row -->
    <div class="row">
        <div class=" col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h2 class="card-title mb-1">Add Purchases Invoice</h2>
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="">
                        {{ csrf_field() }}
                        <div class="row other">


                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="barcode" placeholder="Barcode">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="product_name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">

                                <select name="category_id" class="form-control SlectBox"
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option disabled selected>Choose Category</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="sales_price" placeholder="Sales Price">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="purchase_price"
                                    placeholder="Purchase Price">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                            </div>
                            <a class="btn btn-primary plus">plus</a>
                        </div>



                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="barcode" placeholder="Invoice Number">
                            </div>
                            <div class="form-group col-md-6">

                                <select name="category_id" class="form-control SlectBox"
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option disabled selected>Product Barcode</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="sales_price" placeholder="Quantity">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="purchase_price"
                                    placeholder="Purchase Price">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                            </div>



                            <div class="form-group mb-0 mt-3 justify-content-end col-md-12">
                                <div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href="/products" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    </div>
    <!-- Container closed -->
    </div>
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <script>
        $('.plus').click(function() {
            $elment = $('.other').html();

            $('.other').append($elment);
        });

    </script>
@endsection
