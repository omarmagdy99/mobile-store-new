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
                <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ update
                    Products</span>
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
                    <h2 class="card-title mb-1">Add Product</h2>
                    
                    
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                        action="/products/update">
                        {{ csrf_field() }}
                         {{ method_field('PUT') }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="barcode" placeholder="Barcode" value="{{$product->barcode}}">
                                <input type="hidden" name="id" value="{{$product->id}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="product_name" placeholder="Name" value="{{$product->product_name}}">
                            </div>
                            <div class="form-group col-md-6">

                                <select name="category_id" class="form-control SlectBox"
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="{{$product->category_id}}" selected>{{$product->cat->category_name}}</option>
                                    @foreach ($category_data as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">

                                <select name="brand_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="{{$product->brand_id}}" selected>{{$product->brand->brand_name}}</option>
                                    @foreach ($brand_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->brand_name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" value="{{$product->sale_price}}" name="sales_price" placeholder="Sales Price">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="purchase_price"
                                    placeholder="Purchase Price" value="{{$product->purchase_price}}">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="quantity" placeholder="Quantity" value="{{$product->quantity}}">
                            </div>
                            <div class="form-group col-md-12 file_image">
                                <div class=" mt-4 ">
                                    <label for="">Product Image</label><br>
                                    <img src="{{URL('storage')}}/{{$product->image}}" alt="product Image"  width="100" name="pic">
                                    <input type="hidden" name="pic" class="old_image" value="{{$product->image}}">
                                </div>
                            </div>
                            <div class="form-group col-md-12 input_image">
                                <div class=" mt-4 ">
                                    <label for="">Product Image</label><br>
                                    <input type="file" class="dropify new_image" data-height="200"
                                        accept="image/x-png,image/gif,image/jpeg"  />
                                        
                                </div>
                            </div>
                            <div class="form-group col-md-12 ">
                                <div class=" mt-4 ">
                                    <a class="btn btn-info-gradient text-white hide_image" >Change Image</a>
                                </div>
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end col-md-12">
                                <div>
                                    <button type="submit" class="btn btn-primary" >update</button>
                                    <a href="/products" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                        </div>
                    </form>
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
    <!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>

    <script>
        
        
         
         $('.input_image').hide();
         $('.hide_image').click(function(){
             $('.input_image').toggle([0.2]);
             $('.file_image').toggle([0.2]);
             if($('.new_image').attr('name')=='pic'){
                     $('.new_image').removeAttr('name');
                     $('.old_image').attr('name','pic');
                     $('.hide_image').text('old Image');
                    }
                    else if($('.new_image').attr('name')!='pic'){
                    $('.hide_image').text('Change Image');
                    $('.old_image').removeAttr('name');
                     $('.new_image').attr('name','pic');
                 }
        
           
       
        });
       


    </script>
@endsection
