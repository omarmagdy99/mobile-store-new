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
                <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Suppliers</span>
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
                                data-toggle="modal" href="#modaldemo8">Add Supplier</a>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h4 class="card-title mg-b-0">Suppliers List</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- الجدول الذي تعرض فيه البيانات --}}
                        <table id="example" class="table key-buttons text-md-nowrap ">
                            <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-10p border-bottom-0">Name</th>
                                    <th class="wd-10p border-bottom-0">Phone</th>
                                    <th class="wd-10p border-bottom-0">Company Name</th>

                                    <th class="wd-5p border-bottom-0">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                {{-- customer الجزء مسئول عن عرض المعلومات الخاصه ب --}}
                                @foreach ($suppliers_data as $supplier_data)

                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>{{ $supplier_data->name }}</td>
                                        <td>{{ $supplier_data->phone }}</td>
                                        <td>{{ $supplier_data->company_name }}</td>

                                        <td>
                                            {{-- update زرار ال --}}

                                            <a class="modal-effect btn btn-sm btn-info btn_update"
                                                data-effect="effect-scale" data-toggle="modal" href="#modaldemo6"
                                                title="Update" data-id="{{ $supplier_data->id }}"
                                                data-name="{{ $supplier_data->name }} "
                                                data-s_company="{{ $supplier_data->company_name }}"
                                                data-phone="{{ $supplier_data->phone }}"><i
                                                    class="las la-pen fa-2x"></i></a>
                                            {{-- update زرار ال --}}


                                            {{-- delete زرار ال --}}

                                            <a class="modal-effect btn btn-sm btn-danger btn_delete"
                                                data-effect="effect-scale" data-toggle="modal" href="#modaldemo7"
                                                data-id="{{ $supplier_data->id }}"
                                                data-s_name="{{ $supplier_data->name }}"
                                                data-s_company="{{ $supplier_data->company_name }}" title="Delete"><i
                                                    class="las la-trash fa-2x"></i>
                                            </a>
                                            {{-- delete زرار ال --}}

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
    <!--Add Modal effects -->
    {{-- customerمسئوله عن إضافة ال model --}}
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title">Add Supplier</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('suppliers.store') }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group" method="post" action="">
                            <input type="text" class="form-control" name="name" id="" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="company_name" id="" placeholder="Company Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" id="" placeholder="Phone">
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
    <!-- End Modal effects-->


    {{-- model Update --}}
    {{-- customerمسئوله عن تعديل ال model --}}
    <div class="modal" id="modaldemo6">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title text-info">Update Supplier</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="suppliers/update" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">

                            <input type="text" class="form-control" name="name" id="s_name" placeholder="Name">
                            <input type="hidden" class="form-control" name="id" id="s_uid" placeholder="id">
                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control" name="company_name" id="s_ucompany"
                                placeholder="Company Name">
                        </div>
                        <div class="form-group">

                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary bg-info" type="submit">Update</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- customerمسئوله عن تعديل ال model --}}
    <!-- End Modal effects-->



    {{-- model delete --}}
    {{-- customerمسئوله عن المسح ال model --}}
    <div class="modal" id="modaldemo7">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title text-danger">Delete Supplier</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="suppliers/destroy" method="POST">
                    {{ csrf_field() }}

                    {{ method_field('delete') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" disabled class="form-control" id="s_name" placeholder="Name">
                            <input type="hidden" class="form-control" name="id" id="s_id" placeholder="id">
                        </div>
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <input type="text" disabled class="form-control" id="s_company" placeholder="Company Name">
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
@endsection
@section('js')
    <script>
        //    modal لوضع البيانات في ال  delete الجزء المسئول عن زر
        $('.btn_delete').click(function() {
            $s_name = $(this).data('s_name');
            $s_company = $(this).data('s_company');
            $id = $(this).data('id');
            $('#s_id').val($id);
            $('#s_name').val($s_name);
            $('#s_company').val($s_company);
        });
        //    modal لوضع البيانات في ال  delete الجزء المسئول عن زر



        //    modal لوضع البيانات في ال  update الجزء المسئول عن زر
        $('.btn_update').click(function() {
            $id = $(this).data('id');

            $name = $(this).data('name');
            $phone = $(this).data('phone');

            $s_company = $(this).data('s_company');
            $('#s_uid').val($id);
            $('#s_name').val($name);
            $('#s_ucompany').val($s_company);
            $('#phone').val($phone);


        });
        //    modal لوضع البيانات في ال  update الجزء المسئول عن زر
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
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

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
