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

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('subscription_amount','هزینه اشتراک باشگاه') !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                {!! Form::text('subscription_amount',null,['class'=>'form-control', 'id' => 'subscription_amount','readonly' => 'readonly']) !!}
                            </div>
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