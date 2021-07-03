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
                    Products</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
{{-- إذا كان هناك خطأ  alert الجزء الخاص ب --}}
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
{{-- إذا كان هناك خطأ  alert الجزء الخاص ب --}}


    <!-- row -->
    <div class="row">
        <div class=" col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h2 class="card-title mb-1">Add Product</h2>
                </div>
                <div class="card-body pt-0">
            {{-- form خاصه بالأضافه  --}}
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                        action="{{ route('products.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-md-6">
                            {{-- barcode --}}
                                <input type="text" class="form-control" name="barcode" placeholder="Barcode">
                            {{-- barcode --}}
                            </div>
                            <div class="form-group col-md-6">
                                {{-- product name --}}
                                <input type="text" class="form-control" name="product_name" placeholder="Name">
                                {{-- product name --}}
                            </div>
                            <div class="form-group col-md-6">

                            {{--  category خاص بأسماء  select --}}
                            <select name="category_id" class="form-control SlectBox"
                            onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                            <!--placeholder-->
                            <option disabled selected>Choose Category</option>
                            @foreach ($category_data as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>

                            @endforeach
                        </select>
                        {{--  category خاص بأسماء  select --}}
                            </div>
                            <div class="form-group col-md-6">
                                {{-- brand name --}}
                                <input type="text" class="form-control" name="brand_name" placeholder="brand name">
                                {{-- brand name --}}
                            </div>
                            <div class="form-group col-md-4">
                                {{-- sales price --}}
                                <input type="number" class="form-control" name="sales_price" placeholder="Sales Price">
                                {{-- sales price --}}
                            </div>
                            <div class="form-group col-md-4">
                                {{-- quantity --}}
                                <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                                {{-- quantity --}}
                            </div>
                            <div class="form-group col-md-12">
                                <div class=" mt-4 ">
                                    <label for="">Product Image</label><br>
                                    {{-- image --}}
                                    <input type="file" class="dropify" data-height="200"
                                    accept="image/x-png,image/gif,image/jpeg" name="pic" />
                                    {{-- image --}}
                                </div>
                            </div>

                            <div class="form-group mb-0 mt-3 justify-content-end col-md-12">
                                <div>
                                    {{-- زرار الخاص بالإضافة --}}
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    {{-- زرار الخاص بالإضافة --}}


                                    {{-- زرار الخاص بإلغاء الأضافة --}}
                                    <a href="/products" class="btn btn-secondary">Cancel</a>
                                    {{-- زرار الخاص بإلغاء الأضافة --}}
                                </div>
                            </div>

                        </div>
                    </form>
            {{-- form خاصه بالأضافه  --}}
                </div>
            </div>


        </div>
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

@endsection
