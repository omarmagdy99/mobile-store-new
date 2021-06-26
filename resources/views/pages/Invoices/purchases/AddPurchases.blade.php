@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Empty</span>
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
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                    id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                    data-x-placement="bottom-end">
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
<!--Row-->
<div class="row row-sm">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">USERS TABLE</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <div class="row">
                    <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                        <p class="mg-b-10">Single Select with Search</p><select class="form-control select2">
                            <option label="Choose one">
                            </option>
                            <option value="Firefox">
                                Firefox
                            </option>
                            <option value="Chrome">
                                Chrome
                            </option>
                            <option value="Safari">
                                Safari
                            </option>
                            <option value="Opera">
                                Opera
                            </option>
                            <option value="Internet Explorer">
                                Internet Explorer
                            </option>
                        </select>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                        <p class="mg-b-10">Single Select with Search</p><select class="form-control select2">
                            <option label="Choose one">
                            </option>
                            <option value="Firefox">
                                Firefox
                            </option>
                            <option value="Chrome">
                                Chrome
                            </option>
                            <option value="Safari">
                                Safari
                            </option>
                            <option value="Opera">
                                Opera
                            </option>
                            <option value="Internet Explorer">
                                Internet Explorer
                            </option>
                        </select>
                    </div><!-- col-6 -->

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="product_name" id="product_name" class="form-control"
                            placeholder="Product Name">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="price" id="price" class="form-control" placeholder="Price">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="quantity">
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-primary addVal">add</a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive border-top userlist-table">
                    <input type="number" name="sub_total" id="subTotal" class="form-control" placeholder="sub total"
                        value="0" readonly>
                    <table id="tableDel" class="table card-table table-striped table-vcenter text-nowrap mb-0">
                        <thead>
                            <tr>


                                <th class="wd-lg-20p"><span>Product</span></th>
                                <th class="wd-lg-20p"><span>Price</span></th>
                                <th class="wd-lg-20p"><span>quantity</span></th>
                                <th class="wd-lg-20p"><span>total</span></th>
                                <th class="wd-lg-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- COL END -->
</div>
<!-- row closed  -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>



<script>
    $(document).ready(function () {

		});

                // delete row start

		$('#tableDel').on('click','.delRow',function(){
			$(this).parent().parent().remove();

		})
                // delete row end

                // update row start

		$('#tableDel').on('click','.updateRow',function(){
			$num=$(this).data('num');
			$('.'+$num+' .quantity,.'+$num+' .price ').attr('type','text');
			$('.'+$num+' span').hide();
			$('.'+$num+' .doneUpdate').show();
			$(this).hide();
		})
                // update row end


                // done update row start

		$('#tableDel').on('click','.doneUpdate',function(){
            // this step to select Row(start)
			$num=$(this).data('num');
            // this step to select Row(end)
			$('.'+$num+' .quantity,.'+$num+' .price').attr('type','hidden');
            // select input to change val(start)
			$priceUpdate=$('.'+$num+' .price').val();
			$quantityUpdate=$('.'+$num+' .quantity').val();
            // select input to change val(end)
            // this step to change sub total (start)
            $total=$quantityUpdate*$priceUpdate;
            $UpdateSubTotal=parseInt($('#subTotal').val());
            $oldTotal=parseInt($('.'+$num+' .total').val());
            if($oldTotal>$total){
                $newTotal=$oldTotal-$total;
                $UpdateNewSubTotal=$UpdateSubTotal-$newTotal;
            }else{
                $newTotal=$total-$oldTotal;
                $UpdateNewSubTotal=$UpdateSubTotal+$newTotal;
            }
            // this step to change sub total (start)
			$('.'+$num+' .spanPrice').html($priceUpdate);
			$('.'+$num+' .spanQuantity').html($quantityUpdate);
			$('.'+$num+' .spanTotal').html($total);
			$('.'+$num+' .total').val($total);

            $('#subTotal').val($UpdateNewSubTotal);
			$('.'+$num+' span').show();
			$('.'+$num+' .updateRow').show();
			$(this).hide();
		})
                // done update row end


        // add button start
		$i=0;
		$('.addVal').click(function(e) {
            e.preventDefault();
			if (!$('#product_name').val() == '' && !$('#price').val() == '' && !$('#quantity').val() == '') {
                $i++;
				$product_name=$('#product_name').val();
				$price=$('#price').val();
				$quantity=$('#quantity').val();
                $total=$price*$quantity;
                $subTotal=parseInt($('#subTotal').val());
                $NewsubTotal=$subTotal+$total;
                $('#subTotal').val($NewsubTotal);
				$('#product_name,#price,#quantity').val('');

				$('tbody').append(
                    '<tr class="td-'+$i+'">' +
                        '<td class="search">'+$product_name+'<input type="hidden" value="'+$product_name+'"></td>' +
                        '<td ><span class="spanPrice">'+$price+'</span><input type="hidden" value="'+$price+'" class="price form-control"  ></td>' +
                        '<td><span class="spanQuantity">'+$quantity+'</span><input type="hidden" value="'+$quantity+'" class="quantity form-control"  ></td>' +
                        '<td><span class="spanTotal">'+$total+'</span><input type="hidden" value="'+$total+'" class="total"></td>' +
                        '<td><a href="#" class="btn btn-sm btn-danger delRow"><i class="las la-trash "></i></a> <a href="#" class="btn btn-sm btn-info updateRow" data-num="td-'+$i+'"><i class="las la-pen"></i></a> <a href="#" class="btn btn-sm btn-primary doneUpdate" data-num="td-'+$i+'" ><i class="las la-search" ></i></a></td>' +
                        '</tr>'
						);
						$('.doneUpdate').hide();
					} else {
                        alert('you mast inter data in all input');
					}

				});

                // add button end




</script>
@endsection
