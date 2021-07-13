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
    <div class="row" style="flex-direction: column">
        <div class="panel panel-primary tabs-style-2">
            <div class="card">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs main-nav-line">
                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">Invoice</a></li>
                            <li><a href="#tab5" class="nav-link" data-toggle="tab">Details Invoice</a></li>
                        </ul>
                        <!-- Tabs -->

                    </div>
                </div>
                <div class="panel-body tabs-menu-body main-content-body-right border">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab4">

                            <div class="row row-sm">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                                    <div class="card">
                                        <div class="card-header pb-0">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="card-title mg-b-0">Invoice</h4>
                                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive border-top userlist-table">
                                                {{-- الجدول الذي تعرض فيه بيانات الفاتورة --}}

                                                <table
                                                    class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-lg-10p"><span>id</span></th>
                                                            <th class="wd-lg-20p"><span>Sub Total</span></th>
                                                            <th class="wd-lg-20p"><span>Date</span></th>
                                                            <th class="wd-lg-20p"><span>Suppiler Name</span></th>
                                                            <th class="wd-lg-20p"><span>User Name</span></th>
                                                            <th class="wd-lg-20p"><span>note</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                        <tr>
                                                            {{-- بيانات الفاتورة --}}
                                                            <td>{{ $d_purchases_invoice->id }}</td>
                                                            <td>{{ $d_purchases_invoice->sub_total }}</td>
                                                            <td>{{ $d_purchases_invoice->created_at }}</td>
                                                            <td>{{ $d_purchases_invoice->supplierName->name }}</td>
                                                            <td>{{ $d_purchases_invoice->usersName->name }}</td>
                                                            <td>{{ $d_purchases_invoice->notes }}</td>
                                                            {{-- بيانات الفاتورة --}}


                                                        </tr>

                                                    </tbody>
                                                </table>
                                                {{-- الجدول الذي تعرض فيه بيانات الفاتورة --}}

                                            </div>

                                        </div>
                                    </div>
                                </div><!-- COL END -->
                            </div><!-- COL END -->
                            <!-- row closed  -->

                        </div>

                        <div class="tab-pane " id="tab5">
                            <div class="row row-sm">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                                    <div class="card">
                                        <div class="card-header pb-0">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="card-title mg-b-0">Details Invoice</h4>
                                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive border-top userlist-table">
                                                {{-- الجدول الذي تعرض فيه بيانات تفاصيل الفاتورة --}}
                                                <table
                                                    class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-lg-4p"><span>#</span></th>
                                                            <th class="wd-lg-20p"><span>product name</span></th>
                                                            <th class="wd-lg-20p"><span>quantity</span></th>
                                                            <th class="wd-lg-20p"><span>price</span></th>
                                                            <th class="wd-lg-20p"><span>total</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            {{-- purchases derails الجزء مسئول عن عرض المعلومات الخاصه ب --}}

                                                            <?php $i = 1; ?>
                                                            @foreach ($purchases_invoices_details as $purchasesDetails)

                                                        <tr>


                                                            <td><?php echo $i++; ?></td>
                                                            <td>{{ $purchasesDetails->product_name }}</td>
                                                            <td>{{ $purchasesDetails->quantity }}</td>
                                                            <td>{{ $purchasesDetails->price }}</td>
                                                            <td>{{ $purchasesDetails->total }}</td>



                                                        </tr>
                                                        @endforeach
                                                        {{-- purchases derails الجزء مسئول عن عرض المعلومات الخاصه ب --}}

                                                    </tbody>
                                                </table>
                                                {{-- الجدول الذي تعرض فيه بيانات تفاصيل الفاتورة --}}

                                            </div>

                                        </div>
                                    </div>
                                </div><!-- COL END -->
                            </div><!-- COL END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>



@endsection
@section('js')



    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>

@endsection
