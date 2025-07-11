<?php use Carbon\Carbon; ?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name','نام') !!}
            {!! Form::text('name',null,['class'=>'form-control','id'=>'name']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php $expenseCategories = App\ExpenseCategory::where('status', '=', '1')->lists('name', 'id'); ?>
            {!! Form::label('category_id','دسته‌بندی') !!}
            {!! Form::select('category_id',$expenseCategories,null,['class'=>'form-control selectpicker show-tick show-menu-arrow','id'=>'category_id','data-live-search'=> 'true']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('due_date','تاریخ سررسید / تاریخ پرداخت') !!}
            {!! Form::text('due_date',(isset($expense->due_date) ? $expense->due_date->format('Y-m-d') : Carbon::today()->format('Y-m-d')),['class'=>'form-control datepicker-default','id'=>'due_date']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label('repeat','تکرار') !!}
        <!--0 for inactive , 1 for active-->
            {!! Form::select('repeat',array('0' => 'بدون تکرار', '1' => 'هر روز', '2' => 'هر هفته', '3' => 'هر ماه', '4' => 'هر سال'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'repeat']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('note','یادداشت') !!}
            {!! Form::text('note',null,['class'=>'form-control','id'=>'note']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('amount','مبلغ') !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                {!! Form::text('amount',null,['class'=>'form-control','id'=>'amount']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
        </div>
    </div>
</div>