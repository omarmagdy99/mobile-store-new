@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet" />
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Customers</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

<!-- row -->

<div class="row">

    {{-- error إذا كان يوجد  alert الجزء الخاص ب --}}
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
    {{-- error إذا كان يوجد  alert الجزء الخاص ب --}}



    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="row row-sm">
                    <div class="col-md-4 ">
                        <a class="modal-effect btn btn-outline-primary btn-block wd-40p" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">Add Customer</a>

                    </div>
                </div>
                <div class="mt-3">
                    <h4 class="card-title mg-b-0">Customers List</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{-- الجدول الذي تعرض فيه البيانات --}}
                    <table id="example" class="table key-buttons text-md-nowrap ">
                        <thead>
                            <tr>
                                <th class=" border-bottom-0" style="width: 2%">#</th>
                                <th class="wd-10p border-bottom-0">Name</th>
                                <th class="wd-10p border-bottom-0">Phone</th>
                                <th class="wd-10p border-bottom-0">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- customer الجزء مسئول عن عرض المعلومات الخاصه ب --}}
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($customer_data as $item)
                            <tr>
                                <td>
                                    @php
                                    echo $i++;
                                    @endphp
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    {{-- update زرار ال  --}}

                                    <a class="modal-effect btn btn-sm btn-info btn_update" data-effect="effect-scale"
                                        data-toggle="modal" href="#exampleModal2" title="تعديل"
                                        data-c_id="{{ $item->id }}" data-c_name="{{ $item->name }}"
                                        data-c_phone="{{ $item->phone }}"><i class="las la-pen fa-2x"></i></a>
                                    {{-- update زرار ال  --}}

                                    {{-- delete زرار ال  --}}
                                    <a class="modal-effect btn btn-sm btn-danger btn_delete" data-effect="effect-scale"
                                        data-toggle="modal" href="#modaldemo7" title="حذف" data-c_id="{{ $item->id }}"
                                        data-c_name="{{ $item->name }}"><i class="las la-trash fa-2x"></i>
                                    </a>
                                    {{--  deleteزرار ال  --}}

                                </td>


                            </tr>
                            @endforeach
                            {{-- customer الجزء مسئول عن عرض المعلومات الخاصه ب --}}

                        </tbody>
                    </table>
                    {{-- الجدول الذي تعرض فيه البيانات --}}

                </div>
            </div>
        </div>
    </div>
    <!--/div-->


</div>
<!-- row closed -->
</div>
<!-- Container closed -->

</div>

<!-- Modal add -->
{{-- customerمسئوله عن إضافة ال model --}}
<div class="modal" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">Add Customer</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('customers.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Phone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">Add</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- customerمسئوله عن إضافة ال model --}}
<!-- End Modal add-->

<!-- Modal update -->
{{-- customerمسئوله عن تعديل ال model --}}
<div class="modal" id="exampleModal2">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">Update Customer</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="/customers/update" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="c_uname" name="name" placeholder="Name">
                        <input type="hidden" class="form-control" name="id" id="c_uid" placeholder="id">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" id="c_uphone" placeholder="Phone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">Update</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- customerمسئوله عن تعديل ال model --}}
<!-- End Modal update-->



{{-- model delete --}}
{{-- customerمسئوله عن المسح ال model --}}
<div class="modal" id="modaldemo7">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title text-danger">Delete Customer</h6><button aria-label="Close" class="close"
                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="customers/destroy" method="POST">
                {{ csrf_field() }}

                {{ method_field('delete') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" disabled class="form-control" id="c_name" placeholder="Name">
                        <input type="hidden" class="form-control" name="id" id="c_id" placeholder="id">
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
{{-- customerمسئوله عن المسح ال model --}}
{{-- end model delete --}}



@endsection

@section('js')


<script>
        //    modal لوضع البيانات في ال  delete الجزء المسئول عن زر
        $('.btn_delete').click(function() {
            $c_name = $(this).data('c_name');
            $id = $(this).data('c_id');
            $('#c_id').val($id);
            $('#c_name').val($c_name);
        });
        //    modal لوضع البيانات في ال  delete الجزء المسئول عن زر



        //    modal لوضع البيانات في ال  update الجزء المسئول عن زر
        $('.btn_update').click(function() {
            $c_uname = $(this).data('c_name');
            $c_uphome = $(this).data('c_phone');
            $u_id = $(this).data('c_id');
            $('#c_uid').val($u_id);
            $('#c_uname').val($c_uname);
            $('#c_uphone').val($c_uphome);
        });
        //    modal لوضع البيانات في ال  update الجزء المسئول عن زر



        
}
</script>
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
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
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
