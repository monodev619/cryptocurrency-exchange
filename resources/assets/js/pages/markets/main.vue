<template>
    <div class="mainmarket">
        <loading :active.sync="isLoading" :can-cancel="false" ></loading>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <h4 class="card-title m-t-10">MARKETS</h4>
                <div>
                    <select id="market-type" name="market-type" required class="selectpicker m-r-10" v-model="market_type" @change="changeMarket" data-style="btn-info btn-outline-info">
                        <option value="btc">BTC Market</option>
                        <option value="eth">ETH Market</option>
                    </select>
                </div>
                <div id="btc-markets" class="table-responsive marketinfo">
                    <table id="tblbtcmarket" class="table marketinfo table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>DATE</th>
                            <th>BUY/SELL</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="eth-markets" class="table-responsive marketinfo">
                    <table id="tblethmarket" class="table marketinfo table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>DATE</th>
                            <th>BUY/SELL</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </aside>
        <div class="page-wrapper main-content tradingwindow">
            <div class="top-info row">
                <div class="col-md-2 col-lg-2 col-sm-12">
                    <div class="image"><img v-bind:src="market_info ? market_info.logo : ''" width="60" height="60"></div>
                    <div class="imageinfo">
                        <span class="coinname">{{ market_info ? market_info.currency : '' }}</span><br>
                        <span class="marketname">{{ market_info ? market_info.name : '' }}</span>
                        <span class="marketname"></span>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 row">
                    <div class="current-info last">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{ market_info ? market_info.last_price : 0 }}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-red">{{market_info ? market_info.last_price : 0 }}</span>
                        </div><br>
                        <div class="last-name">
                            LAST
                        </div>
                    </div>
                    <div class="current-info bid">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{ market_info ? market_info.bid : 0 }}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-green">{{ market_info ? market_info.bid : 0 }}</span>
                        </div><br>
                        <div class="last-name">
                            BID
                        </div>
                    </div>
                    <div class="current-info ask">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{ market_info ? market_info.ask : 0 }}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-red">{{ market_info ? market_info.ask : 0 }}</span>
                        </div><br>
                        <div class="last-name">
                            ASK
                        </div>
                    </div>
                    <div class=" current-info volume">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{ market_info ? market_info.volume : 0 }}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-green">{{ market_info ? market_info.volume : 0 }}</span>
                        </div><br>
                        <div class="last-name">
                            VOLUME
                        </div>
                    </div>
                    <div class="current-info hhigh">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{ market_info ? market_info.high_24h : 0 }}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-red">{{ market_info ? market_info.high_24h : 0 }}</span>
                        </div><br>
                        <div class="last-name">
                            24H HIGH
                        </div>
                    </div>
                    <div class="current-info hlow">
                        <div class="last-usd">
                            <i class="fa fa-usd"></i>
                            <span class="last-usd-value">{{ market_info ? market_info.low_24h : 0 }}</span>
                        </div><br>
                        <div class="last-bitcoin">
                            <i class="fa fa-bitcoin"></i>
                            <span class="last-usd-value color-red">{{ market_info ? market_info.low_24h : 0 }}</span>
                        </div><br>
                        <div class="last-name">
                            24H LOW
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 btndepwith" v-if="user">
                    <div class="button">
                        <b-btn class="waves-effect waves-light btn-danger btnwithdraw" type="button"  v-b-tooltip.hover title="Withdraw" @click="showWithdraw">Withdraw</b-btn>
                        <b-btn class="waves-effect waves-light btn-success btndeposit" type="button"  v-b-tooltip.hover title="Deposit" @click="showDeposit">Deposit</b-btn>
                    </div>
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
                                            <div class="col-sm-4"><span class="coinname">{{ market_info ? market_info.currency : 0 }}</span></div>
                                            <div class="col-sm-4"><span class="symbolname">{{ market_info ? market_info.symbol : 0 }}</span></div>
                                            <div class="col-sm-4"><span class="balancevalue">0</span></div>
                                        </div>
                                    </div>
                                    <div class="withdrawamount row">
                                        <h2 class="col-sm-12 withdraw-title">Withdrawal amount</h2>
                                        <div class="col-sm-6">QUANTITY</div>
                                        <div class="col-sm-6"><input type="text" class="quantityvalue" v-bind:value="0"><span class="cointype">{{ market_info ? market_info.symbol : 0 }}</span></div>
                                        <div class="col-sm-6">TRANSACTION FEE</div>
                                        <div class="col-sm-6"><span class="feevalue">0.00050000 &nbsp;{{ market_info ? market_info.symbol : 0 }}</span></div>
                                        <div class="col-sm-6">TOTAL WITHDRAWAL</div>
                                        <div class="col-sm-6"><span class="totalvalue">-0.00050000 &nbsp;{{ market_info ? market_info.symbol : 0 }}</span></div>
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
                                    <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn  waves-effect waves-light perform">{{ market_info ? market_info.symbol : 0 }}&nbsp; Withdraw</button>
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
                                            <div class="col-sm-6"><span class="coinname">{{ market_info ? market_info.currency : 0 }}</span></div>
                                            <div class="col-sm-6"><span class="symbolname">{{ market_info ? market_info.symbol : 0 }}</span></div>
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
                                    <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn waves-effect waves-light perform">Done</button>
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
                        <h3 class="card-title">ORDER BOOK</h3>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 sell-container">
                        <div class="table-responsive selltable">
                            <table id="tblselllist" class="table table-striped buyselltable">
                                <thead>
                                <tr>
                                    <th>SUM</th>
                                    <th>TOTAL</th>
                                    <th>SIZE({{ market_info ? market_info.symbol : 0 }})</th>
                                    <th>BID({{ market_info ? market_info.type : 0 }})</th>
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
                                            <h4 class="modal-title">{{ market_info ? market_info.name : 0 }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">QUANTITY</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.symbol : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">PRICE</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">SUBTOTAL</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">COMMISSION</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency ">
                                                <div class="sellmodal current-header row total">
                                                    <div class="sellmodalname col-sm-6"><span class="">TOTAL</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal comment current-header row">
                                                <div class="col-sm-3"><span class="label-name">MARKET</span>&nbsp;:&nbsp;<span class="label-content">{{ market_info ? market_info.name : 0 }}</span></div>
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
                                            <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn waves-effect waves-light perform">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="buy-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{ market_info ? market_info.name : 0 }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">QUANTITY</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.symbol : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">PRICE</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">SUBTOTAL</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency">
                                                <div class="sellmodal current-header row">
                                                    <div class="sellmodalname col-sm-6"><span class="">COMMISSION</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal current-currency ">
                                                <div class="sellmodal current-header row total">
                                                    <div class="sellmodalname col-sm-6"><span class="">TOTAL</span></div>
                                                    <div class="col-sm-6"><span class="sellmodalvalue color-green">0.00000000</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                </div>
                                                <div><hr></div>
                                            </div>
                                            <div class="sellmodal comment current-header row">
                                                <div class="col-sm-3"><span class="label-name">MARKET</span>&nbsp;:&nbsp;<span class="label-content">{{ market_info ? market_info.name : 0 }}</span></div>
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
                                            <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn waves-effect waves-light perform">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 trade-container" v-if="user">
                        <div class="card-body">
                            <ul class="nav nav-pills m-t-20">
                                <li class="nav-item buy"> <a href="#navpills-1" class="nav-link first active" data-toggle="tab" aria-expanded="false" v-on:click="setBidAsk('bid')">BUY</a> </li>
                                <li class="nav-item sell"> <a href="#navpills-2" class="nav-link second" data-toggle="tab" aria-expanded="false" v-on:click="setBidAsk('ask')">SELL</a> </li>
                            </ul>
                            <div class="tab-content">
                                <div id="navpills-1" class="tab-pane active">
                                    <div class="row main-info">
                                            <div class="quantity type1">
                                                <span class="quantitytitle">ORDERTYPE</span><br>
                                                <select id="buyordertype" name="buyordertype" v-model="form_Order.order_type" class="selectpicker color-dark" data-style="form-control btn-secondary">
                                                    <option value="Limit">Limit(Default)</option>
                                                    <option value="Conditional">Conditional</option>
                                                </select>
                                                <div class="line"></div>
                                            </div>
                                            <div class="quantity">
                                                <span class="quantitytitle">QUANTITY</span><br>
                                                <input type="text" id="buyquantity" name="buyquantity" v-model="form_Order.quantity" placeholder=" " class="form-control inputvalue">
                                                <span class="tradeordereth">{{ market_info ? market_info.symbol : 0 }}</span>
                                                <div class="line"></div>
                                            </div>
                                            <div class="quantity type2">
                                                <span class="quantitytitle">BID PRICE</span><br>
                                                <select id="buybidselect" name="buybidselect" v-model="bidType" class="selectpicker color-dark" data-style="form-control btn-secondary" placeholder="">
                                                    <option value="last">LAST</option>
                                                    <option value="bid">BID</option>
                                                    <option value="ask">ASK</option>
                                                </select><br>
                                                <input type="text" id="buybidvalue" name="buybidvalue" v-model="form_Order.price" placeholder=" " class="form-control inputvalue">
                                                <span class="tradeordereth">{{ market_info ? market_info.type : 0 }}</span>
                                                <div class="line"></div>
                                            </div>

                                            <div class="condition" v-if="this.form_Order.order_type == 'Conditional'">
                                                <div class="quantity type2 buycond">
                                                    <span class="quantitytitle">CONDITION</span><br>
                                                    <select id="buycondition" name="buycondition" v-model="form_Order.condition" class="selectpicker color-dark" data-style="form-control btn-secondary" placeholder="">
                                                        <option value="None">None</option>
                                                        <option value="Greater Than Or Equal To">Greater Than Or Equal To</option>
                                                        <option value="Less Than Or Equal To">Less Than Or Equal To</option>
                                                    </select><br>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="quantity target">
                                                    <span class="quantitytitle">TARGET PRICE</span><br>
                                                    <input type="text" id="buytargetprice" name="buytargetprice" v-model="form_Order.target_price" placeholder=" " class="form-control inputvalue">
                                                    <span class="tradeordereth">{{ market_info ? market_info.type : 0 }}</span>
                                                    <div class="line"></div>
                                                </div>
                                            </div>

                                            <div class="quantity">
                                                <span class="quantitytitle">TOTAL</span><br>
                                                <input type="text" id="buytotal" name="buytotal" v-model="form_Order.total" placeholder=" " class="form-control inputvalue">
                                                <span class="tradeordereth">{{ market_info ? market_info.type : 0 }}</span>
                                                <div class="line"></div>
                                            </div>
                                            <div class="quantity type3">
                                                <span class="quantitytitle">TIME IN FORCE</span><br>
                                                <select id="buytimeinforce" name="buytimeinforce" v-model="form_Order.timeinforce" class="selectpicker color-dark" data-style="form-control btn-secondary">
                                                    <option value="Good Til Canceled">Good 'Til Cancelled(Default)</option>
                                                    <option value="Immediate Or Cancel">Immediate or Cancel</option>
                                                </select><br>
                                                <div class="line"></div>
                                            </div>
                                            <ul class="nav nav-pills success">
                                                <button id="buybtn" type="button" class="btn waves-effect waves-light btn-block" @click="showBuyFail">BUY&nbsp;&nbsp;{{ market_info ? market_info.currency : 0 }}</button>
                                            </ul>
                                    </div>
                                </div>
                                <div id="navpills-2" class="tab-pane">
                                    <div class="row main-info">
                                        <div class="quantity type1">
                                            <span class="quantitytitle">ORDERTYPE</span><br>
                                            <select id="sellordertype" name="sellordertype" v-model="form_Order.order_type" class="selectpicker color-blue" data-style="form-control btn-secondary">
                                                <option value="Limit">Limit(Default)</option>
                                                <option value="Conditional">Conditional</option>
                                            </select>
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity">
                                            <span class="quantitytitle">QUANTITY</span><br>
                                            <input type="text" id="sellquantity" name="sellquantity" v-model="form_Order.quantity" placeholder=" " class="form-control inputvalue">
                                            <span class="tradeordereth">{{ market_info ? market_info.symbol : 0 }}</span>
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity type2">
                                            <span class="quantitytitle">ASK PRICE</span><br>
                                            <select id="sellaskprice" name="sellaskprice" v-model="bidType" class="selectpicker color-blue" data-style="form-control btn-secondary">
                                                <option value="last">LAST</option>
                                                <option value="bid">BID</option>
                                                <option value="ask">ASK</option>
                                            </select><br>
                                            <input type="text" id="askprice" v-model="form_Order.price" placeholder=" " class="form-control inputvalue">
                                            <span class="tradeordereth">{{ market_info ? market_info.type : 0 }}</span>
                                            <div class="line"></div>
                                        </div>

                                        <div class="condition" v-if="this.form_Order.order_type == 'Conditional'">
                                            <div class="quantity type2 buycond">
                                                <span class="quantitytitle">CONDITION</span><br>
                                                <select id="sellcondition" name="sellcondition" v-model="form_Order.condition" class="selectpicker color-dark" data-style="form-control btn-secondary" placeholder="">
                                                    <option value="none">None</option>
                                                    <option value="Greater Than Or Equal To">Greater Than Or Equal To</option>
                                                    <option value="Less Than Or Equal To">Less Than Or Equal To</option>
                                                </select><br>
                                                <div class="line"></div>
                                            </div>
                                            <div class="quantity 3">
                                                <span class="quantitytitle">TARGET PRICE</span><br>
                                                <input type="text" id="selltargetprice" name="buytargetprice" v-model="form_Order.target_price" placeholder=" " class="form-control inputvalue">
                                                <span class="tradeordereth">{{ market_info ? market_info.type : 0 }}</span>
                                                <div class="line"></div>
                                            </div>
                                        </div>

                                        <div class="quantity">
                                            <span class="quantitytitle">TOTAL</span><br>
                                            <input type="text" id="selltotal" v-model="form_Order.total" name="selltotal" placeholder=" " class="form-control inputvalue">
                                            <span class="tradeordereth">{{ market_info ? market_info.type : 0 }}</span>
                                            <div class="line"></div>
                                        </div>
                                        <div class="quantity type3">
                                            <span class="quantitytitle">TIME IN FORCE</span><br>
                                            <select id="selltimeinforce" name="selltimeinforce" v-model="form_Order.timeinforce" class="selectpicker color-blue" data-style="form-control btn-secondary">
                                                <option value="Good Til Canceled">Good 'Til Cancelled(Default)</option>
                                                <option value="Immediate Or Cancel">Immediate or Cancel</option>
                                            </select><br>
                                            <div class="line"></div>
                                        </div>
                                        <ul class="nav nav-pills success">
                                            <button id="sellbtn" type="submit" class="btn waves-effect waves-light btn-block btn-active" @click="showSellFail">SELL&nbsp;&nbsp;{{ market_info ? market_info.currency : 0 }}</button>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="buy-fail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><i class="fa fa-warning"></i>&nbsp;Buy Failed</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="sellmodal disclaimer">
                                                <div class="disc-title">The following errors were encountered.</div>
                                                <ul class="error-list">
                                                    <li class="error-list-item">The minimum Order size is 0.05</li>
                                                    <li class="error-list-item">The minimum Bids size is 0.01</li>
                                                </ul>
                                                <div class="disc-title">Please correct these issues and try again.</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="buy-modal-content" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <form class="form-width" @submit.prevent="requestOrder" @keydown="form_Order.onKeydown($event)">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ market_info ? market_info.name : 0 }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirm Your Limit Buy Order</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="sellmodal current-currency">
                                                    <div class="sellmodal current-header row">
                                                        <div class="sellmodalname col-sm-6"><span class="">QUANTITY</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(form_Order.quantity).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.symbol : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal current-currency">
                                                    <div class="sellmodal current-header row">
                                                        <div class="sellmodalname col-sm-6"><span class="">PRICE</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(form_Order.price).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal current-currency">
                                                    <div class="sellmodal current-header row">
                                                        <div class="sellmodalname col-sm-6"><span class="">SUBTOTAL</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(this.subTotal).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal current-currency">
                                                    <div class="sellmodal current-header row">
                                                        <div class="sellmodalname col-sm-6"><span class="">COMMISSION</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(form_Order.fee).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal current-currency ">
                                                    <div class="sellmodal current-header row total">
                                                        <div class="sellmodalname col-sm-6"><span class="">TOTAL</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(form_Order.total).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal comment current-header row">
                                                    <div class="col-sm-3"><span class="label-name">MARKET</span>&nbsp;:&nbsp;<span class="label-content">{{ market_info ? market_info.name : 0 }}</span></div>
                                                    <div class="col-sm-3"><span class="label-type">TYPE</span>&nbsp;:&nbsp;<span class="modaltype">{{  this.form_Order.order_type }}</span></div>
                                                    <div class="col-sm-6"><span class="label-time">TIME IN FORCE</span>&nbsp;:&nbsp;<span class="modaltimeinforce">{{ this.form_Order.timeinforce }}</span></div>
                                                </div>
                                                <div class="sellmodal disclaimer">
                                                    <div class="disc-title">DISCLAIMER</div>
                                                    <p class="disc-content">Please verify this order before confirming. All orders are final once submitted and we will be unable to issue you a refund.
                                                    </p>
                                                </div>
                                            </div>
                                            <input class="buybalance" name="fee" v-model="form_Order.fee" type="hidden">
                                            <input class="buybalance" name="balance" v-model="form_Order.balance" type="hidden">
                                            <input class="buystatus" name="status" v-model="form_Order.status" type="hidden">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn waves-effect waves-light perform">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="sell-fail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><i class="fa fa-warning"></i>&nbsp;Sell Failed</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="sellmodal disclaimer">
                                                <div class="disc-title">The following errors were encountered.</div>
                                                <ul class="error-list">
                                                    <li class="error-list-item">Asks must be greater than 0.05 for limit orders</li>
                                                    <li class="error-list-item">The minimum order size is 0.1</li>
                                                </ul>
                                                <div class="disc-title">Please correct these issues and try again.</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="sell-modal-content" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <form class="form-width" @submit.prevent="requestOrder" @keydown="form_Order.onKeydown($event)">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ market_info ? market_info.name : 0 }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirm Your Limit Sell Order</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="sellmodal current-currency">
                                                    <div class="sellmodal current-header row">
                                                        <div class="sellmodalname col-sm-6"><span class="">QUANTITY</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(form_Order.quantity).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.symbol : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal current-currency">
                                                    <div class="sellmodal current-header row">
                                                        <div class="sellmodalname col-sm-6"><span class="">PRICE</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(form_Order.price).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal current-currency">
                                                    <div class="sellmodal current-header row">
                                                        <div class="sellmodalname col-sm-6"><span class="">SUBTOTAL</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(this.subTotal).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal current-currency">
                                                    <div class="sellmodal current-header row">
                                                        <div class="sellmodalname col-sm-6"><span class="">COMMISSION</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(form_Order.fee).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal current-currency ">
                                                    <div class="sellmodal current-header row total">
                                                        <div class="sellmodalname col-sm-6"><span class="">TOTAL</span></div>
                                                        <div class="col-sm-6"><span class="sellmodalvalue color-green">{{ parseFloat(form_Order.total).toFixed(8) }}</span>&nbsp;&nbsp;<span class="sellmodalcoin">{{ market_info ? market_info.type : 0 }}</span></div>
                                                    </div>
                                                    <div><hr></div>
                                                </div>
                                                <div class="sellmodal comment current-header row">
                                                    <div class="col-sm-3"><span class="label-name">MARKET</span>&nbsp;:&nbsp;<span class="label-content">{{ market_info ? market_info.name : 0 }}</span></div>
                                                    <div class="col-sm-3"><span class="label-type">TYPE</span>&nbsp;:&nbsp;<span class="label-content">{{ this.form_Order.order_type }}&nbsp;</span></div>
                                                    <div class="col-sm-6"><span class="label-time">TIME IN FORCE</span>&nbsp;:&nbsp;<span class="label-content">{{ this.form_Order.timeinforce }}</span> </div>
                                                </div>
                                                <div class="sellmodal disclaimer">
                                                    <div class="disc-title">DISCLAIMER</div>
                                                    <p class="disc-content">Please verify this order before confirming. All orders are final once submitted and we will be unable to issue you a refund.
                                                    </p>
                                                </div>
                                            </div>
                                            <input class="buyorder" name="fee" v-model="form_Order.fee" type="hidden">
                                            <input class="buybalance" name="balance" v-model="form_Order.balance" type="hidden">
                                            <input class="buystatus" name="status" v-model="form_Order.status" type="hidden">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn waves-effect waves-light perform">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 trade-container accounttrade" v-else>
                        <span class="tradeaccount">To begin trading please log in or create an account.</span>
                        <button type="button" class="btn waves-effect waves-light btn-block btn-blue accountbtn btn1"><router-link :to="{ name: 'register'}" class="accountbtn">Create Account</router-link></button>
                        <button type="button" class="btn waves-effect waves-light btn-block btn-blue accountbtn"><router-link :to="{ name: 'login'}" class="accountbtn">Log In</router-link></button>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 buy-container">
                        <div class="table-responsive buytable">
                            <table id="tblbuylist" class="table table-striped buyselltable">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>ASK({{ market_info ? market_info.type : 0 }})</th>
                                    <th>SIZE({{ market_info ? market_info.symbol : 0 }})</th>
                                    <th>TOTAL</th>
                                    <th>SUM</th>
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
                                <h3 class="card-title m-t-10">MARKET HISTORY</h3>
                                <div class="table-responsive m-t-20">
                                    <table id="tblemarkethistory" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>BUY/SELL</th>
                                            <th>BID/ASK</th>
                                            <th>TOTAL UNITS({{ market_info ? market_info.symbol : 0 }})</th>
                                            <th>TOTAL COST({{ market_info ? market_info.type : 0 }})</th>
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
                                <h3 class="card-title m-t-10" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo22" aria-expanded="false" aria-controls="collapseTwo22" v-on:click="change_collpase1=!change_collpase1">
                                    <i class="fa fa-plus-square-o" v-if="change_collpase1"></i><i class="fa fa-minus-square-o" v-if="!change_collpase1"></i><span class="title1">MY OPEN ORDERS</span>
                                </h3>
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
                                            <th>EST.TOTAL({{ market_info ? market_info.type : 0 }})</th>
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
                <div class="row wallets mainorderhistory">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title m-t-10" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo33" aria-expanded="false" aria-controls="collapseTwo33" v-on:click="change_collpase2=!change_collpase2">
                                    <i class="fa fa-plus-square-o" v-if="change_collpase2"></i><i class="fa fa-minus-square-o" v-if="!change_collpase2"></i><span class="title1">MY ORDER HISTORY</span>
                                </h3>
                                <div class="table-responsive m-t-20 collapse" id="collapseTwo33" role="tabpanel" aria-labelledby="headingTwo22">
                                    <table id="tblorderhistory" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>CLOSED DATE</th>
                                            <th>OPEN DATE</th>
                                            <th>TYPE</th>
                                            <th>UNITS FILLED({{ market_info ? market_info.symbol : 0 }})</th>
                                            <th>TOTAL UNITS({{ market_info ? market_info.symbol : 0 }})</th>
                                            <th>ACTUAL RATE</th>
                                            <th>COST/PROCEEDS</th>
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
        </div>
    </div>
