@extends('admin.layout.admin')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">User List</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>User</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form id="search-user-form" class="form-horizontal">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {{--<div class="col-md-2">--}}
                                        {{--<h5 class="box-title m-t-10">呢称</h5>--}}
                                        {{--<input type="text" class="form-control" id="name" name="name">--}}
                                        {{--</div>--}}
                                        <div class="col-md-3">
                                            <h5 class="box-title m-t-10">Name</h5>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="box-title m-t-10">Email</h5>
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="box-title m-t-10">注册日期</h5>
                                            <input class="form-control input-daterange-datepicker" type="text" id="register-dt" name="daterange" value=""/>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="box-title m-t-10">登录日期</h5>
                                            <input class="form-control input-daterange-datepicker" type="text" id="login-dt" name="daterange" value=""/>
                                        </div>
                                        <div class="col-md-1">
                                            <h5 class="box-title m-t-10">操作</h5>
                                            <button type="button" class="btn btn-block btn-success" onclick="initTable()">搜索</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <a id="export-excel" href="javascript:void(0)" onclick="exportUsers()" class="btn btn-block btn-info">导出</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tbluser" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    {{--<th>头像</th>--}}
                                    {{--<th>呢称</th>--}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>Status</th>
                                    <th>Reg Date</th>
                                    {{--<th class="text-center">操作</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('static/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('static/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('static/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('static/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    <script src="{{ asset('static/pages/user.js') }}"></script>
@endsection