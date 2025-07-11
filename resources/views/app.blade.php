<!DOCTYPE html>
<html lang="fa" dir="rtl">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <title>Gymie</title>

    <!-- BEGIN CORE FRAMEWORK -->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <!-- END CORE FRAMEWORK -->

    <!-- BEGIN PLUGIN STYLES -->
    <link href="{{ URL::asset('assets/plugins/animate/animate.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/morris/morris.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrap-slider/css/slider.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/rickshaw/rickshaw.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrap-tokenfield/css/bootstrap-tokenfield.min.css') }}" rel="stylesheet"/>
    <!-- END PLUGIN STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="{{ URL::asset('assets/css/material.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/plugins.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/helpers.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/responsive.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/mystyle.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/print.css') }}" media="print" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css" rel="stylesheet"/>
    <!-- END THEME STYLES -->
    @include('_jsVariables')
    @yield('header_scripts')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-leftside fixed-header">
<!-- BEGIN HEADER -->
<header class="hidden-print">
    <span class="logo">Gymie</span>
    <nav class="navbar navbar-static-top">
        <a href="#" class="navbar-btn sidebar-toggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
    </nav>
</header>
<!-- END HEADER -->

<div class="wrapper">
    <!-- BEGIN LEFTSIDE -->
    <div class="leftside hidden-print">
        <div class="sidebar">
            <!-- BEGIN RPOFILE -->
            <div class="nav-profile">
                <div class="thumb">
                    <?php
                    $media = Auth::user()->getMedia();
                    $image = ($media->isEmpty() ? 'https://placeholdit.imgix.net/~text?txtsize=18&txt=NA&w=50&h=50' : url($media[0]->getUrl('thumb')));
                    ?>
                    <img src="{{ $image }}" class="img-circle" alt=""/>
                </div>
                <div class="info">
                    <span class="color-grey-400">{{Utilities::getGreeting()}},</span><br/>
                    <a>{{Auth::user()->name}}</a>
                </div>
                <a href="{{url('auth/logout')}}" class="button"><i class="ion-log-out"></i></a>
            </div>
            <!-- END RPOFILE -->
            <!-- BEGIN NAV -->
            <div class="title">فهرست</div>
            <ul class="nav-sidebar">
                <li class="{{ Utilities::setActiveMenu('dashboard*') }}">
                    <a href="{{ action('DashboardController@index') }}">
                        <i class="ion-home"></i> <span>داشبورد</span>
                    </a>
                </li>

                @permission(['manage-gymie','manage-enquiries','view-enquiry'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('enquiries*',true) }}">
                    <a href="#">
                        <i class="ion-ios-telephone"></i> <span>استعلام‌ها</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('enquiries/all') }}"><a href="{{ action('EnquiriesController@index') }}">همه استعلام‌ها</a></li>
                        @permission(['manage-gymie','manage-enquiries','add-enquiry'])
                        <li class="{{ Utilities::setActiveMenu('enquiries/create') }}"><a href="{{ action('EnquiriesController@create') }}">افزودن استعلام</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-members','view-member'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('members*',true) }}">
                    <a href="#">
                        <i class="ion-person-add"></i> <span>اعضا</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('members/all') }}"><a href="{{ action('MembersController@index') }}">همه اعضا</a></li>
                        @permission(['manage-gymie','manage-members','add-member'])
                        <li class="{{ Utilities::setActiveMenu('members/create') }}"><a href="{{ action('MembersController@create') }}">افزودن عضو</a></li>
                        @endpermission
                        <li class="{{ Utilities::setActiveMenu('members/active') }}"><a href="{{ action('MembersController@active') }}">اعضای فعال</a></li>
                        <li class="{{ Utilities::setActiveMenu('members/inactive') }}"><a href="{{ action('MembersController@inactive') }}">اعضای غیرفعال</a>
                        </li>
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-payments','view-payment'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('payments*',true) }}">
                    <a href="#">
                        <i class="ion-cash"></i> <span>پرداخت‌ها</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('payments/all') }}"><a href="{{ action('PaymentsController@index') }}">تمام پرداخت‌ها</a></li>
                        @permission(['manage-gymie','manage-payments','add-payment'])
                        <li class="{{ Utilities::setActiveMenu('payments/create') }}"><a href="{{ action('PaymentsController@create') }}">افزودن پرداخت</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-subscriptions','view-subscription'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('subscriptions*',true) }}">
                    <a href="#">
                        <i class="ion-android-checkbox-outline"></i> <span>اشتراک‌ها</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('subscriptions/all') }}"><a href="{{ action('SubscriptionsController@index') }}">همه
                                اشتراک‌ها</a></li>
                        @permission(['manage-gymie','manage-subscriptions','add-subscription'])
                        <li class="{{ Utilities::setActiveMenu('subscriptions/create') }}"><a href="{{ action('SubscriptionsController@create') }}">افزودن
                                اشتراک</a></li>
                        @endpermission
                        <li class="{{ Utilities::setActiveMenu('subscriptions/expiring') }}"><a href="{{ action('SubscriptionsController@expiring') }}">اشتراک‌های
                                رو به پایان</a></li>
                        <li class="{{ Utilities::setActiveMenu('subscriptions/expired') }}"><a href="{{ action('SubscriptionsController@expired') }}">اشتراک‌های
                                منقضی</a></li>
                    </ul>
                </li>
                @endpermission

            <!-- <li class="nav-dropdown {{-- Utilities::setActiveMenu('reports*',true) --}}">
                            <a href="#">
                                <i class="fa fa-file"></i> <span>Reports</span>
                            </a>
                            <ul>
                                <li class="{{-- Utilities::setActiveMenu('reports/members/*') --}}"><a href="{{-- action('ReportsController@gymMemberCharts') --}}">Members</a></li>
                                <li class="{{-- Utilities::setActiveMenu('reports/enquiries/*') --}}"><a href="{{-- action('ReportsController@enquiryCharts') --}}">Enquiries</a></li>
                                <li class="{{-- Utilities::setActiveMenu('reports/subscriptions/*') --}}"><a href="{{-- action('ReportsController@subscriptionCharts') --}}">Subscriptions</a></li>
                                <li class="{{-- Utilities::setActiveMenu('reports/payments/*') --}}"><a href="{{-- action('ReportsController@paymentCharts') --}}">Payments</a></li>                            
                                <li class="{{-- Utilities::setActiveMenu('reports/expenses/*') --}}"><a href="{{-- action('ReportsController@expenseCharts') --}}">Expenses</a></li>                            
                                <li class="{{-- Utilities::setActiveMenu('reports/invoices/*') --}}"><a href="{{-- action('ReportsController@invoiceCharts') --}}">Invoices</a></li>                            
                            </ul>
                        </li> -->

                @permission(['manage-gymie','manage-sms'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('sms*',true) }}">
                    <a href="#">
                        <i class="ion-ios-paper"></i> <span>پیامک</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('sms/triggers') }}"><a href="{{ action('SmsController@triggersIndex') }}">تریگرها</a></li>
                        <li class="{{ Utilities::setActiveMenu('sms/events') }}"><a href="{{ action('SmsController@eventsIndex') }}">زمان‌بندی پیام</a></li>
                        <li class="{{ Utilities::setActiveMenu('sms/send') }}"><a href="{{ action('SmsController@send') }}">ارسال پیام</a></li>
                        <li class="{{ Utilities::setActiveMenu('sms/log') }}"><a href="{{ action('SmsController@logIndex') }}">گزارش</a></li>
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-invoices','view-invoice'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('invoices*',true) }}">
                    <a href="#">
                        <i class="ion-ios-paper"></i> <span>صورتحساب‌ها</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('invoices/all') }}"><a href="{{ action('InvoicesController@index') }}">همه صورتحساب‌ها</a></li>
                        <li class="{{ Utilities::setActiveMenu('invoices/paid') }}"><a href="{{ action('InvoicesController@paid') }}">صورتحساب‌های پرداخت‌شده</a></li>
                        <li class="{{ Utilities::setActiveMenu('invoices/unpaid') }}"><a href="{{ action('InvoicesController@unpaid') }}">صورتحساب‌های پرداخت‌نشده</a>
                        </li>
                        <li class="{{ Utilities::setActiveMenu('invoices/partial') }}"><a href="{{ action('InvoicesController@partial') }}">صورتحساب‌های جزیی</a>
                        </li>
                        <li class="{{ Utilities::setActiveMenu('invoices/overpaid') }}"><a href="{{ action('InvoicesController@overpaid') }}">صورتحساب‌های اضافه‌پرداخت‌شده</a></li>
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-expenses','view-expense'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('expenses*',true) }}">
                    <a href="#">
                        <i class="fa fa-inr"></i> <span>هزینه‌ها</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('expenses/all') }}"><a href="{{ action('ExpensesController@index') }}">تمام هزینه‌ها</a></li>
                        @permission(['manage-gymie','manage-expenses','add-expense'])
                        <li class="{{ Utilities::setActiveMenu('expenses/create') }}"><a href="{{ action('ExpensesController@create') }}">افزودن هزینه</a></li>
                        @endpermission
                        @permission(['manage-gymie','manage-expenseCategories','view-expenseCategory'])
                        <li class="{{ Utilities::setActiveMenu('expenses/categories/all') }}"><a href="{{ action('ExpenseCategoriesController@index') }}">دسته‌بندی‌های هزینه</a></li>
                        @endpermission
                        @permission(['manage-gymie','manage-expenseCategories','add-expenseCategory'])
                        <li class="{{ Utilities::setActiveMenu('expenses/categories/create') }}"><a href="{{ action('ExpenseCategoriesController@create') }}">افزودن
                                دسته‌بندی</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-plans','view-plan'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('plans*',true) }}">
                    <a href="#">
                        <i class="ion-compose"></i> <span>برنامه‌ها</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('plans/all') }}"><a href="{{ action('PlansController@index') }}">همه برنامه‌ها</a></li>
                        @permission(['manage-gymie','manage-plans','add-plan'])
                        <li class="{{ Utilities::setActiveMenu('plans/create') }}"><a href="{{ action('PlansController@create') }}">افزودن برنامه</a></li>
                        @endpermission
                        @permission(['manage-gymie','manage-services','view-service'])
                        <li class="{{ Utilities::setActiveMenu('plans/services/all') }}"><a href="{{ action('ServicesController@index') }}">خدمات باشگاه</a>
                        </li>
                        @endpermission
                        @permission(['manage-gymie','manage-services','add-service'])
                        <li class="{{ Utilities::setActiveMenu('plans/services/create') }}"><a href="{{ action('ServicesController@create') }}">افزودن خدمت</a>
                        </li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-users'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('user*',true) }}">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>کاربران</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('user') }}"><a href="{{ action('AclController@userIndex') }}"><i class="fa fa-upload"></i> همه
                                کاربران</a></li>
                        <li class="{{ Utilities::setActiveMenu('user/create') }}"><a href="{{ action('AclController@createUser') }}"><i class="fa fa-list"></i>
                                افزودن کاربر جدید</a></li>
                        <li class="{{ Utilities::setActiveMenu('user/role') }}"><a href="{{ action('AclController@roleIndex') }}"><i class="fa fa-list"></i>
                                نقش‌ها</a></li>
                        @role('Gymie')
                        <li class="{{ Utilities::setActiveMenu('user/permission') }}"><a href="{{ action('AclController@permissionIndex') }}"><i
                                        class="fa fa-list"></i> مجوزها</a></li>
                        @endrole
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-settings'])
                <li class="{{ Utilities::setActiveMenu('settings*') }}">
                    <a href="{{ action('SettingsController@edit') }}">
                        <i class="fa fa-cogs fa-2x"></i> <span>تنظیمات</span>
                    </a>
                </li>
                @endpermission

                <!-- Dummy Spacer -->
                <li>
                    <a href=""></a>
                </li>

            </ul>

        </div>
    </div>

    @yield('content')
</div><!-- /.wrapper -->
<!-- END CONTENT -->

<!-- BEGIN JAVASCRIPTS -->

<!-- BEGIN CORE PLUGINS -->
<script src="{{ URL::asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/core.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- datepicker -->
<script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>

<!-- counter -->
<script src="{{ URL::asset('assets/plugins/jquery-countTo/jquery.countTo.js') }}" type="text/javascript"></script>

<!-- datepicker -->
<script src="{{ URL::asset('assets/plugins/datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

<!--validator-->
<script src="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}" type="text/javascript"></script>

{{-- @include('_jsVariables') --}}

<!--Footer scripts-->
@yield('footer_scripts')

<!-- gymie -->
<script src="{{ URL::asset('assets/js/gymie.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script>
<script>$.material.init();</script>

@yield('footer_script_init')

<!-- dashboard -->
<script type="text/javascript">

    $(document).ready(function () {
        gymie.loadcounter();
        gymie.loadprogress();
        gymie.loaddatepicker();
        gymie.loaddaterangepicker();
        gymie.loadbsselect();
    });

</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>