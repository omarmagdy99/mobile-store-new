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
                <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Add Products</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class=" col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h2 class="card-title mb-1">Add Product</h2>
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="inputName" placeholder="Barcode">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="inputName" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                               
                                <select name="somename" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option disabled selected>Choose Category</option>
                                    <option title="Volvo is a car" value="volvo">Volvo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                               
                                <select name="somename" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option disabled selected>Choose Brand</option>
                                    <option title="Volvo is a car" value="volvo">Volvo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" id="inputName" placeholder="Sales Price">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" id="inputName" placeholder="Purchase Price">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" id="inputName" placeholder="Quantity">
                            </div>
                            <div class="form-group col-md-12">
                                <div class=" mt-4 ">
                                    <label for="">Product Image</label><br>
                                    <input type="file" class="dropify" data-height="200"
                                        accept="image/x-png,image/gif,image/jpeg" name="pic" />
                                </div>
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
