@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            <!-- Error Log -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>اوه!</strong> در ورودی‌های شما مشکلی وجود دارد.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">جزئیات رویداد پیامک را وارد کنید</div>
                        </div>

                        {!! Form::Open(['url' => 'sms/events','id'=>'smseventsform']) !!}

                        @include('sms.events._form',['submitButtonText' => 'افزودن'])

                        {!! Form::Close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/event.js') }}" type="text/javascript"></script>
@stop