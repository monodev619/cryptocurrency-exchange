<template>
    <div class="mainmarket">
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <h4 class="card-title m-t-10">MARKETS</h4>
                <div class="table-responsive marketinfo">
                    <table id="tblemarket" class="table marketinfo table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>DATE</th>
                            <th>BUY/SELL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-on:click="gotoMarket(left_market.name)" v-for="left_market in left_markets">
                            <td>{{left_market.name}}</td>
                            <td class="text-danger">0.0000002995</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </aside>
        <div class="page-wrapper main-content tradingwindow">
            <div class="top-info row">
                <div class="col-md-2 col-lg-2 col-sm-12">
                    <div class="image"><img v-bind:src="currency ? currency.logo : ''" width="60" height="60"></div>
                    <div class="imageinfo">
                        <span class="coinname">{{currentMarketInfo ? currentMarketInfo['name'] : ''}}</span><br>
                        <span class="marketname">{{currency ? currency['name'] : ''}}</span>
                        <span class="marketname"></span>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 row">
                    <div class="current-info last">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{currentMarketInfo ? currentMarketInfo['last_price'] : 0}}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-red">{{currentMarketInfo ? currentMarketInfo['last_price'] : 0}}</span>
                        </div><br>
                        <div class="last-name">
                            LAST
                        </div>
                    </div>
                    <div class="current-info bid">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{currentMarketInfo ? currentMarketInfo['bid'] : 0}}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-green">{{currentMarketInfo ? currentMarketInfo['bid'] : 0}}</span>
                        </div><br>
                        <div class="last-name">
                            BID
                        </div>
                    </div>
                    <div class="current-info ask">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{currentMarketInfo ? currentMarketInfo['ask'] : 0}}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-red">{{currentMarketInfo ? currentMarketInfo['ask'] : 0}}</span>
                        </div><br>
                        <div class="last-name">
                            ASK
                        </div>
                    </div>
                    <div class=" current-info volume">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{currentMarketInfo ? currentMarketInfo['volume'] : 0}}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-green">{{currentMarketInfo ? currentMarketInfo['volume'] : 0}}</span>
                        </div><br>
                        <div class="last-name">
                            VOLUME
                        </div>
                    </div>
                    <div class="current-info hhigh">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{currentMarketInfo ? currentMarketInfo['high_24h'] : 0}}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-red">{{currentMarketInfo ? currentMarketInfo['high_24h'] : 0}}</span>
                        </div><br>
                        <div class="last-name">
                            24H HIGH
                        </div>
                    </div>
                    <div class="current-info hlow">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{currentMarketInfo ? currentMarketInfo['low_24h'] : 0}}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-red">{{currentMarketInfo ? currentMarketInfo['low_24h'] : 0}}</span>
                        </div><br>
                        <div class="last-name">
                            24H LOW
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 btndepwith" v-if="user">
                    <b-btn class="btn waves-effect waves-light btn-danger btnwithdraw" type="button"  v-b-tooltip.hover title="Withdraw" @click="showWithdraw">Withdraw</b-btn>
                    <b-btn class="btn waves-effect waves-light btn-success btndeposit" type="button"  v-b-tooltip.hover title="Deposit" @click="showDeposit">Deposit</b-btn>
                    <div id="withdraw-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Withdrawal</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>

                                <div class="modal-body">
                                    <div class="currency">
                                        <div class="col-xs-6">Currency</div>
                                    </div>
                                    <div class="current-currency withdraw">
                                        <div class="current-header row">
                                            <div class="col-sm-4"><span class="label-name">NAME</span></div>
                                            <div class="col-sm-4"><span class="symbol">SYMBOL</span> </div>
                                            <div class="col-sm-4"><span class="balance">AVAILABLE BALANCE</span></div>
                                        </div>
                                        <div><hr></div>
                                        <div class="current-body row">
                                            <div class="col-sm-4"><span class="coinname">{{currency ? currency['name'] : ''}}</span></div>
                                            <div class="col-sm-4"><span class="symbolname">{{currency ? currency['symbol'] : ''}}</span></div>
                                            <div class="col-sm-4"><span class="balancevalue">0</span></div>
                                        </div>
                                    </div>
                                    <div class="withdrawamount row">
                                        <h2 class="col-sm-12 withdraw-title">Withdrawal amount</h2>
                                        <div class="col-sm-6">QUANTITY</div>
                                        <div class="col-sm-6"><input type="text" class="quantityvalue" v-bind:value="0"><span class="cointype">{{currency ? currency['symbol'] : ''}}</span></div>
                                        <div class="col-sm-6">TRANSACTION FEE</div>
                                        <div class="col-sm-6"><span class="feevalue">0.00050000 &nbsp;{{currency ? currency['symbol'] : ''}}</span></div>
                                        <div class="col-sm-6">TOTAL WITHDRAWAL</div>
                                        <div class="col-sm-6"><span class="totalvalue">-0.00050000 &nbsp;{{currency ? currency['symbol'] : ''}}</span></div>
                                    </div>
                                    <div class="address withdraw">
                                        <span class="addr-title">Address</span><br>
                                        <input type="text" class="withdraw-addr-input" id="addr" placeholder="Error generating address">
                                    </div>
                                    <div class="de-instruct withdraw">
                                        <h2 class="title">DISCLAIMER</h2>
                                        <p class="instruct-content">Please verify your withdrawal address. We cannot refund an incorrect withdrawal.</p>
                                        <p>DO NOT WITHDRAW DIRECTLY TO A CROWDFUND OR ICO.</p>
                                        <p class="instruct-content">We will not credit your account with tokens from that sale.</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect cancel" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger waves-effect waves-light">{{currency ? currency['symbol'] : ''}}&nbsp; Withdraw</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="deposit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Deposit</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="currency">
                                        <div class="col-xs-6">Currency</div>
                                    </div>
                                    <div class="current-currency">
                                        <div class="current-header row">
                                            <div class="col-sm-6"><span class="label-name">NAME</span></div>
                                            <div class="col-sm-6"><span class="symbol">SYMBOL</span> </div>
                                        </div>
                                        <div><hr></div>
                                        <div class="current-body row">
                                            <div class="col-sm-6"><span class="coinname">Bitcoin</span></div>
                                            <div class="col-sm-6"><span class="symbolname">BTC</span></div>
                                        </div>
                                    </div>
                                    <div class="disclaimer">
                                        <div class="disc-title">DISCLAIMER</div>
                                        <p class="disc-content">I acknowledge the following information:<br>
                                            By depositing tokens to this address, you agree to our <a href="https://bittrex.zendesk.com/hc/en-us/articles/115000961172" target="_blank">deposit recovery policy</a>.
                                            Depositing tokens to an address other than BTC may result in your funds being lost.
                                        </p>
                                    </div>
                                    <div class="address">
                                        <span class="addr-title">Address</span><br>
                                        <input type="text" class="addr-input" id="addr" placeholder="Error generating address">
                                        <button class="addr-button">New Address</button>
                                    </div>
                                    <div class="de-instruct">
                                        <h2 class="title">DEPOSIT INSTRUCTIONS</h2>
                                        <p class="instruct-content">Depositing tokens to this address other than BTC will result in your funds being lost.</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger waves-effect waves-light">Done</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body entirechart">
                    <h4 class="card-title">Total Visits</h4>
                    <div id="entirechart" style="width:100%!important; height:410px"></div>
                </div>
                <div class="card-body volumechart">
                    <h4 class="card-title">Total Visits</h4>
                    <div id="volumechart" style="width:100%!important; height:115px;"></div>
                </div>
                <div class="row common-table-container">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <h4 class="card-title">ORDER BOOK</h4>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 sell-container">
                        <div class="table-responsive selltable">
                            <table id="tblselllist" class="table table-striped buyselltable">
                                <thead>
                                <tr>
                                    <th>SUM</th>
                                    <th>TOTAL</th>
                                    <th>SIZE({{marketName ? marketCurrencyName : ''}})</th>
                                    <th>BID({{marketName ? marketSymbolName : ''}})</th>
                                    <th class="tradebtn"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info"><b-btn class="btn-sell text-info" type="button"  v-b-tooltip.hover title="SELL" @click="showSellModal">SELL</b-btn></td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                <tr>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                    <td class="text-success">0.70794558</td>
                                    <td class="text-info">SELL</td>
                                </tr>
                                </tbody>
                            </table>
                            <div id="sell-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{marketName}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">QUANTITY</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketCurrencyName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">PRICE</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketSymbolName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">SUBTOTAL</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketSymbolName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">COMMISSION</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketSymbolName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency ">
                                                <div class="sellmodal current-header row total">
                                                    <div class="sellmodalname col-sm-6"><span class="">TOTAL</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketSymbolName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal comment current-header row">
                                                <div class="col-sm-3"><span class="label-name">MARKET</span>&nbsp;:&nbsp;<span class="label-content">{{marketName}}</span></div>
                                                <div class="col-sm-3"><span class="label-type">TYPE</span>&nbsp;:&nbsp;<span class="label-content">Limit Sell</span></div>
                                                <div class="col-sm-6"><span class="label-time">TIME IN FORCE</span>&nbsp;:&nbsp;<span class="label-content">Immediate or Cancel</span> </div>
                                            </div>
                                            <div class="sellmodal disclaimer">
                                                <div class="disc-title">DISCLAIMER</div>
                                                <p class="disc-content">Please verify this order before confirming. All orders are final once submitted and we will be unable to issue you a refund.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div id="buy-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{marketName}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">QUANTITY</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketCurrencyName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">PRICE</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketSymbolName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">SUBTOTAL</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketSymbolName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">COMMISSION</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketSymbolName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency ">
                                                <div class="sellmodal current-header row total">
                                                    <div class="sellmodalname col-sm-6"><span class="">TOTAL</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{marketSymbolName}}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal comment current-header row">
                                                <div class="col-sm-3"><span class="label-name">MARKET</span>&nbsp;:&nbsp;<span class="label-content">{{marketName}}</span></div>
                                                <div class="col-sm-3"><span class="label-type">TYPE</span>&nbsp;:&nbsp;<span class="label-content">Limit Sell</span></div>
                                                <div class="col-sm-6"><span class="label-time">TIME IN FORCE</span>&nbsp;:&nbsp;<span class="label-content">Immediate or Cancel</span> </div>
                                            </div>
                                            <div class="sellmodal disclaimer">
                                                <div class="disc-title">DISCLAIMER</div>
                                                <p class="disc-content">Please verify this order before confirming. All orders are final once submitted and we will be unable to issue you a refund.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 trade-container" v-if="user">
                        <div class="card-body">
                            <ul class="nav nav-pills m-t-20">
                                <li class="nav-item buy"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">BUY</a> </li>
                                <li class="nav-item sell"> <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">SELL</a> </li>
                            </ul>
                            <div class="tab-content br-n pn">
                                <div id="navpills-1" class="tab-pane active">
                                    <div class="row main-info">
                                        <div class="quantity">
                                            <span class="">ORDERTYPE</span><br>
                                            <select class="selectpicker color-dark" data-style="form-control btn-secondary">
                                                <option>Limit(Default)</option>
                                                <option>Conditional</option>
                                            </select>
                                            <!--<input type="text" id="ordertype" placeholder=" " class="form-control">-->
                                            <!--<span class="tradeordereth">ETH</span>-->
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity">
                                            <span class="">QUANTITY</span><br>
                                            <input type="text" id="buyquantity" placeholder=" " class="form-control">
                                            <span class="tradeordereth">{{marketCurrencyName}}</span>
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity">
                                            <span class="">BID PRICE</span><br>
                                            <select class="selectpicker color-dark" data-style="form-control btn-secondary" placeholder="aaa">
                                                <option>LAST</option>
                                                <option>BID</option>
                                                <option>ASK</option>
                                            </select><br>
                                            <input type="text" id="buyprice" placeholder=" " class="form-control">
                                            <span class="tradeordereth">{{marketSymbolName}}</span>
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity">
                                            <span class="">TOTAL</span><br>
                                            <input type="text" id="buytotal" placeholder=" " class="form-control">
                                            <span class="tradeordereth">{{marketSymbolName}}</span>
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity">
                                            <span class="">TIME IN FORCE</span><br>
                                            <select class="selectpicker color-dark" data-style="form-control btn-secondary">
                                                <option>Good 'Til Cancelled(Default)</option>
                                                <option>Immediate or Cancel</option>
                                            </select><br>
                                            <div class="line"></div>
                                        </div>
                                        <ul class="nav nav-pills success">
                                            <button type="button" class="btn waves-effect waves-light btn-block btn-red">BUY&nbsp;&nbsp;{{currency ? currency['name']:''}}</button>
                                        </ul>
                                    </div>
                                </div>
                                <div id="navpills-2" class="tab-pane">
                                    <div class="row main-info">
                                        <div class="quantity">
                                            <span class="">ORDERTYPE</span><br>
                                            <select class="selectpicker color-blue" data-style="form-control btn-secondary">
                                                <option>Limit(Default)</option>
                                                <option>Conditional</option>
                                            </select>
                                            <!--<span class="tradeordereth">ETH</span>-->
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity">
                                            <span class="">QUANTITY</span><br>
                                            <input type="text" id="sellquantity" placeholder=" " class="form-control">
                                            <span class="tradeordereth">{{marketCurrencyName}}</span>
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity">
                                            <span class="color-blue">ASK PRICE</span><br>
                                            <select class="selectpicker color-blue" data-style="form-control btn-secondary">
                                                <option>LAST</option>
                                                <option>BID</option>
                                                <option>ASK</option>
                                            </select><br>
                                            <input type="text" id="askprice" placeholder=" " class="form-control">
                                            <span class="tradeordereth">{{marketSymbolName}}</span>
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity">
                                            <span class="">TOTAL</span><br>
                                            <input type="text" id="selltotal" placeholder=" " class="form-control">
                                            <span class="tradeordereth">{{marketSymbolName}}</span>
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity">
                                            <span class="">TIME IN FORCE</span><br>
                                            <select class="selectpicker color-blue" data-style="form-control btn-secondary">
                                                <option>Good 'Til Cancelled(Default)</option>
                                                <option>Immediate or Cancel</option>
                                            </select><br>
                                            <div class="line"></div>
                                        </div>
                                        <ul class="nav nav-pills success">
                                            <button type="button" class="btn waves-effect waves-light btn-block btn-blue">SELL&nbsp;&nbsp;{{currency ? currency['name'] : ''}}</button>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 trade-container accounttrade" v-else>
                        <span class="tradeaccount">To begin trading please log in or create an account.</span>
                        <button type="button" class="btn waves-effect waves-light btn-block btn-blue accountbtn btn1"><router-link :to="{ name: 'register'}" class="accountbtn">Create Account</router-link></button>
                        <button type="button" class="btn waves-effect waves-light btn-block btn-blue accountbtn"><router-link :to="{ name: 'login'}" class="accountbtn">Log In</router-link></button>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 buy-container">
                        <div class="table-responsive buytable">
                            <table id="tblbuylist" class="table table-striped buyselltable">
                                <thead>
                                <tr>
                                    <th>ASK({{marketName ? marketSymbolName : ''}})</th>
                                    <th>SIZE({{marketName ? marketCurrencyName : ''}})</th>
                                    <th>TOTAL</th>
                                    <th>SUM</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-info"><b-btn class="btn-sell text-info" type="button" v-b-tooltip.hover title="BUY" @click="showBuyModal">BUY</b-btn></td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                <tr>
                                    <td class="text-info">BUY</td>
                                    <td class="text-danger">0.70794558</td>
                                    <td>0.0199</td>
                                    <td>0.0199</td>
                                    <td>11.089</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row markethistory">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-t-10">MARKET HISTORY</h4>
                                <div class="table-responsive m-t-20">
                                    <table id="tblemarkethistory" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>BUY/SELL</th>
                                            <th>BID/ASK</th>
                                            <th>TOTAL UNITS({{marketCurrencyName}})</th>
                                            <th>TOTAL COST({{marketSymbolName}})</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>0.7:0.2:0.6</td>
                                            <td class="text-danger">SELL</td>
                                            <td>0.00087172</td>
                                            <td>0.70794558</td>
                                            <td>0.00061713</td>
                                        </tr>
                                        <tr>
                                            <td>0.7:0.2:0.6</td>
                                            <td class="text-danger">SELL</td>
                                            <td>0.00087172</td>
                                            <td>0.70794558</td>
                                            <td>0.00061713</td>
                                        </tr>
                                        <tr>
                                            <td>0.7:0.2:0.6</td>
                                            <td class="text-success">SELL</td>
                                            <td>0.00087172</td>
                                            <td>0.70794558</td>
                                            <td>0.00061713</td>
                                        </tr>
                                        <tr>
                                            <td>0.7:0.2:0.6</td>
                                            <td class="text-success">SELL</td>
                                            <td>0.00087172</td>
                                            <td>0.70794558</td>
                                            <td>0.00061713</td>
                                        </tr>
                                        <tr>
                                            <td>0.7:0.2:0.6</td>
                                            <td class="text-danger">SELL</td>
                                            <td>0.00087172</td>
                                            <td>0.70794558</td>
                                            <td>0.00061713</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row wallets mainopenorder">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-t-10" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo22" aria-expanded="false" aria-controls="collapseTwo22" v-on:click="change_collpase1=!change_collpase1">
                                    <i class="fa fa-plus-square-o" v-if="change_collpase1"></i><i class="fa fa-minus-square-o" v-if="!change_collpase1"></i><span class="title1">MY OPEN ORDERS</span>
                                </h4>
                                <div class="table-responsive m-t-20 collapse" id="collapseTwo22" role="tabpanel" aria-labelledby="headingTwo22">
                                    <table id="tblopenorders" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ORDER DATE</th>
                                            <th>TYPE</th>
                                            <th>BID/ASK</th>
                                            <th>FILLED</th>
                                            <th>UNITS TOTAL</th>
                                            <th>ACTUAL RATE</th>
                                            <th>EST.TOTAL({{marketSymbolName}})</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Bitcoin</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                        </tr>
                                        <tr>
                                            <td>Bitcoin</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row wallets mainorderhistory">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-t-10" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo33" aria-expanded="false" aria-controls="collapseTwo33" v-on:click="change_collpase2=!change_collpase2">
                                    <i class="fa fa-plus-square-o" v-if="change_collpase2"></i><i class="fa fa-minus-square-o" v-if="!change_collpase2"></i><span class="title1">MY ORDER HISTORY</span>
                                </h4>
                                <div class="table-responsive m-t-20 collapse" id="collapseTwo33" role="tabpanel" aria-labelledby="headingTwo22">
                                    <table id="tblorderhistory" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>CLOSED DATE</th>
                                            <th>OPEN DATE</th>
                                            <th>TYPE</th>
                                            <th>UNITS FILLED({{this.marketCurrencyName}})</th>
                                            <th>TOTAL UNITS({{this.marketCurrencyName}})</th>
                                            <th>ACTUAL RATE</th>
                                            <th>COST/PROCEEDS</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Bitcoin</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                        </tr>
                                        <tr>
                                            <td>Bitcoin</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import '~/plugins/datatables/jquery.dataTables.min';
    import BootstrapVue from 'bootstrap-vue';
    import { mapGetters } from 'vuex';
    import axios from 'axios';
    import * as urls from '../../constants/url-constants';
    Vue.use(BootstrapVue);
    export default {
        name: "trading",
        middleware: 'auth',
        data: () => ({
            market_table: null,
            change_collpase1:true,
            change_collpase2:true,
            url: '',
            marketName: '',
            marketSymbolName: '',
            marketCurrencyName: '',
            currency: null,
            currencyName: null,
            currencies: null,
            imagelink: null,
            leftMarketList: null,
            currentMarketInfo: null,
        }),
        created() {
            this.marketName = this.$route.query.MarketName;
            this.marketSymbolName = this.marketName.split('-')[0];
            this.marketCurrencyName = this.marketName.split('-')[1];
        },
        mounted() {
            this.market_table = $('#tblemarket').DataTable();
            this.fetchMarket();
            this.fetchCurrency();
            this.fetchMarkets();
        },
        updated() {
            $('#tblselllist').DataTable();
            $('#tblbuylist').DataTable();
            $('#tblemarkethistory').DataTable();
            $('#tblopenorders').DataTable();
            $('#tblorderhistory').DataTable();
        },
        methods: {
            async fetchCurrency () {
                const { data } = await axios.get(urls.API_BASE_URL + '/_api/currency/' + this.marketCurrencyName);
                this.currency = data.data;
            },
            async fetchMarkets () {
                const { data } = await axios.get(urls.API_BASE_URL + '/_api/markets');
                this.leftMarketList = data.data[(this.marketSymbolName).toLowerCase()];
                await this.$store.dispatch('market/getLeftMarkets', {markets: this.leftMarketList});
                let vm = this;
                vm.market_table.clear();
                this.leftMarketList.forEach(function (market) {
                    vm.market_table.row.add([
                        market.name,
                        0.0002542
                    ]).draw(false);
                });

                vm.market_table.on('click', 'tr', function () {
                    vm.gotoMarket(vm.market_table.row(this).data()[0]);
                })
            },
            async fetchMarket () {
                const { data } = await axios.get(urls.API_BASE_URL + '/_api/market' + '/' + this.marketName);
                this.currentMarketInfo = data.data;
            },
            gotoMarket (param) {
                this.marketName = '';
                this.marketSymbolName = '';
                this.marketCurrencyName = '';
                this.$router.push({ name: 'trading', query: {MarketName: param}});
                this.marketName = param;
                console.log(this.marketName);
                this.marketSymbolName = param.split('-')[0];
                this.marketCurrencyName = param.split('-')[1];
                this.fetchCurrency();
                this.fetchMarkets();
                this.fetchMarket();
                $('#tblselllist').dataTable();
                $('#tblbuylist').dataTable();
                $('#tblemarket').dataTable();
                $('#tblemarkethistory').dataTable();
                $('#tblopenorders').dataTable();
                $('#tblorderhistory').dataTable();
            },
            showSellModal() {
                $('#sell-modal').modal();
            },
            showBuyModal() {
                $('#buy-modal').modal();
            },
            showWithdraw() {
                $('#withdraw-modal').modal();
            },
            showDeposit() {
                $('#deposit-modal').modal();
            }
        },
        computed: mapGetters ({
            user: 'auth/user',
            left_markets: 'market/left_markets',
        })
    }
</script>

<style scoped>
</style>