</template>

<script>
    import Form from 'vform';
    import swal from 'sweetalert2'
    import i18n from '~/plugins/i18n'
    import Loading from 'vue-loading-overlay';
    import '~/plugins/datatables/jquery.dataTables.min';
    import '~/plugins/bootstrap-select/bootstrap-select.min';
    import '~/plugins/bootstrap-select/bootstrap-select.min.css';
    import BootstrapVue from 'bootstrap-vue';

    import { mapGetters } from 'vuex';
    import axios from 'axios';
    import * as codes from '~/constants/response-codes';
    import * as urls from '../../constants/url-constants';
    import 'vue-loading-overlay/dist/vue-loading.min.css';
    Vue.use(BootstrapVue);

    export default {
        name: "trading",
        middleware: 'auth',
        components: {Loading},

        data: () => ({
            btc_market_table: null,
            eth_market_table: null,
            market_info: null,
            change_collpase1:true,
            change_collpase2:true,
            market_type: 'btc',
            isLoading: false,
            bidType: '',
            order_history_table: null,
            openOrder_table: null,
            subTotal: 0,
            commission: 0,

            form_Order: new Form({
                user_id: 0,
                market_id: 0,
                order_type: '',
                quantity: 0,
                bidask: '',
                price: 0,
                condition: '',
                target_price: 0,
                total: 0,
                timeinforce: '',
                fee: 0,
                balance: 0,
                status
            })
        }),

        created() {
            this.order_history_table = null,
            this.openOrder_table = null,
            this.form_Order.order_type = 'Limit',
            this.form_Order.bidask = 'bid',
            this.form_Order.condition = 'None',
            this.form_Order.timeinforce = 'Good Til Canceled',
            this.form_Order.fee = 0,
            this.form_Order.balance = 100,
            this.form_Order.status = 'opened'
            this.commission = 0.0025

        },

        mounted() {
            $('.selectpicker').selectpicker();
            this.btc_market_table = $('#tblbtcmarket').DataTable();
            this.eth_market_table = $('#tblethmarket').DataTable();
            this.order_history_table = $('#tblorderhistory').DataTable();
            this.openOrder_table = $('#tblopenorders').DataTable();

            $('#eth-markets').hide();

            this.fetchMarket();
            this.fetchMarkets();

        },

        updated() {

            $('#tblselllist').DataTable();
            $('#tblbuylist').DataTable();
            $('#tblemarkethistory').DataTable();
            $('.selectpicker').selectpicker('refresh');

        },

        watch: {
            $route (to, from) {
                this.fetchMarket();
            },

        },

        methods: {

            async fetchMarkets () {
                const { data } = await axios.get(urls.API_BASE_URL + '/_api/markets');
                await this.$store.dispatch('market/getMarkets', {markets: data.data});

                let vm = this;
                vm.btc_market_table.clear();
                this.$store.getters['market/btc_markets'].forEach(function (market) {
                    vm.btc_market_table.row.add([
                        market.name,
                        0.0002542
                    ]).draw(false);
                });

                vm.btc_market_table.on('click', 'tr', function () {
                    vm.gotoMarket(vm.btc_market_table.row(this).data()[0]);
                })

                vm.eth_market_table.clear();
                this.$store.getters['market/eth_markets'].forEach(function (market) {
                    vm.eth_market_table.row.add([
                        market.name,
                        0.0002542
                    ]).draw(false);
                });

                vm.eth_market_table.on('click', 'tr', function () {
                    vm.gotoMarket(vm.eth_market_table.row(this).data()[0]);

                })
            },

            async fetchMarket () {
                const { data } = await axios.get(urls.API_BASE_URL + '/_api/market' + '/' + this.$route.query.MarketName);
                this.market_info = data.data;
                let vm = this;

                this.openOrder_table.clear().draw();
                this.order_history_table.clear().draw();
                vm.getOrders();
                vm.getOpenOrders();
            },

            gotoMarket (param) {
                this.$router.push({ name: 'trading', query: {MarketName: param}});
            },

            showSellModal () {
                $('#sell-modal').modal();
            },

            showBuyModal () {
                $('#buy-modal').modal();
            },

            showWithdraw () {
                $('#withdraw-modal').modal();
            },

            showDeposit () {
                $('#deposit-modal').modal();
            },

            changeMarket () {
                if (this.market_type == 'btc') {
                    $('#btc-markets').show();
                    $('#eth-markets').hide();
                } else {
                    $('#btc-markets').hide();
                    $('#eth-markets').show();
                }
            },

            showBuyFail () {
                if ((!this.form_Order.quantity)||(this.form_Order.quantity < 0.05)||(!this.form_Order.price)||(this.form_Order.price < 0.01)) {

                    $('#buy-fail').modal();
                    $('#buy-modal-content').hide();
                } else {
                    let vm = this;
                    this.form_Order.total = this.form_Order.quantity * this.form_Order.price + this.form_Order.price * this.commission;
                    vm.subTotal = this.form_Order.quantity * this.form_Order.price;
                    this.form_Order.fee = this.form_Order.total - vm.subTotal;
                    $('#buy-fail').hide();
                    $('#buy-modal-content').modal();
                }
            },

            showSellFail () {
                if ((!this.form_Order.quantity)||(this.form_Order.quantity < 0.05)||(!this.form_Order.price)||(this.form_Order.price < 0.01)) {

                    $('#sell-fail').modal();
                    $('#sell-modal-content').hide();
                } else {
                    let vm = this;
                    this.form_Order.total = this.form_Order.quantity * this.form_Order.price + this.commission * this.form_Order.price;
                    vm.subTotal = this.form_Order.quantity * this.form_Order.price;
                    this.form_Order.fee = this.form_Order.total - vm.subTotal;

                    $('#sell-fail').hide();
                    $('#sell-modal-content').modal();
                }
            },

            setBidAsk (param) {
              let vm = this;
              this.form_Order.bidask = param;
            },


            async requestOrder() {

                let vm = this;
                this.form_Order.user_id = vm.user.id;
                this.form_Order.market_id = vm.market_info.id;
                if ((this.form_Order.order_type == 'Limit')) {
                    this.form_Order.condition = 'None';
                    this.form_Order.target_price = 0;
                }
                this.isLoading = true;
                this.addOrderTableRowHtml = '';
                this.addOpenTableRowHtml = '';

                const {data} = await this.form_Order.post(urls.API_BASE_URL + '/_api/requestOrder');
                this.isLoading = false;
                if (data.code == codes.SUCCESS) {
                    $('#tblorderhistory .dataTables_empty').remove();
                    this.addOrderTableRowHtml = '<tr role="row" class="odd"><td class="sorting_1">' + data.data.updated_at.date + '</td><td>' + data.data.created_at.date +
                        '</td><td>' + data.data.order_type + '</td><td>' + 0.2356 + '</td><td>' + data.data.total + '</td><td>' + 0.236 + '</td><td>' + 0.0001 + '</td></tr>';
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    toast({
                        type: 'success',
                        title: 'Order has been entered successfully.'
                    });
                    if (data.data.status == 'opened') {
                        $('#tblopenorders .dataTables_empty').remove();
                        this.addOpenTableRowHtml = '<tr role="row" class="odd"><td class="sorting_1">' + data.data.created_at.date + '</td><td>' + data.data.order_type +
                            '</td><td>' + data.data.bidask + '</td><td>' + 0.2356 + '</td><td>' + data.data.total + '</td><td>' + 0.236 + '</td><td>' + 0.0001 + '</td></tr>';
                        $('#tblopenorders').append(this.addOpenTableRowHtml);
                    }
                    $('#tblorderhistory').append(this.addOrderTableRowHtml);

                    this.form_Order.price = 0;
                    this.form_Order.quantity = 0;
                    this.form_Order.total = 0;
                    this.form_Order.target_price = 0;
                    this.form_Order.fee = 0;
                    vm.subTotal = 0;

                    $('#buy-modal-content').modal('hide');
                    $('#sell-modal-content').modal('hide');
                }
            },

            async getOrders() {
                let vm = this;
                const { data } = await axios.get(urls.API_BASE_URL + '/_api/Orders?user_id=' + vm.user.id + '&market_id=' + vm.market_info.id );
                await this.$store.dispatch('order/getOrders', {res: data.data})
                vm.order_history_table.clear();
                this.orders.forEach(function (order) {
                    vm.order_history_table.row.add([
                        order.close_date.date,
                        order.open_date.date,
                        order.type,
                        0.0000000,
                        order.total_units,
                        154800,
                        0.23656
                    ]).draw(false);
                })
            },

            async getOpenOrders() {
                let vm = this;
                const { data } = await axios.get(urls.API_BASE_URL + '/_api/openOrders?user_id=' + vm.user.id + '&market_id=' + vm.market_info.id );
                await this.$store.dispatch('order/getOpenOrders', {res: data.data})
                vm.openOrder_table.clear();
                this.open_orders.forEach(function (order) {
                    vm.openOrder_table.row.add([
                        order.order_date.date,
                        order.type,
                        order.bidask,
                        154800,
                        order.units_total,
                        0.23656,
                        0.235566
                    ]).draw(false);
                })
            }
        },
        computed: mapGetters ({
            user: 'auth/user',
            orders: 'order/orders',
            open_orders: 'order/open_orders',
        })
    }
</script>

<style scoped>
</style>