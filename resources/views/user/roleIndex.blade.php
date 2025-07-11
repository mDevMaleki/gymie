@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100">
            @include('flash::message')
            <h1 class="page-title">نقش‌ها</h1>
            <a href="{{ action('AclController@createRole') }}" class="btn btn-primary active pull-right" role="button">افزودن</a></h1>
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
                                    <th class="text-center">نام</th>
                                    <th class="text-center">نام نمایشی</th>
                                    <th class="text-center">توضیحات</th>
                                    <th class="text-center">اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    @foreach ($roles as $role)
                                        <td class="text-center">{{ $role->name}}</td>
                                        <td class="text-center">{{ $role->display_name}}</td>
                                        <td class="text-center">{{ $role->description}}</td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">اقدامات</button>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">باز کردن فهرست</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{ action('AclController@editRole',['id' => $role->id]) }}">
                                                            ویرایش جزئیات
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="modal" data-target="#deleteModal-{{$role->id}}" data-id="{{$role->id}}">
                                                            حذف نقش
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <!-- Modal -->
                                        <div id="deleteModal-{{$role->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">تأیید</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>آیا از حذف آن مطمئن هستید؟</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::Open(['action'=>['AclController@deleteRole',$role->id],'method' => 'POST','id'=>'deleteform-'.$role->id]) !!}
                                                        <input type="submit" class="btn btn-danger" value="بله" id="btn-{{ $role->id }}"/>
                                                        <button type="button" class="btn btn-info" data-dismiss="modal">انصراف</button>
                                                        {!! Form::Close() !!}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
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