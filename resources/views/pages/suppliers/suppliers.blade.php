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
                        <table id="example" class="table key-buttons text-md-nowrap ">
                            <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">Phone</th>
                                    <th class="wd-15p border-bottom-0">Company Name</th>
                                    <th class="wd-15p border-bottom-0">National ID</th>
                                    <th class="wd-5p border-bottom-0">Operation</th>
                                </tr>
                            </thead>
                            <tbody>


                                <tr>
                                    <td>1</td>
                                    <td>Harry</td>
                                    <td>0123456</td>
                                    <td>0123456</td>
                                    <td>0123456</td>
                                    <td>

                                        <a class="modal-effect btn btn-sm btn-info " data-effect="effect-scale"
                                            data-toggle="modal" href="#modaldemo6" title="تعديل"><i
                                                class="las la-pen fa-2x"></i></a>

                                        <a class="modal-effect btn btn-sm btn-danger " data-effect="effect-scale"
                                            data-toggle="modal" href="#modaldemo7" title="حذف"><i
                                                class="las la-trash fa-2x"></i>
                                        </a>

                                    </td>


                                </tr>
                            </tbody>
                        </table>
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
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title">Add Supplier</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="f_name" id="" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="l_name" id="" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="company_name" id="" placeholder="Company Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" id="" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="s_phone" id="" placeholder="Phone 2">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="national_id" id="" placeholder="National ID">
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
    <!-- End Modal effects-->
    {{-- model Update --}}
    <div class="modal" id="modaldemo6">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title text-info">Update Supplier</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="" id="" placeholder="First Name">
                            <input type="hidden" class="form-control" name="" id="" placeholder="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="" id="" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="" id="" placeholder="Company Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="" id="" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="" id="" placeholder="Phone 2">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="" id="" placeholder="Company Name">
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
    <!-- End Modal effects-->
    {{-- model delete --}}
    <div class="modal" id="modaldemo7">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title text-danger">Delete Supplier</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="" method="POST">
                    {{ csrf_field() }}

                    {{ method_field('') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" disabled class="form-control" name="" id="" placeholder="Name">
                            <input type="text" class="form-control" name="" id="" placeholder="id">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="" id="" placeholder="Company Name">
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
@endsection
@section('js')
    <script>
        // $('.btn_delete').click(function() {
        //     $brand_name = $(this).data('brand_name');
        //     $id = $(this).data('id');
        //     $('#d_brand_id').val($id);
        //     $('#d_brand_name').val($brand_name);


        // });
        // $('.btn_update').click(function() {
        //     $brand_name = $(this).data('brand_name');
        //     $id = $(this).data('id');
        //     $('#u_brand_id').val($id);
        //     $('#u_brand_name').val($brand_name);


        // });

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
@endsection
