@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
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
                Purchases</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

@if ($errors->any())
<script>
    window.location = '/addProducts';
</script>
@endif
<!--Row-->
<div class="row row-sm">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"> purchases invoices TABLE</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <a href="/Addpurchases" class="btn btn-primary my-2">Add Invoice</a>
            </div>
            <div class="card-body">
                <div class="table-responsive border-top userlist-table">

                    {{-- الجدول الذي تعرض فيه البيانات --}}
                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th class="border-bottom-0" style="width: 2%">#</th>
                                <th class="border-bottom-0" style="width: 2%">invoice number</th>
                                <th class="wd-lg-20p">Sub Total</th>
                                <th class="wd-lg-20p">Date</th>

                                <th class="wd-lg-20p">note</th>
                                <th class="wd-lg-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- purchases الجزء مسئول عن عرض المعلومات الخاصه ب --}}
                            @php
                            $i=1;
                            @endphp
                            @foreach ($purchases_invoice as $purchases)

                            <tr>
                                <td>@php
                                    echo $i++;
                                    @endphp</td>
                                <td>{{ $purchases->id }}</td>
                                <td>{{ $purchases->sub_total }}</td>
                                <td>{{ $purchases->created_at }}</td>

                                <td>{{ $purchases->notes }}</td>
                                <td>
                                    {{-- زرار لعرض التفاصيل   --}}
                                    <a href="/purchasesDetails/{{ $purchases->id }}" class="btn btn-sm btn-primary">
                                        <i class="las la-search"></i>
                                    </a>
                                    {{-- زرار لعرض التفاصيل   --}}




                                    {{-- update زرار ال  --}}
                                    <a href="/purchasesShowUpdate/{{ $purchases->id }}" class="btn btn-sm btn-info">
                                        <i class="las la-pen"></i>
                                    </a>
                                    {{-- update زرار ال  --}}



                                    {{-- delete زرار ال  --}}
                                    <a class="modal-effect btn btn-sm btn-danger btn_delete"
                                        data-effect="effect-slide-in-bottom" data-toggle="modal" href="#modaldemo7"
                                        title="Delete" data-invoice_number="{{ $purchases->id }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                    {{-- delete زرار ال  --}}
                                </td>
                            </tr>
                            @endforeach
                            {{-- purchases الجزء مسئول عن عرض المعلومات الخاصه ب --}}


                        </tbody>
                    </table>
                    {{-- الجدول الذي تعرض فيه البيانات --}}



                </div>
                <ul class="pagination mt-4 mb-0 float-left">
                    <li class="page-item page-prev disabled">
                        <a class="page-link" href="#" tabindex="-1">Prev</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item page-next">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- COL END -->
</div>
<!-- row closed  -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->

</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
{{-- model delete --}}
{{-- purchases عن مسح ال model --}}
<div class="modal" id="modaldemo7">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title text-danger">Delete Purchases Invoice</h6><button aria-label="Close"
                    class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="purchases/destroy" method="POST">
                {{ csrf_field() }}

                {{ method_field('delete') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">invoice number</label>
                        <input type="text" name="id" readonly class="form-control" id="d_invoice_id"
                            placeholder="invoice name">
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
{{-- purchases عن مسح ال model --}}
{{-- model delete --}}


@endsection
@section('js')
<script>
    //    modal لوضع البيانات في ال  delete الجزء المسئول عن زر

    $('.btn_delete').click(function() {
            $invoice_number = $(this).data('invoice_number');


            $('#d_invoice_id').val($invoice_number);
            alert($product_name)

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

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>





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
