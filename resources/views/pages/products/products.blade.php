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
                    Products</span>
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
                    <a class="btn btn-outline-primary btn-block wd-15p" href="/addProducts">Add Product</a>
                    <div class="mt-3">
                        <h4 class="card-title mg-b-0">Product List</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive ">
                    {{-- الجدول الذي تعرض فيه البيانات --}}
                        <table id="example" class="table card-table  key-buttons text-md-nowrap ">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" style="width: 1%">Barcode</th>
                                    <th class="wd-lg-5p border-bottom-0">Name</th>
                                    <th class="wd-lg-5p border-bottom-0">Sale Price</th>

                                    <th class="wd-lg-5p border-bottom-0">Quantity</th>
                                    <th class="wd-lg-5p border-bottom-0">Operations</th>
                                    <th class="wd-lg-5p border-bottom-0">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- product الجزء مسئول عن عرض المعلومات الخاصه ب --}}
                                @foreach ($product_data as $item)

                                    <tr>

                                        <td>{{ $item->barcode }}</td>
                                        <td>{{ $item->product_name }} {{ $item->brand_name }} </td>
                                        <td>{{ $item->sale_price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>

                                            {{-- update زرار ال  --}}
                                            <a class=" btn btn-sm btn-info " href="/editProducts/{{ $item->barcode }}"
                                                title="تعديل"><i class="las la-pen fa-2x"></i></a>
                                    {{-- update زرار ال  --}}

                                    {{-- delete زرار ال  --}}
                                            <a class="modal-effect btn btn-sm btn-danger btn_delete"
                                                data-effect="effect-slide-in-bottom" data-toggle="modal" href="#modaldemo7"
                                                data-product_name="{{ $item->product_name }}"
                                                data-product_barcode="{{ $item->barcode }}"
                                                data-product_pic="{{ $item->image }}" data-id="{{ $item->id }}"
                                                title="Delete"><i class="las la-trash fa-2x"></i>
                                            </a>
                                    {{-- delete زرار ال  --}}

                                        </td>
                                        <td>
                                            {{-- عرض صورة المنتج --}}
                                            <img src="storage/{{ $item->image }}" alt="product Image" width="50">
                                            {{-- عرض صورة المنتج  --}}
                                        </td>



                                    </tr>
                                @endforeach
                            {{-- product الجزء مسئول عن عرض المعلومات الخاصه ب --}}
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
    {{-- model delete --}}
{{--product مسئوله عن مسح ال model --}}
    <div class="modal" id="modaldemo7">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title text-danger">Delete brand</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="products/destroy" method="POST">
                    {{ csrf_field() }}

                    {{ method_field('delete') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product_id" id="d_product_id"
                                placeholder="Name">
                            <input type="text" disabled class="form-control" id="d_product_barcode" placeholder="barcode">
                        </div>
                        <div class="form-group">
                            <input type="text" disabled class="form-control" id="d_product_name" placeholder="Name">
                            <input type="hidden" class="form-control" name="pic" id="d_product_pic" placeholder="Name">
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
{{--product مسئوله عن مسح ال model --}}


@endsection
@section('js')


    <script>
    //    modal لوضع البيانات في ال  delete الجزء المسئول عن زر
        $('.btn_delete').click(function() {
            $product_name = $(this).data('product_name');
            $product_barcode = $(this).data('product_barcode');
            $product_pic = $(this).data('product_pic');
            $id = $(this).data('id');
            $('#d_product_id').val($id);
            $('#d_product_name').val($product_name);
            $('#d_product_barcode').val($product_barcode);
            $('#d_product_pic').val($product_pic);


        });
    //    modal لوضع البيانات في ال  delete الجزء المسئول عن زر



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
