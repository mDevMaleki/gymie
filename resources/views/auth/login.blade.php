<!DOCTYPE html>
<html lang="fa" dir="rtl">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <title>Gymie - ورود</title>

    <!-- BEGIN CORE FRAMEWORK -->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <!-- END CORE FRAMEWORK -->

    <!-- BEGIN PLUGIN STYLES -->
    <link href="{{ URL::asset('assets/plugins/animate/animate.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet"/>
    <!-- END PLUGIN STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="{{ URL::asset('assets/css/material.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/plugins.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/helpers.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/responsive.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/mystyle.css') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css" rel="stylesheet"/>
    <!-- END THEME STYLES -->
</head>
<body class="auth-page height-auto bg-grey-600">
<div class="wrapper animated fadeInDown">
    <div class="panel overflow-hidden">
        <div class="bg-grey-900 padding-40 no-margin-bottom font-size-20 color-white text-center text-uppercase">
            <img src="{{ asset('assets/img/web/logo.png') }}">
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>خطا!</strong> در وارد کردن اطلاعات مشکلی به وجود آمد.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="loginform" method="post" action="{{ url('/auth/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="box-body padding-md">

                <div class="form-group label-floating">
                    <label class="control-label" for="email">ایمیل</label>
                    <input type="text" name="email" id="email" class="form-control" />
                </div>

                <div class="form-group label-floating">
                    <label class="control-label" for="password">رمز عبور</label>
                    <input type="password" name="password" id="password" class="form-control" />
                </div>

                <div class="form-group margin-top-20">
                    <div class="checkbox checkbox-theme">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">مرا به خاطر بسپار</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark bg-light-green-500 padding-10 btn-block color-white"><i class="ion-log-in"></i> ورود</button>
            </div>
        </form>
        <div class="panel-footer padding-md no-margin no-border bg-grey-900 text-center color-white">&copy; 2016 Gymie by LUBUS</div>
    </div>
</div>

<!-- Javascript -->
<script src="{{ URL::asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/core.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- material design -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script>
<script>$.material.init();</script>

<!-- bootstrap validator -->
<script src="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}" type="text/javascript"></script>

<!-- Login Validators -->
<script src="{{ URL::asset('assets/js/login.js') }}" type="text/javascript"></script>

<!-- gymie -->
<script src="{{ URL::asset('assets/js/gymie.js') }}" type="text/javascript"></script>
</body>
</html>