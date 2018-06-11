<template>
    <div class="wallet">
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <h4 class="card-title m-t-10 m-l-10">MARKETS</h4>
                <div class="table-responsive marketinfo">
                    <table id="tblebalancemarket" class="table marketinfo table-bordered table-striped" data-page-length="50">
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th>BUY/SELL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                            <tr>
                                <td>ADA</td>
                                <td class="text-danger">0.0000002995</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </aside>
        <div class="page-wrapper main-content">
            <div class="row balances">
                <div class="col-12">
                    <div class="card">
                        <h4 class="card-title m-t-10">Balances</h4>
                        <div class="table-responsive m-t-20">
                            <table id="tblbalances" class="table table-balance table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>CURRENCY NAME</th>
                                        <th>SYMBOL</th>
                                        <th>AVAILABLE BALANCE</th>
                                        <th>PENDING DEPOSIT</th>
                                        <th>RESERVED</th>
                                        <th>TOTAL</th>
                                        <th>EST.BTC VALUE</th>
                                        <th>%CHANGE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="currency in currencies">
                                        <td ref="cointype">{{currency.name}}</td>
                                        <td ref="coinsymbol">{{currency.symbol}}</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>%0.8</td>
                                        <td>
                                            <b-btn class="btn btn-googleplus balbtn" type="button" data-toggle="modal" data-target="#depositModal" v-b-modal.depositModal v-b-tooltip.hover title="Deposit" @click="getCurrency(currency.id)">
                                                <i class="mdi mdi-arrow-down-bold"></i>
                                            </b-btn>
                                            <b-btn class="btn btn-twitter balbtn waves-effect waves-light" type="button" data-toggle="modal" data-target="#withdrawModal" v-b-modal.withdrawModal v-b-tooltip.hover title="Withdrawal">
                                                <i class="mdi mdi-arrow-up-bold"></i>
                                            </b-btn>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <b-modal id="depositModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" title="Deposit" ok-title="Done" ok-variant="danger" cancel-variant="primary">
                    <div class="modal-content">
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
                    </div>
                </b-modal>
                <b-modal id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" title="Withdraw" ok-title="Withdraw BTC" ok-variant="danger" cancel-variant="primary">
                    <div class="modal-content">
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
                    </div>
                </b-modal>
            </div>

            <div class="row wallets pendingwithdraw">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-t-10" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo22" aria-expanded="false" aria-controls="collapseTwo22" v-on:click="change_collpase1=!change_collpase1">
                                <i class="fa fa-plus-square-o" v-if="change_collpase1"></i><i class="fa fa-minus-square-o" v-if="!change_collpase1"></i><span class="title1">PENDING WITHDRAWALS</span>
                            </h4>
                            <div class="table-responsive m-t-20 collapse" id="collapseTwo22" role="tabpanel" aria-labelledby="headingTwo22">
                                <table id="tblpendingwithdraw" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>SYMBOL</th>
                                            <th>QUANTITY</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bitcoin</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                        </tr>
                                        <tr>
                                            <td>Bitcoin</td>
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

            <div class="row wallets pendingdeposit">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-t-10" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo33" aria-expanded="false" aria-controls="collapseTwo33" v-on:click="change_collpase2=!change_collpase2">
                                <i class="fa fa-plus-square-o" v-if="change_collpase2"></i><i class="fa fa-minus-square-o" v-if="!change_collpase2"></i><span class="title1">PENDING DEPOSITS</span>
                            </h4>
                            <div class="table-responsive m-t-20 collapse" id="collapseTwo33" role="tabpanel" aria-labelledby="headingTwo22">
                                <table id="tblpendingdeposit" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>LAST CHECKED</th>
                                            <th>SYMBOL</th>
                                            <th>QUANTITY</th>
                                            <th>CONFIRMATIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bitcoin</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                        </tr>
                                        <tr>
                                            <td>Bitcoin</td>
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

            <div class="row wallets withdrawhistory">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-t-10" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo44" aria-expanded="false" aria-controls="collapseTwo44" v-on:click="change_collpase3=!change_collpase3">
                                <i class="fa fa-plus-square-o" v-if="change_collpase3"></i><i class="fa fa-minus-square-o" v-if="!change_collpase3"></i><span class="title1">WITHDRAWAL HISTORY</span>
                            </h4>
                            <div class="table-responsive m-t-20 collapse" id="collapseTwo44" role="tabpanel" aria-labelledby="headingTwo22">
                                <table id="tblwithdrawhistory" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>SYMBOL</th>
                                            <th>QUANTITY</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bitcoin</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                        </tr>
                                        <tr>
                                            <td>Bitcoin</td>
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

            <div class="row wallets deposithistory">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-t-10" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo55" aria-expanded="false" aria-controls="collapseTwo55" v-on:click="change_collpase4=!change_collpase4">
                                <i class="fa fa-plus-square-o" v-if="change_collpase4"></i><i class="fa fa-minus-square-o" v-if="!change_collpase4"></i><span class="title1">DEPOSIT HISTORY</span>
                            </h4>
                            <div class="table-responsive m-t-20 collapse" id="collapseTwo55" role="tabpanel" aria-labelledby="headingTwo22">
                                <table id="tbldeposithistory" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>SYMBOL</th>
                                            <th>QUANTITY</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bitcoin</td>
                                            <td>BTC</td>
                                            <td>0.00000000</td>
                                            <td>0.00000000</td>
                                        </tr>
                                        <tr>
                                            <td>Bitcoin</td>
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
</template>

<script>

     import { mapGetters } from 'vuex';
     import '~/plugins/datatables/jquery.dataTables.min';
     import BootstrapVue from 'bootstrap-vue';
     import axios from 'axios';
     import * as urls from '../../constants/url-constants';


     Vue.use(BootstrapVue);

     export default {
         name: "balance",
         middleware: 'auth',

         updated() {

                 $('#tblebalancemarket').dataTable();
                 $('#tblbalances').dataTable();
                 $('#tblpendingwithdraw').dataTable();
                 $('#tblpendingdeposit').dataTable();
                 $('#tblwithdrawhistory').dataTable();
                 $('#tbldeposithistory').dataTable();

         },

         methods: {
             async fetchCurrencies () {

                 const { data } = await axios.get(urls.API_BASE_URL + '/_api/currencies');
                 await this.$store.dispatch('wallet/getCurrencies', {currencies: data.data})
             },

             async getCurrency(id) {
                 const { data } = await axios.get(urls.API_BASE_URL + '/_api/currency/' + id);
                 console.log(data);
             }
         },

         beforeMount() {
             this.fetchCurrencies();
         },

         data: () => ({
             change_collpase1:true,
             change_collpase2:true,
             change_collpase3:true,
             change_collpase4:true
         }),

         computed: mapGetters({
             currencies: 'wallet/currencies'
         })

     }

</script>

<style scoped>

</style>