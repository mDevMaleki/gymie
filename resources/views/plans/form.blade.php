<div class="panel-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('plan_code','کد برنامه') !!}
                {!! Form::text('plan_code',null,['class'=>'form-control', 'id' => 'plan_code']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('plan_name','نام برنامه') !!}
                {!! Form::text('plan_name',null,['class'=>'form-control', 'id' => 'plan_name']) !!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('plan_details','جزئیات برنامه') !!}
                {!! Form::text('plan_details',null,['class'=>'form-control', 'id' => 'plan_details']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <?php $services = App\Service::lists('name', 'id'); ?>
                {!! Form::label('service_id','خدمت') !!}
                {!! Form::select('service_id',$services,null,['required', 'class'=>'form-control selectpicker show-tick show-menu-arrow','id'=>'service_id','data-live-search'=> 'true']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('days','روز') !!}
                {!! Form::text('days',null,['class'=>'form-control', 'id' => 'days']) !!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('amount','مبلغ (بدون مالیات)') !!}
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                    {!! Form::text('amount',null,['class'=>'form-control', 'id' => 'amount']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
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
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </div>
    </div>
</div>
                            