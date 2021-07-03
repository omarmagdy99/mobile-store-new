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
                PURCHASES INVOICES</span>
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

    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!--Row-->

{{-- إذا كان هناك خطأ  alert الجزء الخاص ب --}}
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
{{-- إذا كان هناك خطأ  alert الجزء الخاص ب --}}

<div class="row row-sm">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <div class="card">
            {{-- form خاصه بالأضافه  --}}
            <form action="{{ route('purchases.store') }}" method="post">
                {{ csrf_field() }}
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">ADD PURCHASES INVOICES</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <div class="row my-2">
                        <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-3">
                            <p class="mg-b-10">supplier Name</p>
                            {{-- خاص بأسماء الموردين للفاتورة select --}}
                            <select class="form-control select2" name="supplier_id">
                                <option label="Choose one">
                                </option>

                                @foreach ($supplier_data as $supplier)

                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                </option>
                                @endforeach
                            </select>
                            {{-- خاص بأسماء الموردين للفاتورة select --}}
                        </div><!-- col-6 -->
                        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                            {{-- notes --}}
                            <textarea name="note" class="form-control" cols="30" rows="3" placeholder="note"></textarea>
                            {{-- notes --}}
                        </div><!-- col-6 -->

                    </div>
                    <div class="row">
                        {{-- يؤخذ منها المنتجات و الكميه و السعر ليوضع في الجدول input --}}
                        <div class="col-md-3">
                            {{-- product name --}}
                            <input type="text" id="product_name" class="form-control" placeholder="Product Name">
                            {{-- product name --}}
                        </div>
                        <div class="col-md-3">
                            {{-- price --}}
                            <input type="number" id="price" class="form-control" placeholder="Price">
                            {{-- price --}}
                        </div>
                        <div class="col-md-3">
                            {{-- quantity --}}
                            <input type="number" id="quantity" class="form-control" placeholder="quantity" min="1">
                            {{-- quantity --}}
                        </div>
                        <div class="col-md-3">
                            {{-- إلى الجدول  input   الزرار لنقل المعلومات من ال --}}
                            <a href="#" class="btn btn-primary addVal">add</a>
                            {{-- إلى الجدول  input   الزرار لنقل المعلومات من ال --}}
                        </div>
                        {{-- يؤخذ منها المنتجات و الكميه و السعر ليوضع في الجدول input --}}

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive border-top userlist-table">
                        <label>Sub Total</label>
                        <input type="number" name="sub_total" id="subTotal" class="form-control" placeholder="sub total"
                            value="0" readonly>
                        {{-- الجدول الذي تنقل إليه بيانات المنتج --}}
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
                                {{-- هنا توضع البيانات الخاصه بالمنتج --}}
                            </tbody>
                        </table>
                        {{-- الجدول الذي تنقل إليه بيانات المنتج --}}
                    </div>
                    {{-- زرار للإضافه  --}}
                    <button class="btn btn-primary " type="submit">save</button>
                    {{-- زرار للإضافه  --}}
                </div>

            </form>
            {{-- form خاصه بالأضافه  --}}

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
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
    $(document).ready(function() {

        });


        // delete row start
        // الزرار المسؤول عن مسح المنتج من الجدول
        $('#tableDel').on('click', '.delRow', function() {
            $num = $(this).data('num');

            $total = $('.' + $num + ' td .total').val();
            $subTotal = $('#subTotal').val();
            $NewsubTotal = $subTotal - $total;
            $('#subTotal').val($NewsubTotal);
            $(this).parent().parent().remove();

        })
        // الزرار المسؤول عن مسح المنتج من الجدول
        // delete row end

        // update row start
        // الزرار المسؤول عن إتاحة التعديل في  الجدول
        $('#tableDel').on('click', '.updateRow', function() {
            $num = $(this).data('num');
            $('.' + $num + ' .quantity,.' + $num + ' .price ').attr('type', 'text');
            $('.' + $num + ' span').hide();
            $('.' + $num + ' .doneUpdate').show();
            $(this).hide();
        })
        // الزرار المسؤول عن إتاحة التعديل في  الجدول
        // update row end


        // done update row start
