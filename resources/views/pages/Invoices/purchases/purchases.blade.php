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
@if (session()->has('add'))
<div class="alert alert-success" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Well done!</strong> {{ session()->get('add') }}
</div>


@endif
<div class="row" style="flex-direction: column">


    <!--Row-->
    <div class="row row-sm ">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">

                <div class="card-header pb-0">
                    <a class="btn btn-outline-primary btn-block wd-15p my-3" href="Addpurchases">Add invoice</a>
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Purchases invoice</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-lg-8p"><span>#</span></th>
                                    <th class="wd-lg-8p"><span>id</span></th>
                                    <th class="wd-lg-20p"><span>Sub Total</span></th>
                                    <th class="wd-lg-20p"><span>Date</span></th>


                                    <th class="wd-lg-20p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp

                                @foreach ($purchases_invoice as $purchases)

                                <tr>

                                    <td>@php
                                        echo $i++;
                                        @endphp</td>
                                    <td>{{$purchases->id}}</td>
                                    <td>{{$purchases->sub_total}}</td>
                                    <td>{{$purchases->created_at}}</td>
                                    <td>
                                        <a href="purchasesDetails/{{$purchases->id}}" class="btn btn-sm btn-primary">
                                            <i class="las la-search"></i>
                                        </a>
                                        <a href="purchasesShowUpdate/{{$purchases->id}}" class="btn btn-sm btn-info">
                                            <i class="las la-pen"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger btn_delete modal-effect"
                                            data-effect="effect-sign" data-toggle="modal" href="#modaldemo8"
                                            data-id="{{$purchases->id}}">
                                            <i class="las la-trash"></i>
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
    </div>
</div><!-- COL END -->
<!-- row closed  -->


{{-- model delete --}}
<div class="modal" id="modaldemo8">
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
                        <input type="text" class="form-control d_invoice_id" placeholder="invoice number" disabled>
                        <input type="hidden" readonly class="form-control d_invoice_id" name="id"
                            placeholder="invoice number">
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
</div>



@endsection
@section('js')
<script>
    $('.btn_delete').click(function() {

            $id = $(this).data('id');
            $('.d_invoice_id').val($id);


        });


</script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
@if (session()->has('delete'))

<script>
    notif({
    msg: "<b>Success:</b> deleted successfully",
    type: "success"
});
</script>
@endif
@if (session()->has('update'))

<script>
    notif({
    msg: "<b>Success:</b> updated successfully",
    type: "info"
});
</script>

@endif

@endsection
