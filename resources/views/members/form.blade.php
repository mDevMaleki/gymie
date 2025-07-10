<?php use Carbon\Carbon; ?>

<!-- Hidden Fields -->
@if(Request::is('members/create'))
    {!! Form::hidden('invoiceCounter',$invoiceCounter) !!}
    {!! Form::hidden('memberCounter',$memberCounter) !!}
@endif

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('member_code','کد عضو') !!}
            {!! Form::text('member_code',$member_code,['class'=>'form-control', 'id' => 'member_code', ($member_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name','نام',['class'=>'control-label']) !!}
            {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('DOB','تاریخ تولد') !!}
            {!! Form::text('DOB',null,['class'=>'form-control datepicker-default', 'id' => 'DOB']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('gender','جنسیت') !!}
            {!! Form::select('gender',array('m' => 'مرد', 'f' => 'زن'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'gender']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('contact','شماره تماس') !!}
            {!! Form::text('contact',null,['class'=>'form-control', 'id' => 'contact']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('email','ایمیل') !!}
            {!! Form::text('email',null,['class'=>'form-control', 'id' => 'email']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('emergency_contact','شماره اضطراری') !!}
            {!! Form::text('emergency_contact',null,['class'=>'form-control', 'id' => 'emergency_contact']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('health_issues','مشکلات سلامتی') !!}
            {!! Form::text('health_issues',null,['class'=>'form-control', 'id' => 'health_issues']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('proof_name','نام مدرک') !!}
            {!! Form::text('proof_name',null,['class'=>'form-control', 'id' => 'proof_name']) !!}
        </div>
    </div>

    @if(isset($member))
        <?php
        $media = $member->getMedia('proof');
        $image = ($media->isEmpty() ? 'https://placeholdit.imgix.net/~text?txtsize=18&txt=NA&w=70&h=70' : url($media[0]->getUrl('form')));
        ?>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('proof_photo','عکس مدرک') !!}
                {!! Form::file('proof_photo',['class'=>'form-control', 'id' => 'proof_photo']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <img alt="proof Pic" class="pull-right" src="{{ $image }}"/>
        </div>
    @else
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('proof_photo','عکس مدرک') !!}
                {!! Form::file('proof_photo',['class'=>'form-control', 'id' => 'proof_photo']) !!}
            </div>
        </div>
    @endif
</div>

<div class="row">
    @if(isset($member))
        <?php
        $media = $member->getMedia('profile');
        $image = ($media->isEmpty() ? 'https://placeholdit.imgix.net/~text?txtsize=18&txt=NA&w=70&h=70' : url($media[0]->getUrl('form')));
        ?>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('photo','عکس') !!}
                {!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <img alt="profile Pic" class="pull-right" src="{{ $image }}"/>
        </div>
    @else
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('photo','عکس') !!}
                {!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
            </div>
        </div>
    @endif

    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label('status','وضعیت') !!}
        <!--0 for inactive , 1 for active-->
            {!! Form::select('status',array('1' => 'فعال', '0' => 'غیرفعال'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'status']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('aim','هدف شما از عضویت چیست؟',['class'=>'control-label']) !!}
            {!! Form::select('aim',array('0' => 'تناسب اندام', '1' => 'شبکه‌سازی', '2' => 'بدنسازی', '3' => 'کاهش وزن', '4' => 'افزایش وزن', '5' => 'سایر'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'aim']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('source','چگونه با ما آشنا شدید؟',['class'=>'control-label']) !!}
            {!! Form::select('source',array('0' => 'تبلیغات', '1' => 'معرفی دوستان', '2' => 'سایر'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'source']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('occupation','شغل') !!}
                    {!! Form::select('occupation',array('0' => 'دانشجو', '1' => 'خانه‌دار','2' => 'خوداشتغال','3' => 'حرفه‌ای','4' => 'فریلنسر','5' => 'سایر'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'occupation']) !!}
                </div>
            </div>


            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('pin_code','کد پستی',['class'=>'control-label']) !!}
                    {!! Form::text('pin_code',null,['class'=>'form-control', 'id' => 'pin_code']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('address','نشانی') !!}
            {!! Form::textarea('address',null,['class'=>'form-control', 'id' => 'address', 'rows' => 5]) !!}
        </div>
    </div>
</div>