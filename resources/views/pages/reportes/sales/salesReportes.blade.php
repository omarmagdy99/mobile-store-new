@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoice</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">Invoice</h1>

									</div><!-- invoice-header -->
									<div class="row mg-t-20">

										<div class="col-md">
											<label class="tx-gray-600">Invoice Information</label>
											<p class="invoice-info-row"><span>Invoice No:</span> <span>{{$d_sales_invoice->id}}</span></p>
											<p class="invoice-info-row"><span>user name:</span> <span>{{$d_sales_invoice->usersName->name}}</span></p>
											<p class="invoice-info-row"><span>customer name:</span> <span>{{$d_sales_invoice->customerName->name}}</span></p>
											<p class="invoice-info-row"><span>created at:</span> <span>{{$d_sales_invoice->created_at}}</span></p>
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
													<th class="wd-20p">#</th>
													<th class="wd-20p">Type</th>

													<th class="tx-center">QNTY</th>
													<th class="tx-right">Unit Price</th>
													<th class="tx-right">Amount</th>
												</tr>
											</thead>
											<tbody>
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach ($sales_invoice_details as $sales)

												<tr>
													<td>@php echo $i++;
                                                    @endphp</td>
													<td>{{$sales->product_id}}</td>
													
													<td class="tx-center">{{$sales->product_id}}</td>
													<td class="tx-right">${{$sales->product_id}}</td>
													<td class="tx-right">${{$sales->product_id}}0</td>
												</tr>
                                                @endforeach


												<tr>
													<td class="valign-middle" colspan="2" rowspan="4">
														<div class="invoice-notes">
															<label class="main-content-label tx-13">Notes</label>
															<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
														</div><!-- invoice-notes -->
													</td>
													<td class="tx-right">Sub-Total</td>
													<td class="tx-right" colspan="2">$5,750.00</td>
												</tr>
												<tr>
													<td class="tx-right">Tax (5%)</td>
													<td class="tx-right" colspan="2">$287.50</td>
												</tr>
												<tr>
													<td class="tx-right">Discount</td>
													<td class="tx-right" colspan="2">-$50.00</td>
												</tr>
												<tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse">Total Due</td>
													<td class="tx-right" colspan="2">
														<h4 class="tx-primary tx-bold">$5,987.50</h4>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<hr class="mg-b-40">
									<a class="btn btn-purple float-left mt-3 mr-2" href="">
										<i class="mdi mdi-currency-usd ml-1"></i>Pay Now
									</a>
									<a href="#" class="btn btn-danger float-left mt-3 mr-2">
										<i class="mdi mdi-printer ml-1"></i>Print
									</a>
									<a href="#" class="btn btn-success float-left mt-3">
										<i class="mdi mdi-telegram ml-1"></i>Send Invoice
									</a>
								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
@endsection
