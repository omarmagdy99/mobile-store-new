@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Purchases</span>
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
<!-- row -->
<div class="row row-sm" id="div_print">
    <div class="col-md-12 col-xl-12">
        <div class=" main-content-body-invoice">
            <div class="card card-invoice">
                <div class="card-body" style="height: 70vh">
                    <form action="/PurchasesShow" method="get">

                        <div class="row">
                            <div class="col-12 ">
                                {{-- إذا لم يتم البحث عن اسم المورد او id  --}}
                                @if (empty($id||$supplier_name))
                                {{-- إذا لم يتم البحث عن اسم المورد او id  --}}
                                <div class="d-block ">
                                    <label for="from_date">from date</label>
                                    {{-- الجزء الخاص للبحث عن طريق التاريخ  --}}

                                    <input checked type="radio" name="search_to" id="from_date" value="from_date">
                                    {{-- الجزء الخاص للبحث عن طريق التاريخ  --}}

                                </div>
                                <div>
                                    <label for="invoice_number">from invoice number</label>
                                    {{--   الجزء الخاص للبحث عن طريق المورد --}}

                                    <input type="radio" name="search_to" id="invoice_number" value="invoice_number">
                                    {{--   الجزء الخاص للبحث عن طريق المورد --}}

                                </div>

                                @else
                                <div class="d-block ">
                                    <label for="from_date">from date</label>
                                    {{-- الجزء الخاص للبحث عن طريق التاريخ  --}}
                                    <input type="radio" name="search_to" id="from_date" value="from_date">
                                    {{-- الجزء الخاص للبحث عن طريق التاريخ  --}}
                                </div>
                                <div>
                                    <label for="invoice_number">from invoice number</label>
                                    {{--   الجزء الخاص للبحث عن طريق المورد --}}

                                    <input checked type="radio" name="search_to" id="invoice_number"
                                        value="invoice_number">
                                    {{--   الجزء الخاص للبحث عن طريق المورد --}}
                                </div>
                                @endif
                            </div>
                            <div class="col-6 date_div">
                                <label for=""> from</label>
                                {{-- date from   البحث عن  --}}
                                <input type="date" class="form-control" name="date_from" value="{{$from}}">
                                {{-- date from   البحث عن  --}}
                            </div>

                            <div class="col-6 date_div">
                                <label for="">to</label>
                                {{-- date to   البحث عن  --}}
                                <input type="date" class="form-control" name="date_to" value="{{$to}}">
                                {{-- date to   البحث عن  --}}
                            </div>
                            <div class="col-6 invoice_div">
                                <label for="">invoice number</label>
                                {{-- id   البحث عن  --}}
                                <input type="text" class="form-control" name="id" placeholder="invoice number"
                                    {{-- id   البحث عن  --}} value="{{$id}}">
                            </div>
                            <div class="col-6 invoice_div">
                                <label for="">supplier name</label>
                                {{-- supplier   البحث عن  --}}
                                <input type="text" class="form-control" name="supplier_name" placeholder="supplier name"
                                    value="{{$supplier_name}}">
                                {{-- supplier   البحث عن  --}}
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-12 text-center">
                                <input type="submit" class="btn btn-primary my-3" value="search">
                                <a href="PurchasesReportes/allInvoice" class="btn btn-primary my-3">all invoice</a>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive border-top userlist-table">
                            {{-- الجدول الذي تعرض فيه البيانات --}}
                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0" style="width: 2%">#</th>
                                        <th class="border-bottom-0" style="width: 2%">invoice number</th>
                                        <th class="wd-lg-20p">sub total</th>
                                        <th class="wd-lg-20p">user name</th>
                                        <th class="wd-lg-20p">supplier name</th>
                                        <th class="wd-lg-20p">invoice date</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- purchases الجزء مسئول عن عرض المعلومات الخاصه ب --}}
                                    @php
                                    $c=1;
                                    @endphp
                                    @if (isset($invoice_data))

                                    @if (isset($invoice_data[0][0]))


                                    @for ($i=0;$i<count($invoice_data);$i++) <tr>
                                        @if (isset($invoice_data[$i][0]))
                                        <td>@php
                                            echo $c++;
                                            @endphp</td>
                                        <td><a
                                                href="PurchasesReportes/{{$invoice_data[$i][0]->id}}">{{$invoice_data[$i][0]->id}}</a>
                                        </td>
                                        <td>{{$invoice_data[$i][0]->sub_total}}</td>
                                        <td>{{$invoice_data[$i][0]->user_id}}</td>
                                        <td>{{$invoice_data[$i][0]->supplierName->name}}</td>
                                        <td>{{$invoice_data[$i][0]->created_at}}</td>
                                        </tr>
                                        @endif
                                    @endfor

                                        @else
                                    @foreach ($invoice_data as $item)
                                        <tr>
                                            <td>@php
                                                echo $c++;
                                                @endphp</td>
                                            <td><a href="productReportes/{{$item->id}}">{{$item->id}}</a></td>
                                            <td>{{$item->sub_total}}</td>
                                            <td>{{$item->user_id}}</td>
                                            <td>{{$item->supplierName->name}}</td>
                                            <td>{{$item->created_at}}</td>
                                        </tr>
                                    @endforeach
                                        @endif
                                        @endif
                                        {{-- purchases الجزء مسئول عن عرض المعلومات الخاصه ب --}}


                                </tbody>
                            </table>
                            {{-- الجدول الذي تعرض فيه البيانات --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script>
    $('input[name=id]').on('change',function(){
        $('input[name=supplier_name]').val('');
    });
    $('input[name=supplier_name]').on('change',function(){
        $('input[name=id]').val('');
    });

    $(document).ready(function () {
        @if (empty($id||$supplier_name))
        $('.invoice_div').hide();
        @else
        $('.date_div').hide();

        @endif

    });
    // الجزء المسئول عن عرض و إخفاء اقسام البحث
    $('input[name=search_to]').change(function(){
        if($(this).val()=='from_date'){
            $('.invoice_div').hide('0.1s');
            $('.date_div').show('2s');
            $('.invoice_div input').attr('disabled','true');
            $('.date_div input').prop("disabled", false);
        }else{

            $('.invoice_div').show('2s');
            $('.date_div').hide('0.1s');
            $('.date_div input').attr('disabled','true');
            $('.invoice_div input').prop("disabled", false);
        }

    })
    // الجزء المسئول عن عرض و إخفاء اقسام البحث
    
</script>
@endsection
