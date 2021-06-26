@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

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
@if (session()->has('delete'))

<div class="alert alert-danger" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Well done!</strong> {{ session()->get('delete') }}
</div>

@endif
<div class="row">

    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <a class="btn btn-outline-primary btn-block wd-15p" href="Addpurchases">Add invoice</a>


                <div class="mt-3">
                    <h4 class="card-title mg-b-0">Purchases Invoices List</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap ">
                        <thead>
                            <tr>
                                <th class="border-bottom-0" style="width: 2%">id</th>
                                <th class="wd-5p border-bottom-0">Sub Total</th>
                                <th class="wd-15p border-bottom-0">Date</th>
                                <th class="wd-15p border-bottom-0">Suppiler Name</th>
                                <th class="wd-15p border-bottom-0">User Name</th>
                                <th class="wd-15p border-bottom-0">note</th>
                                <th class="wd-10p border-bottom-0">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases_invoice as $purchases)

                            <tr>

                                <td>{{$purchases->id}}</td>
                                <td>{{$purchases->sub_total}}</td>
                                <td>{{$purchases->created_at}}</td>
                                <td>{{$purchases->supplier_id}}</td>
                                <td>{{$purchases->user_id}}</td>
                                <td>{{$purchases->notes}}</td>

                                <td>

                                    <a class="modal-effect btn btn-sm btn-info " data-effect="effect-scale"
                                        data-toggle="modal" href="#exampleModal2" title="تعديل"><i
                                            class="las la-pen fa-2x"></i></a>

                                    <a class="modal-effect btn btn-sm btn-danger btn_delete"
                                        data-effect="effect-slide-in-bottom" data-toggle="modal" href="#modaldemo7"
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

				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">USERS TABLE</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">
								<div class="table-responsive border-top userlist-table">
									<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
										<thead>
											<tr>
												<th class="wd-lg-8p"><span>User</span></th>
												<th class="wd-lg-20p"><span></span></th>
												<th class="wd-lg-20p"><span>Created</span></th>
												<th class="wd-lg-20p"><span>Status</span></th>
												<th class="wd-lg-20p"><span>Email</span></th>
												<th class="wd-lg-20p">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<img alt="avatar" class="rounded-circle avatar-md mr-2" src="{{URL::asset('assets/img/faces/1.jpg')}}">
												</td>
												<td>Megan Peters</td>
												<td>
													08/06/2020
												</td>
												<td class="text-center">
													<span class="label text-muted d-flex"><div class="dot-label bg-gray-300 ml-1"></div>Inactive</span>
												</td>
												<td>
													<a href="#">mila@kunis.com</a>
												</td>
												<td>
													<a href="#" class="btn btn-sm btn-primary">
														<i class="las la-search"></i>
													</a>
													<a href="#" class="btn btn-sm btn-info">
														<i class="las la-pen"></i>
													</a>
													<a href="#" class="btn btn-sm btn-danger">
														<i class="las la-trash"></i>
													</a>
												</td>
											</tr>
                                            
										</tbody>
									</table>
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
<div class="modal" id="modaldemo7">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title text-danger">Delete Purchases Invoice</h6><button aria-label="Close"
                    class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
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


@endsection
@section('js')
<script>
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
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

@endsection
