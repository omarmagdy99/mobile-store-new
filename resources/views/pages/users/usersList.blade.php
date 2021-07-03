@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!--Internal  Font Awesome -->
<link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
<!--Internal  treeview -->
<link href="{{ URL::asset('assets/plugins/treeview/treeview.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Users
                List</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
{{-- هذا الجزء خاص إذا كان هناك خطا --}}
@if ($errors->any())
<script>
    window.location = '/addUsers';
</script>
@endif
{{-- هذا الجزء خاص إذا كان هناك خطا --}}


<!-- row -->
<div class="row">
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">

                <div class="mt-3">
                    <h4 class="card-title mg-b-0">Users List</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{-- الجدول الذي تعرض فيه البيانات --}}
                    <table id="example" class="table key-buttons  text-md-nowrap ">
                        <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">#</th>
                                <th class="wd-10p border-bottom-0">Name</th>
                                <th class="wd-10p border-bottom-0">Email</th>
                                <th class="wd-10p border-bottom-0">Phone</th>
                                <th class="wd-10p border-bottom-0">Operations</th>
                                <th class="wd-10p border-bottom-0">Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- user الجزء مسئول عن عرض المعلومات الخاصه ب --}}
                            @php $i=1; @endphp
                            @foreach ($user_data as $item)

                            <tr>
                                <td>@php echo $i++; @endphp</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>

                                    {{-- update زرار ال  --}}
                                    <a class=" btn btn-sm btn-info " href="/updateUser/{{ $item->id }}" title="تعديل"><i
                                            class="las la-pen fa-2x"></i></a>

                                    {{-- update زرار ال  --}}


                                    {{-- delete زرار ال  --}}
                                    <a class="modal-effect btn btn-sm btn-danger btn_delete"
                                        data-effect="effect-slide-in-bottom" data-toggle="modal" href="#modaldemo7"
                                        data-user_name="{{ $item->name }}" data-user_email="{{ $item->email }}"
                                        data-user_pic="{{ $item->image }}" data-id="{{ $item->id }}" title="Delete"><i
                                            class="las la-trash fa-2x"></i>
                                    </a>
                                    {{-- delete زرار ال  --}}

                                </td>
                                <td>
                                    {{-- image --}}
                                    <img src="{{ URL('storage') }}/{{ $item->image }}"
                                    class="rounded-circle avatar-md mr-2" width="120" alt="">
                                    {{-- image --}}
                                </td>



                            </tr>
                            @endforeach
                            {{-- user الجزء مسئول عن عرض المعلومات الخاصه ب --}}
                        </tbody>
                    </table>
                    {{-- الجدول الذي تعرض فيه البيانات --}}
                </div>
            </div>
        </div>
    </div>
    <!--/div-->

</div>

 {{-- model delete --}}
{{--user مسئوله عن مسح ال model --}}
<div class="modal" id="modaldemo7">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title text-danger">Delete user</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="usersList/destroy" method="POST">
                {{ csrf_field() }}

                {{ method_field('delete') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">email</label>
                        <input type="text" disabled class="form-control" id="u_user_email" placeholder="email">
                        <input type="hidden" class="form-control" name="user_id" id="u_user_id" placeholder="id">
                    </div>
                    <div class="form-group">
                        <label for=""> name</label>
                        <input type="text" disabled class="form-control" id="u_name" placeholder="Name">
                        <input type="hidden" class="form-control" name="pic" id="u_user_pic" placeholder="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary bg-danger" type="submit">Delete</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--user مسئوله عن مسح ال model --}}
{{-- model delete --}}


@endsection
@section('js')
<script>
    //    modal لوضع البيانات في ال  delete الجزء المسئول عن زر

    $('.btn_delete').click(function() {
            $user_email = $(this).data('user_email');
            $user_name = $(this).data('user_name');
            $user_pic = $(this).data('user_pic');
            $id = $(this).data('id');
            $('#u_user_id').val($id);
            $('#u_user_email').val($user_email);
            $('#u_name').val($user_name);
            $('#u_user_pic').val($user_pic);
        });
    //    modal لوضع البيانات في ال  delete الجزء المسئول عن زر

</script>

<!-- Internal Modal js-->

<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>


<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

       {{-- delete لل  Notification الجزء الخاص ب --}}
@if (session()->has('delete'))

<script>
    notif({
        msg: "<b>Success:</b> deleted successfully",
        type: "success"
    });
</script>
@endif
{{-- delete لل  Notification الجزء الخاص ب --}}




{{-- update لل  Notification الجزء الخاص ب --}}
@if (session()->has('update'))
<script>
    notif({
          msg: "<b>Success:</b> updated successfully",
          type: "info"
        });
</script>

@endif
{{-- update لل  Notification الجزء الخاص ب --}}



{{-- add لل  Notification الجزء الخاص ب --}}

@if (session()->has('add'))

<script>
    notif({
        msg: "<b>Success:</b> Added successfully",
        type: "success"
    });
</script>

@endif
{{-- add لل  Notification الجزء الخاص ب --}}



@endsection


