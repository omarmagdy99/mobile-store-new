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
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Brands</span>
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
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="row row-sm">
                        <div class="col-md-4 ">
                            <a class="modal-effect btn btn-outline-primary btn-block wd-40p" data-effect="effect-scale"
                                data-toggle="modal" href="#modaldemo8">Add Brand</a>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h4 class="card-title mg-b-0">Brands List</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap ">
                            <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-5p border-bottom-0">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($brand_data as $item)

                                    <?php $i++; ?>

                                    <tr>

                                        <td><?php echo $i; ?></td>
                                        <td>{{ $item->brand_name }}</td>
                                        <td>

                                            <a class="modal-effect btn btn-sm btn-info btn_update"
                                                data-effect="effect-scale" data-toggle="modal" href="#modaldemo6"
                                                data-brand_name="{{ $item->brand_name }}" data-id="{{ $item->id }}"
                                                title="Update"><i class="las la-pen fa-2x"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger btn_delete"
                                                data-effect="effect-slide-in-bottom" data-toggle="modal" href="#modaldemo7"
                                                data-brand_name="{{ $item->brand_name }}" data-id="{{ $item->id }}"
                                                title="Delete"><i class="las la-trash fa-2x"></i>
                                            </a>

                                        </td>


                                    </tr>
                                @endforeach
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
    {{-- add model --}}
    <!-- Modal effects -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title">Add Brand</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('brands.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="brand_name" id="inputName" placeholder="Name">
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
    {{-- model Update --}}
    <div class="modal" id="modaldemo6">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title text-info">Update brand</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="brands/update" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="brand_name" id="u_brand_name" placeholder="Name">
                            <input type="hidden" class="form-control" name="brand_id" id="u_brand_id" placeholder="Name">
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
                    <h6 class="modal-title text-danger">Delete brand</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="brands/destroy" method="POST">
                    {{ csrf_field() }}

                    {{ method_field('delete') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" disabled class="form-control" name="brand_name" id="d_brand_name"
                                placeholder="Name">
                            <input type="hidden" class="form-control" name="brand_id" id="d_brand_id" placeholder="Name">
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
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>


    <script>
        $('.btn_delete').click(function() {
            $brand_name = $(this).data('brand_name');
            $id = $(this).data('id');
            $('#d_brand_id').val($id);
            $('#d_brand_name').val($brand_name);


        });
        $('.btn_update').click(function() {
            $brand_name = $(this).data('brand_name');
            $id = $(this).data('id');
            $('#u_brand_id').val($id);
            $('#u_brand_name').val($brand_name);


        });

        function not9() {
            notif({
                type: "info",
                msg: "<b>Updated:</b>successfully",
                position: "right"
            });
        }
        @if (session()->has('update'))
            $(document).ready(function () {
            not9();
        
            });
        @endif


        function not10() {
            notif({
                type: "success",
                msg: "<b>Added:</b>successfully",
                position: "center"
            });
        }
        @if (session()->has('add'))
            $(document).ready(function () {
            not10();
        
            });
        @endif

        function not11() {
            notif({
                type: "error",
                msg: "<b>Deleted: </b>Successfully",
                position: "center",
            });
        }
        @if (session()->has('delete'))
            $(document).ready(function () {
            not11();
        
            });
        @endif

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
