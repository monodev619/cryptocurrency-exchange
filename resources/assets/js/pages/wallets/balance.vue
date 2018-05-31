<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-t-10">Balances</h4>
                        <div class="table-responsive m-t-20">
                            <table id="tblbalances" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>CURRENCY</th>
                                        <th>SYMBOL</th>
                                        <th>AVAIABLE BALANCE</th>
                                        <th>PENDING DEPOSIT</th>
                                        <th>TOTAL</th>
                                        <th>EST.BTC VALUE</th>
                                        <th>%CHANGE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>BTC</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>%0.8</td>
                                        <td>
                                            <button class="btn btn-googleplus" type="button" data-toggle="modal" data-target="#depositModal"> <i class="mdi mdi-arrow-up-bold"></i> </button>
                                            <button class="btn btn-twitter waves-effect waves-light" type="button" data-toggle="modal" data-target="#withdrawModal"> <i class="mdi mdi-arrow-down-bold"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>BTC</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>%0.8</td>
                                        <td>
                                            <button class="btn btn-googleplus" type="button" data-toggle="modal" data-target="#depositModal"> <i class="mdi mdi-arrow-up-bold"></i> </button>
                                            <button class="btn btn-twitter waves-effect waves-light" type="button" data-toggle="modal" data-target="#withdrawModal"> <i class="mdi mdi-arrow-down-bold"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<modal></modal>-->
            <div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
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
                                <button type="button" class="btn btn-twitter waves-effect waves-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
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
                                        <div class="col-sm-4"><span class="coinname">Bitcoin</span></div>
                                        <div class="col-sm-4"><span class="symbolname">BTC</span></div>
                                        <div class="col-sm-4"><span class="balancevalue">0</span></div>
                                    </div>
                                </div>
                                <div class="withdrawamount row">
                                    <h2 class="col-sm-12 withdraw-title">Withdrawal amount</h2>
                                    <div class="col-sm-6">QUANTITY</div>
                                    <div class="col-sm-6"><input type="text" class="quantityvalue" v-bind:value="0"><span class="cointype">BTC</span></div>
                                    <div class="col-sm-6">TRANSACTION FEE</div>
                                    <div class="col-sm-6"><span class="feevalue">0.00050000 &nbsp;BTC</span></div>
                                    <div class="col-sm-6">TOTAL WITHDRAWAL</div>
                                    <div class="col-sm-6"><span class="totalvalue">-0.00050000 &nbsp;BTC</span></div>
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
                                <button type="button" class="btn btn-twitter waves-effect waves-light" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light">Withdraw BTC</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </div>
</template>

<script>
     import '~/plugins/datatables/jquery.dataTables.min';
     import '~/plugins/sticky-kit.min.js';


</script>

<style scoped>

</style>