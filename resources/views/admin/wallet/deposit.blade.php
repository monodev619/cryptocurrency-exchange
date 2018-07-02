@extends('admin.layout.admin')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Deposit Lists</h3>
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
                                        <div class="col-md-2">
                                            <h5 class="box-title m-t-10">Currency</h5>
                                            <input type="text" class="form-control" id="currency" name="currency">
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="box-title m-t-10">Address</h5>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="box-title m-t-10">Reg Date</h5>
                                            <input class="form-control input-daterange-datepicker" type="text" id="register-dt" name="daterange" value=""/>
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="box-title m-t-10">Search</h5>
                                            <button type="button" class="btn btn-block btn-info" onclick="initDepositTable()">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="button-group">
                            <button type="button" class="btn waves-effect waves-light btn-primary" onclick="openCurrency(this, false)">Add</button>
                            <button type="button" class="btn waves-effect waves-light btn-danger">Delete</button>
                        </div>
                        <div class="table-responsive m-t-20">
                            <table id="tbldeposit" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Currency</th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                    <th>Is_confirmed</th>
                                    <th>Txid</th>
                                    <th>Status</th>
                                    <th>Date</th>
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
        {{--<div id="deposit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">--}}
            {{--<div class="modal-dialog">--}}
                {{--<div class="modal-content">--}}
                    {{--<div class="modal-header">--}}
                        {{--<h4 class="modal-title">Currency</h4>--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
                    {{--</div>--}}
                    {{--<form id="currency-form" novalidate>--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<div class="modal-body">--}}
                            {{--<div class="form-group text-center">--}}
                                {{--<img class="text-center" src="" id="preview" width="150px" height="150px">--}}
                                {{--<div class="row text-center">--}}
                                    {{--<input type="file" class="input-image" id="logo" name="logo" onchange="selectImage(this)" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="has-danger"><div id="currency-error" class="form-control-feedback"></div></div>--}}
                            {{--<div class="form-group">--}}
                                {{--<h5> Name : <span class="text-danger">*</span> </h5>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" class="form-control" id="name" name="name" required data-validation-required-message="This field is required" value="">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<h5>Symbol : <span class="text-danger">*</span> </h5>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" id="symbol" name="symbol" class="form-control" required data-validation-required-message="This field is required" value="">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<h5>Info</h5>--}}
                                {{--<div class="input-group">--}}
                                    {{--<textarea class="form-control" name="info" id="info" rows="5" cols="80"></textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<input id="currency_id" name="currency_id" type="hidden" value="">--}}
                        {{--</div>--}}
                        {{--<div class="modal-footer">--}}
                            {{--<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>--}}
                            {{--<button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div id="market-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">--}}
            {{--<div class="modal-dialog">--}}
                {{--<div class="modal-content">--}}
                    {{--<div class="modal-header">--}}
                        {{--<h4 class="modal-title">Market</h4>--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
                    {{--</div>--}}
                    {{--<form id="market-form" validate>--}}
                        {{--<div class="modal-body">--}}
                            {{--<div class="form-group">--}}
                                {{--<h5> Type : <span class="text-danger">*</span> </h5>--}}
                                {{--<select id="type" name="type" required class="selectpicker m-b-20 m-r-10">--}}
                                    {{--<option value="0">Select symbol</option>--}}
                                    {{--<option value="BTC">BTC</option>--}}
                                    {{--<option value="ETH">ETH</option>--}}
                                {{--</select>--}}
                                {{--<div class="has-danger"><div id="typevalidation" class="form-control-feedback"></div></div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<h5>Symbol : <span class="text-danger">*</span> </h5>--}}
                                {{--<select id="currency" name="currency"  class="select2 form-control custom-select" style="width: 100%; height:36px;">--}}
                                    {{--<option value="0">Select currency</option>--}}
                                    {{--@foreach($currencies as $currency)--}}
                                        {{--<option value="{{ $currency->id }}">{{ $currency->name.' ('.$currency->symbol.')'}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                                {{--<div class="has-danger"><div id="symbolvalidation" class="form-control-feedback"></div></div>--}}
                            {{--</div>--}}
                            {{--<div class="has-danger"><div id="market-error" class="form-control-feedback"></div></div>--}}
                            {{--<input id="market_id" name="market_id" type="hidden" value="">--}}
                        {{--</div>--}}
                        {{--<div class="modal-footer">--}}
                            {{--<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>--}}
                            {{--<button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('static/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('static/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('static/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('static/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    <script src="{{ asset('static/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('static/pages/wallet.js') }}"></script>

@endsection