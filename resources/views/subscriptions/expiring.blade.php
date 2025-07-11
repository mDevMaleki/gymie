@extends('app')

@section('content')


    <div class="rightside bg-grey-100">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">اشتراک‌های رو به پایان
                <small>جزئیات تمام اشتراک‌های رو به پایان</small>
            </h1>
            @permission(['manage-gymie','pagehead-stats'])
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right"><span data-toggle="counter" data-start="0"
                                                                                                                     data-from="0" data-to="{{ $count }}"
                                                                                                                     data-speed="600"
                                                                                                                     data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-5 font-size-14">اشتراک‌های رو به پایان</small>
            </h1>
            @endpermission
        </div><!-- / PageHead -->


        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border ">

                        <div class="panel-title bg-blue-grey-50">
                            <div class="panel-head font-size-15">

                                <div class="row">
                                    <div class="col-sm-12 no-padding">
                                        {!! Form::Open(['method' => 'GET']) !!}

                                        <div class="col-sm-3">

                                            {!! Form::label('subscription-daterangepicker','بازه زمانی') !!}

                                            <div id="subscription-daterangepicker"
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
                                            {!! Form::select('sort_field',array('created_at' => 'تاریخ','plan_name' => 'نام برنامه'),old('sort_field'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_field']) !!}
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
                            @if($expirings->count() == 0)
                                <h4 class="text-center padding-top-15">متاسفیم! رکوردی یافت نشد</h4>
                            @else
                                <table id="expiring" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>کد عضو</th>
                                        <th>نام عضو</th>
                                        <th>نام برنامه</th>
                                        <th>تاریخ شروع</th>
                                        <th>تاریخ پایان</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>

                                        @foreach ($expirings as $expiring)

                                            <td>
                                                <a href="{{ action('MembersController@show',['id' => $expiring->member->id]) }}">{{ $expiring->member->member_code }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ action('MembersController@show',['id' => $expiring->member->id]) }}">{{ $expiring->member->name }}</a>
                                            </td>
                                            <td>{{ $expiring->plan->plan_name }}</td>
                                            <td>{{ $expiring->start_date->format('Y-m-d') }}</td>
                                            <td>{{ $expiring->end_date->format('Y-m-d') }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">عملیات</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            @permission(['manage-gymie','manage-subscriptions','renew-subscription'])
                                                            <a href="{{ action('SubscriptionsController@renew',['id' => $expiring->invoice_id]) }}">
                                                                تمدید اشتراک
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                        <li>
                                                            @permission(['manage-gymie','manage-subscriptions','delete-subscription'])
                                                            <a href="#" class="delete-record"
                                                               data-delete-url="{{ url('subscriptions/'.$expiring->id.'/delete') }}"
                                                               data-record-id="{{$expiring->id}}">
                                                                حذف اشتراک
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                    </ul>
                                                </div>

                                            </td>

                                            </td>
                                    </tr>

                                    @endforeach

                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="gymie_paging_info">
                                            نمایش صفحه{{ $expirings->currentPage() }} of {{ $expirings->lastPage() }}
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="gymie_paging pull-right">

                                            {!! str_replace('/?', '?', $expirings->appends(Input::Only('search'))->render()) !!}
                                        </div>
                                    </div>
                                </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.deleterecord();
        });
    </script>
@stop