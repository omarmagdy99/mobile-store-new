@extends('layouts.app')

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
                <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Add New
                    User</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $item)

            <div class="alert alert-danger" role="alert">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Opps!</strong> {{ $item }}
            </div>
        @endforeach

    @endif
    @if (session()->has('add'))
        <script>
            window.location = '/usersList';
        </script>


    @endif
    <!-- row -->
    <div class="row">
        <div class=" col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h2 class="card-title mb-1">Add New User</h2>
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                        action="{{ route('usersList.store') }}">
                        {{ csrf_field() }}
                        <div class="row">


                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="First Name">
                            </div>

                            <div class="form-group col-md-12">
                                <input type="email" class="form-control" name="email" placeholder="Email ">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Password">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="phone" placeholder="Phone">
                            </div>


                            <div class="form-group col-md-6">
                                <div class="">
                                    <label for="">Gender</label><br>
                                    <div class="d-flex">
                                        <label class="rdiobox mr-3"><input name="gender" type="radio" value="male">
                                            <span>Male</span>
                                        </label>
                                        <label class="rdiobox"><input name="gender" type="radio" value="female">
                                            <span>Female</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="">
                                    <label for="">Permission</label><br>
                                    <div class="d-flex">
                                        <label class="rdiobox mr-3"><input name="permission" type="radio" value="admin">
                                            <span>Admin</span>
                                        </label>
                                        <label class="rdiobox"><input name="permission" type="radio" value="user">
                                            <span>User</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="">
                                    <label for="">Image</label><br>
                                    <input type="file" class="dropify" data-height="200"
                                        accept="image/x-png,image/gif,image/jpeg" name="pic" />
                                </div>
                            </div>

                            <div class="form-group mb-0 mt-3 justify-content-end col-md-12">
                                <div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href="/usersList" class="btn btn-secondary">Cancel</a>
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
