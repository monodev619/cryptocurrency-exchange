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
                            <button type="button" class="btn waves-effect waves-light btn-primary" onclick="openCurrency()">Add</button>
                            <button type="button" class="btn waves-effect waves-light btn-danger">Delete</button>
                        </div>
                        <div class="table-responsive m-t-20">
                            <table id="tblcurrency" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Symbol</th>
                                        <th>Info</th>
                                        <th></th>
                                    </tr>
                                </thead>
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
                            <button type="button" class="btn waves-effect waves-light btn-primary">Add</button>
                            <button type="button" class="btn waves-effect waves-light btn-danger">Delete</button>
                        </div>
                        <div class="table-responsive m-t-20">
                            <table id="tblmarket" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Currency</th>
                                    <th>Minimum Order</th>
                                    <th></th>
                                </tr>
                                </thead>
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
                        <div class="modal-body">
                            <div class="form-group text-center">
                                <img class="text-center" src="" id="preview" width="150px" height="150px">
                                <div class="row text-center">
                                    <input type="file" class="input-image" id="logo" name="logo" onchange="selectImage(this)">
                                </div>
                            </div>
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
                    <form id="currency-form" novalidate>
                        <div class="modal-body">
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('static/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('static/pages/base_material.js') }}"></script>
@endsection