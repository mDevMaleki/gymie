@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100">
            @include('flash::message')
            <h1 class="page-title">کاربران</h1>
            <a href="{{ action('AclController@createUser') }}" class="btn btn-primary active pull-right" role="button">افزودن</a></h1>
        </div>

        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel no-border ">
                        <div class="panel-title bg-white no-border">
                        </div>
                        <div class="panel-body no-padding-top bg-white">
                            <table id="staffs" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">عکس</th>
                                    <th class="text-center">نام</th>
                                    <th class="text-center">ایمیل</th>
                                    <th class="text-center">نقش</th>
                                    <th class="text-center">اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    @foreach ($users as $user)
                                        <?php
                                        $media = $user->getMedia('staff');
                                        $image = ($media->isEmpty() ? 'https://placeholdit.imgix.net/~text?txtsize=18&txt=NA&w=50&h=50' : url($media[0]->getUrl('thumb')));
                                        ?>
                                        <td class="text-center"><img src="{{ $image }}"></td>
                                        <td class="text-center">{{ $user->name}}</td>
                                        <td class="text-center">{{ $user->email}}</td>
                                        <td class="text-center">{{ $user->roleUser->role->name }}</td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">اقدامات</button>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">باز کردن فهرست</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{ action('AclController@editUser',['id' => $user->id]) }}">
                                                            ویرایش جزئیات
                                                        </a>
                                                    </li>
                                                    @if(Auth::user()->id != $user->id)
                                                        <li>
                                                            <a href="#" class="delete-record" data-delete-url="{{ url('user/'.$user->id.'/delete') }}"
                                                               data-record-id="{{ $user->id }}">حذف کاربر</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                </tr>

                                @endforeach


                                </tbody>
                            </table>

                        </div>
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