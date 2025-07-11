@extends('app')

@section('content')
    <?php use Carbon\Carbon; ?>
    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            <!-- Error Log -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::Open(['url' => 'subscriptions','id'=>'subscriptionsform']) !!}
            {!! Form::hidden('invoiceCounter',$invoiceCounter) !!}

        <!-- Member Details -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">جزئیات اشتراک را وارد کنید</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <?php $member_code = App\Member::where('status', '=', '1')->lists('member_code', 'id'); ?>
                                        {!! Form::label('member_id','کد عضو') !!}
                                        {!! Form::select('member_id',$member_code,$member_id,['class'=>'form-control selectpicker show-tick show-menu-arrow','id'=>'member_id','data-live-search' => 'true']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    {!! Form::label('plan_0','Plan') !!}
                                </div>

                                <div class="col-sm-3">
                                    {!! Form::label('start_date_0','تاریخ شروع') !!}
                                </div>

                                <div class="col-sm-3">
                                    {!! Form::label('end_date_0','تاریخ پایان') !!}
                                </div>

                                <div class="col-sm-1">
                                    <label>&nbsp;</label><br/>
                                </div>
                            </div> <!-- / Row -->
                            <div id="servicesContainer">
                                <?php $x = 0; ?>
                                @foreach($subscriptions as $subscription)
                                    <?php
                                    $startDate = $subscription->end_date->addDays(1);
                                    $dateDiff = $subscription->start_date->diffInDays($subscription->end_date);
                                    $endDate = $subscription->end_date->addDays($dateDiff);
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group plan-id">
                                                <?php $plans = App\Plan::where('status', '=', '1')->get(); ?>

                                                <select id="plan_{{$x }}" name="plan[{{$x}}][id]"
                                                        class="form-control selectpicker show-tick show-menu-arrow childPlan" data-live-search="true"
                                                        data-row-id="{{ $x }}">
                                                    @foreach($plans as $plan)
                                                        <option value="{{ $plan->id }}"
                                                                {{ ($plan->id == $subscription->plan->id ? "selected" : "") }} data-price="{{ $plan->amount }}"
                                                                data-days="{{ $plan->days }}" data-row-id="{{ $x }}">{{ $plan->plan_display }} </option>
                                                    @endforeach
                                                </select>
                                                <div class="plan-price">
                                                    {!! Form::hidden("plan[$x][price]",'', array('id' => "price_$x")) !!}
                                                    {!! Form::hidden('previousSubscriptions[]',$subscription->id) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group plan-start-date">
                                                {!! Form::text("plan[$x][start_date]",$startDate->format('Y-m-d'),['class'=>'form-control datepicker-startdate childStartDate', 'id' => "start_date_$x", 'data-row-id' => "$x"]) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group plan-end-date">
                                                {!! Form::text("plan[$x][end_date]",$endDate->format('Y-m-d'),['class'=>'form-control childEndDate', 'id' => "end_date_$x", 'readonly' => 'readonly','data-row-id' => "$x"]) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                    <span class="btn btn-sm btn-danger pull-right {{ ($x == 0 ? "hide" : "") }} remove-service">
                                                      <i class="fa fa-times"></i>
                                                    </span>
                                            </div>
                                        </div>
                                    </div> <!-- / Row -->
                                    <?php $x++; ?>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-sm-2 pull-right">
                                    <div class="form-group">
                                        <span class="btn btn-sm btn-primary pull-right" id="addSubscription">Add</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Invoice Details -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">جزئیات فاکتور را وارد کنید</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('invoice_number','شماره فاکتور') !!}
                                        {!! Form::text('invoice_number',$invoice_number,['class'=>'form-control', 'id' => 'invoice_number', ($invoice_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
                                    </div>
                                </div>

                                <!-- <div class="col-sm-4">
                                    <div class="form-group"> -->
                            {!! Form::hidden('admission_amount','Admission') !!}
                            {!! Form::hidden('admission_amount',0,['class'=>'form-control', 'id' => 'admission_amount']) !!}
                            <!-- </div>
                                </div> -->

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('subscription_amount','هزینه اشتراک') !!}
                                        {!! Form::text('subscription_amount',null,['class'=>'form-control', 'id' => 'subscription_amount','readonly' => 'readonly']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('taxes_amount',sprintf('مالیات @ %s %%',Utilities::getSetting('taxes'))) !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                            {!! Form::text('taxes_amount',0,['class'=>'form-control', 'id' => 'taxes_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /Row -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_percent','تخفیف') !!}
                                        <?php
                                        $discounts = explode(",", str_replace(" ", "", (Utilities::getSetting('discounts'))));
                                        $discounts_list = array_combine($discounts, $discounts);
                                        ?>
                                        <select id="discount_percent" name="discount_percent" class="form-control selectpicker show-tick show-menu-arrow">
                                            <option value="0">هیچکدام</option>
                                            @foreach($discounts_list as $list)
                                                <option value="{{ $list }}">{{ $list.'%' }}</option>
                                            @endforeach
                                            <option value="custom">سفارشی(ریال)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_amount','مبلغ تخفیف') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                            {!! Form::text('discount_amount',null,['class'=>'form-control', 'id' => 'discount_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_note','یادداشت تخفیف') !!}
                                        {!! Form::text('discount_note',null,['class'=>'form-control', 'id' => 'discount_note']) !!}
                                    </div>
                                </div>
                            </div>

                        </div> <!-- /Box-body -->

                    </div> <!-- /Box -->
                </div> <!-- /Main Column -->
            </div> <!-- /Main Row -->

            <!-- Payment Details -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">جزئیات پرداخت را وارد کنید</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('payment_amount','مبلغ') !!}
                                        {!! Form::text('payment_amount',null,['class'=>'form-control', 'id' => 'payment_amount']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('mode','روش پرداخت') !!}
                                        {!! Form::select('mode',array('1' => 'نقدی', '0' => 'چک'),1,['class'=>'form-control selectpicker show-tick', 'id' => 'mode']) !!}
                                    </div>
                                </div>

                                <div id="chequeDetails">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('number','شماره چک') !!}
                                            {!! Form::text('number',null,['class'=>'form-control', 'id' => 'number']) !!}
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('date','تاریخ چک') !!}
                                            {!! Form::text('date',null,['class'=>'form-control datepicker-default', 'id' => 'date']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /Row -->

                        </div> <!-- /Box-body -->

                    </div> <!-- /Box -->
                </div> <!-- /Main Column -->
            </div> <!-- /Main Row -->

            <!-- Submit Button Row -->
            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group">
                        {!! Form::submit('ایجاد', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>

            {!! Form::Close() !!}

        </div> <!-- content -->
    </div> <!-- rightside -->

@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/subscription.js') }}" type="text/javascript"></script>
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.loaddatepickerstart();
            gymie.chequedetails();
            gymie.subscription();
        });
    </script>
@stop