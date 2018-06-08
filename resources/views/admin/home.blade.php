@extends('admin.layout.admin')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Base Material</h3>
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
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Currencies</h4>
                    </div>
                    <div class="card-body">
                        <div class="button-group">
                            <button type="button" class="btn waves-effect waves-light btn-primary" onclick="openCurrency(this, false)">Add</button>
                            <button type="button" class="btn waves-effect waves-light btn-danger">Delete</button>
                        </div>
                        <div class="table-responsive m-t-20">
                            <table id="tblcurrency" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Symbol</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($currencies as $currency)
                                    <tr>
                                        <td>
                                            <img src="{{ image_url($currency->logo) }}" width="50px" height="50px">
                                        </td>
                                        <td>{{ $currency->name }}</td>
                                        <td>{{ $currency->symbol }}</td>
                                        <td>
                                            <div class="button-group">
                                                <button type="button" class="btn btn-info" onclick="openCurrency(this, true, {{ $currency->id }})"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger" onclick="deleteCurrency(this, {{ $currency->id }})"><i class="fa fa-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Markets</h4>
                    </div>
                    <div class="card-body">
                        <div class="button-group">
                            <button type="button" class="btn waves-effect waves-light btn-primary" onclick="openMarket(this, false)">Add</button>
                            <button type="button" class="btn waves-effect waves-light btn-danger">Delete</button>
                        </div>
                        <div class="table-responsive m-t-20">
                            <table id="tblmarket" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Currency</th>
                                    <th>Minimum Order</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($markets as $market)
                                    <tr>
                                        <td>{{ $market->name }}</td>
                                        <td>{{ $market->market_type }}</td>
                                        <td>{{ $market->currency->name }}</td>
                                        <td>{{ $market->minimum }}</td>
                                        <td>
                                            <div class="button-group">
                                                <button type="button" class="btn btn-info" onclick="openMarket(this, true, {{ $market->id }})"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger" onclick="deleteMarket(this, {{ $market->id }})"><i class="fa fa-remove"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{--<div class="row">--}}
                    {{--@foreach($apps as $app)--}}
                    {{--@if(in_array($app->id, explode(',', admin()->apps)))--}}
                    {{--<div class="col-lg-3 col-md-6">--}}
                        {{--<div class="card">--}}
                            {{--<img class="card-img-top img-responsive" src="{{ image_url($app->logo) }}" alt="Card image cap">--}}
                            {{--<div class="card-body">--}}
                                {{--<h4 class="card-title">{{$app->name}}</h4>--}}
                                {{--<button class="btn btn-block btn-primary" type="button" onclick="enterApp({{$app->uid}})">进入</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--@endif--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            </div>
        </div>
        <div id="currency-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Currency</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="currency-form" novalidate>
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group text-center">
                                <img class="text-center" src="" id="preview" width="150px" height="150px">
                                <div class="row text-center">
                                    <input type="file" class="input-image" id="logo" name="logo" onchange="selectImage(this)">
                                </div>
                            </div>
                            <div class="has-danger"><div id="currency-error" class="form-control-feedback"></div></div>
                            <div class="form-group">
                                <h5> Name : <span class="text-danger">*</span> </h5>
                                <div class="controls">
                                    <input type="text" class="form-control" id="name" name="name" required data-validation-required-message="required" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Symbol : <span class="text-danger">*</span> </h5>
                                <div class="input-group">
                                    <input type="text" id="symbol" name="symbol" class="form-control" required data-validation-required-message="required" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Info</h5>
                                <div class="input-group">
                                    <textarea class="form-control" name="info" id="info" rows="5" cols="80"></textarea>
                                </div>
                            </div>
                            <input id="currency_id" name="currency_id" type="hidden" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="market-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Market</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="market-form" novalidate>
                        <div class="modal-body">
                            <div class="form-group">
                                <h5> Type : <span class="text-danger">*</span> </h5>
                                <select id="type" name="type" class="selectpicker m-b-20 m-r-10" data-style="btn-primary">
                                    <option>Select symbol</option>
                                    <option data-tokens="BTC">BTC</option>
                                    <option data-tokens="ETH">ETH</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <h5>Symbol : <span class="text-danger">*</span> </h5>
                                <select id="currency" name="currency" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                <option>Select currency</option>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name.' ('.$currency->symbol.')'}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="has-danger"><div id="market-error" class="form-control-feedback"></div></div>
                            <input id="market_id" name="market_id" type="hidden" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('static/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('static/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('static/pages/base_material.js') }}"></script>
@endsection