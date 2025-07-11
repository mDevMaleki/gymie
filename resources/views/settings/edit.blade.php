@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title">تنظیمات</h1>
        </div>

        <div class="container-fluid">
        {!! Form::Open(['url' => 'settings/save','id'=>'settingsform','files'=>'true']) !!}
        <!-- عمومی Settings -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-cogs"></i> عمومی</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <!--Main row start-->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('gym_name','نام باشگاه') !!}
                                        {!! Form::text('gym_name',$settings['gym_name'],['class'=>'form-control', 'id' => 'gym_name']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('financial_start','شروع سال مالی') !!}
                                        {!! Form::text('financial_start',$settings['financial_start'],['class'=>'form-control datepicker-default', 'id' => 'financial_start']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('financial_end','پایان سال مالی') !!}
                                        {!! Form::text('financial_end',$settings['financial_end'],['class'=>'form-control datepicker-default', 'id' => 'financial_end']) !!}
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                @if($settings['gym_logo'] != "")
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    {!! Form::label('gym_logo','لوگوی باشگاه') !!}<br>
                                                    <img alt="gym logo" src="{{url('/images/Invoice/'.'gym_logo'.'.jpg') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    {!! Form::file('gym_logo',['class'=>'form-control', 'id' => 'gym_logo']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            {!! Form::label('gym_logo','لوگوی باشگاه') !!}
                                            {!! Form::file('gym_logo',['class'=>'form-control', 'id' => 'gym_logo']) !!}
                                        </div>
                                    </div>
                                @endif

                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                {!! Form::label('gym_address_1','نشانی باشگاه خط ۱') !!}
                                                {!! Form::text('gym_address_1',$settings['gym_address_1'],['class'=>'form-control', 'id' => 'gym_address_1']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                {!! Form::label('gym_address_2','نشانی باشگاه خط ۲') !!}
                                                {!! Form::text('gym_address_2',$settings['gym_address_2'],['class'=>'form-control', 'id' => 'gym_address_2']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--تنظیمات فاکتور -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-file"></i> فاکتور</div>
                        </div>
                        <div class="panel-body">
                            <div class="row">                <!--Main row start-->
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                {!! Form::label('invoice_prefix','پیشوند فاکتور') !!}
                                                {!! Form::text('invoice_prefix',$settings['invoice_prefix'],['class'=>'form-control', 'id' => 'invoice_prefix']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                {!! Form::label('invoice_last_number','آخرین شماره فاکتور') !!}
                                                {!! Form::text('invoice_last_number',$settings['invoice_last_number'],['class'=>'form-control', 'id' => 'invoice_last_number']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                {!! Form::label('invoice_name_type','نمایش روی فاکتور') !!}
                                                {!! Form::select('invoice_name_type',array('gym_logo' => 'لوگوی باشگاه', 'gym_name' => 'نام باشگاه'),$settings['invoice_name_type'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'invoice_name_type']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                {!! Form::label('invoice_number_mode','حالت شماره فاکتور') !!}
                                                {!! Form::select('invoice_number_mode',array('0' => 'دستی', '1' => 'خودکار'),$settings['invoice_number_mode'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'invoice_number_mode']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- member Settings -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-users"></i> عضو</div>
                        </div>

                        <div class="panel-body">
                            <div class="row"><!--Main row start-->
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('member_prefix','پیشوند عضو') !!}
                                                {!! Form::text('member_prefix',$settings['member_prefix'],['class'=>'form-control', 'id' => 'member_prefix']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('member_last_number','آخرین شماره عضو') !!}
                                                {!! Form::text('member_last_number',$settings['member_last_number'],['class'=>'form-control', 'id' => 'member_last_number']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('member_number_mode','حالت شماره عضو') !!}
                                                {!! Form::select('member_number_mode',array('0' => 'دستی', '1' => 'خودکار'),$settings['member_number_mode'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'member_number_mode']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- تنظیمات هزینه‌ها -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-dollar"></i> هزینه‌ها</div>
                        </div>

                        <div class="panel-body">
                            <div class="row"><!--Main row start-->
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('admission_fee','هزینه ثبت‌نام') !!}
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                                    {!! Form::text('admission_fee',$settings['admission_fee'],['class'=>'form-control', 'id' => 'admission_fee']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('taxes','مالیات') !!}
                                                <div class="input-group">
                                                    {!! Form::text('taxes',$settings['taxes'],['class'=>'form-control', 'id' => 'taxes']) !!}
                                                    <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('discounts','درصدهای تخفیف موجود') !!}
                                                {!! Form::text('discounts',$settings['discounts'],['class'=>'form-control tokenfield', 'id' => 'discounts', 'placeholder' => 'درصد تخفیف را وارد کرده و اینتر بزنید']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- تنظیمات پیامک -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-file-text-o"></i> پیامک</div>
                        </div>

                        <div class="panel-body">
                            <div class="row"><!--Main row start-->
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('sms','فعال کردن پیامک؟') !!}
                                                {!! Form::select('sms',array('0' => 'خیر', '1' => 'بله'),$settings['sms'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sms']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('primary_contact','شماره تماس اصلی') !!}
                                                {!! Form::text('primary_contact',$settings['primary_contact'],['class'=>'form-control', 'id' => 'primary_contact']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @role('Gymie')
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('sms_request','درخواست پیامک') !!}
                                                {!! Form::select('sms_request',array('0' => 'درخواست نشده', '1' => 'درخواست شده'),$settings['sms_request'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sms_request']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Form Submission -->
            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group">
                        {!! Form::submit('ذخیره', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>
            {!! Form::Close() !!}
        </div>
    </div>
@stop

@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/setting.js') }}" type="text/javascript"></script>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        gymie.loadBsTokenInput();
    </script>
@stop