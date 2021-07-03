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
            <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Add New
                User</span>
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
                {{-- form خاصه بالأضافه  --}}
                <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                    action="{{ route('usersList.store') }}">
                    {{ csrf_field() }}
                    <div class="row">


                        <div class="form-group col-md-6">
                            {{-- name --}}
                            <input type="text" class="form-control" name="name" placeholder="Name">
                            {{-- name --}}
                        </div>

                        <div class="form-group col-md-12">
                            {{-- email --}}
                            <input type="email" class="form-control" name="email" placeholder="Email ">
                            {{-- email --}}
                        </div>
                        <div class="form-group col-md-6">
                            {{-- password --}}
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            {{-- password --}}
                        </div>
                        <div class="form-group col-md-6">
                            {{--confirm password --}}
                            <input type="password" class="form-control" name="password_confirmation"
                                {{--confirm password --}} placeholder="Confirm Password">
                        </div>
                        <div class="form-group col-md-6">
                            {{-- phone --}}
                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                            {{-- phone --}}
                        </div>


                        <div class="form-group col-md-6">
                            <div class="">
                                {{-- gender --}}
                                <label for="">Gender</label><br>
                                <div class="d-flex">
                                    <label class="rdiobox mr-3"><input name="gender" type="radio" value="male">
                                        <span>Male</span>
                                    </label>
                                    <label class="rdiobox"><input name="gender" type="radio" value="female">
                                        <span>Female</span>
                                    </label>
                                </div>
                                {{-- gender --}}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="">
                                {{-- permission --}}
                                <label for="">Permission</label><br>
                                <div class="d-flex">
                                    <label class="rdiobox mr-3"><input name="permission" type="radio" value="admin">
                                        <span>Admin</span>
                                    </label>
                                    <label class="rdiobox"><input name="permission" type="radio" value="user">
                                        <span>User</span>
                                    </label>
                                </div>
                                {{-- permission --}}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            {{-- image --}}
                            <div class="">
                                <label for="">Image</label><br>
                                <input type="file" class="dropify" data-height="200"
                                accept="image/x-png,image/gif,image/jpeg" name="pic" />
                            </div>
                            {{-- image --}}
                        </div>

                        <div class="form-group mb-0 mt-3 justify-content-end col-md-12">
                            <div>
                                    {{-- زرار الخاص بالإضافة --}}

                                    <button type="submit" class="btn btn-primary">Add</button>
                                    {{-- زرار الخاص بالإضافة --}}

                                    {{-- زرار الخاص بإلغاء الأضافة --}}
                                <a href="/usersList" class="btn btn-secondary">Cancel</a>
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
