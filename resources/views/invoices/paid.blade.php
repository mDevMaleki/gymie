@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">صورتحساب‌ها
                <small>جزئیات تمام صورتحساب‌های پرداخت‌شده</small>
            </h1>
            @permission(['manage-gymie','pagehead-stats'])
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right"><span data-toggle="counter" data-start="0"
                                                                                                                     data-from="0" data-to="{{ $count }}"
                                                                                                                     data-speed="600"
                                                                                                                     data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-5 font-size-14">صورتحساب‌های پرداخت‌شده</small>
            </h1>
            @endpermission
        </div><!-- / PageHead -->

        <div class="container-fluid">
            <div class="row"><!-- Main row -->
                <div class="col-lg-12"><!-- Main Col -->
                    <div class="panel no-border ">
                        <div class="panel-title bg-blue-grey-50">
                            <div class="panel-head font-size-15">

                                <div class="row">
                                    <div class="col-sm-12 no-padding">
                                        {!! Form::Open(['method' => 'GET']) !!}

                                        <div class="col-sm-3">

                                            {!! Form::label('invoice-daterangepicker','بازه زمانی') !!}

                                            <div id="invoice-daterangepicker"
                                                 class="gymie-daterangepicker btn bg-grey-50 daterange-padding no-border color-grey-600 hidden-xs no-shadow">
                                                <i class="ion-calendar margin-right-10"></i>
                                                <span>{{$drp_placeholder}}</span>
                                                <i class="ion-ios-arrow-down margin-left-5"></i>
                                            </div>

                                            {!! Form::text('drp_start',null,['class'=>'hidden', 'id' => 'drp_start']) !!}
                                            {!! Form::text('drp_end',null,['class'=>'hidden', 'id' => 'drp_end']) !!}
                                        </div>

                                        <div class="col-sm-2">
                                            {!! Form::label('sort_field','مرتب‌سازی بر اساس') !!}
                                            {!! Form::select('sort_field',array('created_at' => 'تاریخ','invoice_number' => 'شماره صورتحساب','member_name' => 'نام عضو','total' => 'مبلغ کل','pending_amount' => 'مبلغ معوقه'),old('sort_field'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_field']) !!}
                                        </div>

                                        <div class="col-sm-2">
                                            {!! Form::label('sort_direction','ترتیب') !!}
                                            {!! Form::select('sort_direction',array('desc' => 'نزولی','asc' => 'صعودی'),old('sort_direction'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_direction']) !!}</span>
                                        </div>

                                        <div class="col-xs-3">
                                            {!! Form::label('search','کلمه کلیدی') !!}
                                            <input value="{{ old('search') }}" name="search" id="search" type="text" class="form-control padding-right-35"
                                                   placeholder="جستجو...">
                                        </div>

                                        <div class="col-xs-2">
                                            {!! Form::label('&nbsp;') !!} <br/>
                                            <button type="submit" class="btn btn-primary active no-border">برو</button>
                                        </div>

                                        {!! Form::Close() !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="panel-body bg-white">
                            @if($invoices->count() == 0)
                                <h4 class="text-center padding-top-15">متاسفیم! رکوردی یافت نشد</h4>
                            @else
                                <table id="invoices" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>شماره صورتحساب</th>
                                        <th>نام عضو</th>
                                        <th>مبلغ کل</th>
                                        <th>باقی‌مانده</th>
                                        <th>تخفیف</th>
                                        <th>تاریخ ایجاد</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td><a href="{{ action('InvoicesController@show',['id' => $invoice->id]) }}">{{ $invoice->invoice_number}}</a></td>
                                            <td><a href="{{ action('MembersController@show',['id' => $invoice->member->id]) }}">{{ $invoice->member->name}}</a>
                                            </td>
                                            <td>{{ $invoice->total}}</td>
                                            <td>{{ $invoice->pending_amount}}</td>
                                            <td>{{ $invoice->discount_amount}}</td>
                                            <td>{{ $invoice->created_at->toDayDateTimeString()}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">عملیات</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            @permission(['manage-gymie','manage-invoices','view-invoice'])
                                                            <a href="{{ action('InvoicesController@show',['id' => $invoice->id]) }}">
                                                                مشاهده صورتحساب
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                        <li>
                                                            @permission(['manage-gymie','manage-invoices','delete-invoice'])
                                                            <a href="#" class="delete-record" data-delete-url="{{ url('invoices/'.$invoice->id.'/delete') }}"
                                                               data-record-id="{{$invoice->id}}">
                                                                حذف صورتحساب
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="gymie_paging_info">
                                            نمایش صفحه {{ $invoices->currentPage() }} از {{ $invoices->lastPage() }}
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="gymie_paging pull-right">
                                            {!! str_replace('/?', '?', $invoices->appends(Input::Only('search'))->render()) !!}
                                        </div>
                                    </div>
                                </div>

                        </div><!-- / Panel-Body -->
                        @endif
                    </div><!-- / Panel-no-Border -->
                </div><!-- / Main-Col -->
            </div><!-- / Main-Row -->
        </div><!-- / Container -->
    </div><!-- / RightSide -->
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.deleterecord();
        });
    </script>
@stop 