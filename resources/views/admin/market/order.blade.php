@extends('admin.layout.admin')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Order Lists</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Home</a></li>
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
                                        <div class="col-md-2">
                                            <h5 class="box-title m-t-10">Name</h5>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="col-md-1">
                                            <h5 class="box-title m-t-10">Market</h5>
                                            <input type="text" class="form-control" id="market" name="market">
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="box-title m-t-10">Bid/Ask</h5>
                                            <input type="text" class="form-control" id="bidask" name="bidask">
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="box-title m-t-10">OrderType</h5>
                                            <input type="text" class="form-control" id="ordertype" name="ordertype">
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="box-title m-t-10">Condition</h5>
                                            <input type="text" class="form-control" id="condition" name="condition">
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="box-title m-t-10">Reg Date</h5>
                                            <input class="form-control input-daterange-datepicker" type="text" id="register-dt" name="daterange" value=""/>
                                        </div>

                                        <div class="col-md-1">
                                            <h5 class="box-title m-t-10">Search</h5>
                                            <button type="button" class="btn btn-block btn-info" onclick="initOrderTable()">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="button-group">
                            <button type="button" class="btn waves-effect waves-light btn-primary" onclick="openOrder(this, false)">Add</button>
                            <button type="button" class="btn waves-effect waves-light btn-danger">Delete</button>
                        </div>
                        <div class="table-responsive m-t-20">
                            <table id="tblorder" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Market</th>
                                    <th>Bid/Ask</th>
                                    <th>Order_Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Condition</th>
                                    <th>Target_Price</th>
                                    <th>Fee</th>
                                    <th>Total</th>
                                    <th>Timeinforce</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th></th>
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
    <script src="{{ asset('static/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('static/pages/order.js') }}"></script>

@endsection