// الزرار المسؤول عن تأكيد التعديل على الجدول
$('#tableDel').on('click', '.doneUpdate', function() {
    // this step to select Row(start)
    $num = $(this).data('num');
            // this step to select Row(end)
            $('.' + $num + ' .quantity,.' + $num + ' .price').attr('type', 'hidden');
            // select input to change val(start)
            $priceUpdate = $('.' + $num + ' .price').val();
            $quantityUpdate = $('.' + $num + ' .quantity').val();
            // select input to change val(end)
            // this step to change sub total (start)
            $total = $quantityUpdate * $priceUpdate;
            $UpdateSubTotal = parseInt($('#subTotal').val());
            $oldTotal = parseInt($('.' + $num + ' .total').val());
            if ($oldTotal > $total) {
                $newTotal = $oldTotal - $total;
                $UpdateNewSubTotal = $UpdateSubTotal - $newTotal;
            } else {
                $newTotal = $total - $oldTotal;
                $UpdateNewSubTotal = $UpdateSubTotal + $newTotal;
            }
            // this step to change sub total (start)
            $('.' + $num + ' .spanPrice').html($priceUpdate);
            $('.' + $num + ' .spanQuantity').html($quantityUpdate);
            $('.' + $num + ' .spanTotal').html($total);
            $('.' + $num + ' .total').val($total);

            $('#subTotal').val($UpdateNewSubTotal);
            $('.' + $num + ' span').show();
            $('.' + $num + ' .updateRow').show();
            $(this).hide();
        })
        // الزرار المسؤول عن تأكيد التعديل على الجدول
        // done update row end


        // add button start
        // الزرار المسؤول عن  إضافة بيانات المنتج إلى  الجدول
        $i = 0;
            $('.addVal').click(function(e) {
                e.preventDefault();
                if (!$('#product_name').val() == '' && !$('#price').val() == '' && !$('#quantity').val() == '') {
                    $i++;
                    $product_name = $('#product_name').val();
                    $price = $('#price').val();
                    $quantity = $('#quantity').val();
                    $total = $price * $quantity;
                    $subTotal = parseInt($('#subTotal').val());
                    $NewsubTotal = $subTotal + $total;
                    $('#subTotal').val($NewsubTotal);
                    $('#product_name,#price,#quantity').val('');

                    $('tbody').append(
                        '<tr class="td-' + $i + '">' +
                            '<td class="search">' + $product_name + '<input type="hidden" value="' + $product_name +
                                '" name="product_name[]"></td>' +
                        '<td ><span class="spanPrice">' + $price + '</span><input type="hidden" value="' + $price +
                        '" class="price form-control"  name="price[]" ></td>' +
                        '<td><span class="spanQuantity">' + $quantity + '</span><input type="hidden" value="' +
                            $quantity + '" class="quantity form-control"  name="quantity[]"></td>' +
                            '<td><span class="spanTotal">' + $total + '</span><input type="hidden" value="' + $total +
                        '" class="total" name="total[]"></td>' +
                        '<td><a href="#" class="btn btn-sm btn-danger delRow" data-num="td-' + $i +
                            '"><i class="las la-trash "></i></a> <a href="#" class="btn btn-sm btn-info updateRow" data-num="td-' +
                        $i +
                        '"><i class="las la-pen"></i></a> <a href="#" class="btn btn-sm btn-primary doneUpdate" data-num="td-' +
                        $i + '" ><i class="las la-search" ></i></a></td>' +
                        '</tr>'
                    );
                        $('.doneUpdate').hide();
                } else {
                    alert('you mast inter data in all input');
                }

            });
        // الزرار المسؤول عن  إضافة بيانات المنتج إلى  الجدول

            // add button end
</script>
@endsection
