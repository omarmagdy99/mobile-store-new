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
                        action="/usersList/update">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <div class="row">


                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="f_name" placeholder="First Name" value="{{$user_data->f_name}}">
                                <input type="hidden" name="id" value="{{$user_data->id}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="l_name" placeholder="Last Name" value="{{$user_data->l_name}}">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="email" class="form-control" name="email" placeholder="Email " value="{{$user_data->email}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="Password" >
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Password" >
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{$user_data->phone}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="s_phone" placeholder="Phone 2" value="{{$user_data->s_phone}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="national_id" placeholder="National ID" value="{{$user_data->national_id}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="address" placeholder="Address" value="{{$user_data->address}}">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="">
                                    <label for="">Gender</label><br>
                                    <div class="d-flex">
                                        @if($user_data->gender=='male')
                                        <label class="rdiobox mr-3"><input name="gender" type="radio" value="male" checked>
                                            <span>Male</span>
                                        </label>
                                        <label class="rdiobox"><input name="gender" type="radio" value="female">
                                            <span>Female</span>
                                        </label>
                                        @else
                                        <label class="rdiobox mr-3"><input name="gender" type="radio" value="male" >
                                            <span>Male</span>
                                        </label>
                                        <label class="rdiobox"><input name="gender" type="radio" value="female" checked>
                                            <span>Female</span>
                                        </label>

                                        @endif
                                       

                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="">
                                    <label for="">Permission</label><br>
                                    <div class="d-flex">
                                        @if($user_data->permission=='admin')

                                        <label class="rdiobox mr-3"><input name="permission" type="radio" value="admin" checked>
                                            <span>Admin</span>
                                        </label>
                                        <label class="rdiobox"><input name="permission" type="radio" value="user">
                                            <span>User</span>
                                        </label>
                                        @else
                                        <label class="rdiobox mr-3"><input name="permission" type="radio" value="admin">
                                            <span>Admin</span>
                                        </label>
                                        <label class="rdiobox"><input name="permission" type="radio" value="user" checked>
                                            <span>User</span>
                                        </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 file_image">
                                <div class=" mt-4 ">
                                    <label for="">Product Image</label><br>
                                    <img src="{{URL('storage')}}/{{$user_data->image}}" alt="product Image"  width="100" name="pic">
                                    <input type="hidden" name="pic" class="old_image" value="{{$user_data->image}}">
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
                                    <button type="submit" class="btn btn-primary">update</button>
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
