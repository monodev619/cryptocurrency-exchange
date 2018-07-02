<template>
    <div class="wallet">

        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <h4 class="card-title m-t-10 m-l-10">MARKETS</h4>
                <div>
                    <select id="market-type" name="market-type" required class="selectpicker" v-model="market_type" @change="changeMarket" data-style="btn-info btn-outline-info">
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
                                    <tr v-for="balancCurrency in balanceCurrencies">
                                        <td ref="cointype">{{ balancCurrency.name }}</td>
                                        <td ref="coinsymbol">{{ balancCurrency.symbol }}</td>
                                        <td>{{ balancCurrency.deposit }}</td>
                                        <td>{{ balancCurrency.pendingDeposit }}</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>%0.8</td>
                                        <td>
                                            <b-btn class="btn btn-googleplus balbtn" type="button" v-b-tooltip.hover title="Withdrawal" @click="showWithdraw(balancCurrency)">
                                                <i class="mdi mdi-arrow-down-bold"></i>
                                            </b-btn>
                                            <b-btn class="btn btn-twitter balbtn waves-effect waves-light" type="button" v-b-tooltip.hover title="Deposit" @click="showDeposit(balancCurrency)">
                                                <i class="mdi mdi-arrow-up-bold"></i>
                                            </b-btn>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="withdraw-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <loading :active.sync="isLoading" :can-cancel="false" ></loading>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Withdrawal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <form class="form-horizontal form-material" @submit.prevent="requestWithdraw" @keydown="form_withdraw.onKeydown($event)">
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
                                            <div class="col-sm-4"><span class="coinname">{{ withdraw_currency ? withdraw_currency['name'] : 0 }}</span></div>
                                            <div class="col-sm-4"><span class="symbolname">{{ withdraw_currency ? withdraw_currency['symbol'] : 0 }}</span></div>
                                            <div class="col-sm-4"><span class="balancevalue">0</span></div>
                                        </div>
                                    </div>
                                    <div class="withdrawamount row">
                                        <h2 class="col-sm-12 withdraw-title">Withdrawal amount</h2>
                                        <div class="col-sm-6">QUANTITY</div>
                                        <div class="col-sm-6"><input type="text" class="quantityvalue" name="withdraw_quantity" v-model="form_withdraw.quantity" v-on:change="quantityChange"><span class="cointype">{{ withdraw_currency ? withdraw_currency['symbol'] : 0 }}</span></div>
                                        <div class="col-sm-6">TRANSACTION FEE</div>
                                        <div class="col-sm-6"><input type="text" class="modify_input" name="withdraw_fee" v-model="form_withdraw.fee" readonly><span class="feevalue">&nbsp;{{ withdraw_currency ? withdraw_currency['symbol'] : 0 }}</span></div>
                                        <div class="col-sm-6">TOTAL WITHDRAWAL</div>
                                        <div class="col-sm-6"><input type="text" class="modify_input" name="withdraw_total" v-model="form_withdraw.total"><span class="totalvalue">&nbsp;{{ withdraw_currency ? withdraw_currency['symbol'] : 0 }}</span></div>
                                    </div>
                                    <div class="address withdraw">
                                        <span class="addr-title">Address</span><br>
                                        <input type="text" class="withdraw-addr-input" id="withdraw_address" name="withdraw_address" v-model="form_withdraw.address"  placeholder="">
                                    </div>
                                    <div class="de-instruct withdraw">
                                        <h2 class="title">DISCLAIMER</h2>
                                        <p class="instruct-content">Please verify your withdrawal address. We cannot refund an incorrect withdrawal.</p>
                                        <p>DO NOT WITHDRAW DIRECTLY TO A CROWDFUND OR ICO.</p>
                                        <p class="instruct-content">We will not credit your account with tokens from that sale.</p>
                                    </div>
                                    <input class="deposit_is_confirm" name="withdraw_is_confirmed" v-model="form_withdraw.status" type="hidden">
                                    <input class="deposit_txid" name="withdraw_txid" v-model="form_withdraw.txid" type="hidden">
                                    <input class="deposit_user_id" name="withdraw_user_id" v-model="form_withdraw.user_id" type="hidden">
                                    <input class="deposit_currency_id" name="withdraw_currency_id" v-model="form_withdraw.currency_id" type="hidden">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn  waves-effect waves-light perform">{{ withdraw_currency ? withdraw_currency['symbol'] : 0 }}&nbsp; Withdraw</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="deposit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <loading :active.sync="isLoading" :can-cancel="false" ></loading>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Deposit</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <form class="form-horizontal form-material" @submit.prevent="requestDeposit" @keydown="form_deposit.onKeydown($event)">
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
                                            <div class="col-sm-6"><span class="coinname">{{ deposit_currency ? deposit_currency['name'] : 0 }}</span></div>
                                            <div class="col-sm-6"><span class="symbolname">{{ deposit_currency ? deposit_currency['symbol'] : 0 }}</span></div>
                                        </div>
                                    </div>
                                    <div class="disclaimer">
                                        <div class="disc-title">DISCLAIMER</div>
                                        <p class="disc-content">I acknowledge the following information:<br>
                                            By depositing tokens to this address, you agree to our <a href="https://bittrex.zendesk.com/hc/en-us/articles/115000961172" target="_blank">deposit recovery policy</a>.
                                            Depositing tokens to an address other than BTC may result in your funds being lost.
                                        </p>
                                    </div>
                                    <div class="withdrawamount row">
                                        <h2 class="col-sm-12 withdraw-title">Deposit amount</h2>
                                        <div class="col-sm-6">Amount</div>
                                        <div class="col-sm-6"><input type="text" class="quantityvalue" name="deposit_amount" v-model="form_deposit.amount"><span class="cointype">{{ deposit_currency ? deposit_currency['symbol'] : 0 }}</span></div>
                                    </div>
                                    <div class="address">
                                        <span class="addr-title">Address</span><br>
                                        <input type="text" class="addr-input" id="deposit_address" name="deposit_address" v-model="form_deposit.address" placeholder="Generate a new address">
                                        <button class="addr-button">New Address</button>
                                    </div>
                                    <div class="de-instruct">
                                        <h2 class="title">DEPOSIT INSTRUCTIONS</h2>
                                        <p class="instruct-content">Depositing tokens to this address other than BTC will result in your funds being lost.</p>
                                    </div>
                                    <input class="deposit_is_confirm" name="deposit_is_confirmed" v-model="form_deposit.is_confirmed" type="hidden">
                                    <input class="deposit_txid" name="deposit_txid" v-model="form_deposit.txid" type="hidden">
                                    <input class="deposit_user_id" name="deposit_user_id" v-model="form_deposit.user_id" type="hidden">
                                    <input class="deposit_currency_id" name="deposit_currency_id" v-model="form_deposit.currency_id" type="hidden">
                                    <input class="deposit_currency_id" name="deposit_status" v-model="form_deposit.status" type="hidden">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn waves-effect waves-light perform">Done</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

     import Form from 'vform';
     import swal from 'sweetalert2';
     import i18n from '~/plugins/i18n';
     import * as codes from '~/constants/response-codes';
     import Loading from 'vue-loading-overlay';
     import { mapGetters } from 'vuex';
     import '~/plugins/datatables/jquery.dataTables.min';
     import '~/plugins/bootstrap-select/bootstrap-select.min';
     import '~/plugins/bootstrap-select/bootstrap-select.min.css';
     import BootstrapVue from 'bootstrap-vue';
     import axios from 'axios';
     import * as urls from '../../constants/url-constants';
     import 'vue-loading-overlay/dist/vue-loading.min.css';


     Vue.use(BootstrapVue);

     export default {
         name: "balance",
         middleware: 'auth',
         components: {Loading},

         data: () => ({
             btc_market_table: null,
             eth_market_table: null,
             market_type: 'btc',
             change_collpase1: true,
             change_collpase2: true,
             change_collpase3: true,
             change_collpase4: true,
             deposit_currency: [],
             withdraw_currency: [],

             form_deposit: new Form({
                 address: '',
                 amount: 0,
                 is_confirmed: 0,
                 txid: '',
                 user_id: 0,
                 currency_id: 0,
                 status: ''
             }),

             form_withdraw: new Form({
                 user_id: 0,
                 currency_id: 0,
                 address: '',
                 quantity: 0,
                 fee: 0,
                 total: 0,
                 txid: '',
                 status: ''
             }),

             depositHistoryTable: null,
             withdrawHistoryTable: null,
             pendingDepositsTable: null,
             pendingWithdrawsTable: null,
             isLoading: false,
             addTableRowHtml: ''
         }),

         created() {
             this.form_deposit.address = '11111111',
             this.form_deposit.is_confirmed = 0,
             this.form_deposit.txid = 'fdswefew',
             this.form_deposit.status = '1',

             this.form_withdraw.quantity = 0,
             this.form_withdraw.fee = 0.0005,
             this.form_withdraw.address = 'fdsaef125w',
             this.form_withdraw.status = '2',
             this.form_withdraw.txid = 'yyy'
         },

         mounted() {
             $('.selectpicker').selectpicker();

             this.btc_market_table = $('#tblbtcmarket').DataTable();
             this.eth_market_table = $('#tblethmarket').DataTable();
             $('#eth-markets').hide();

             this.depositHistoryTable = $('#tbldeposithistory').DataTable();
             this.withdrawHistoryTable = $('#tblwithdrawhistory').DataTable();
             this.pendingDepositsTable = $('#tblpendingdeposit').DataTable();
             this.pendingWithdrawsTable = $('#tblpendingwithdraw').DataTable();

             this.getDeposits();
             this.getWithdraws();
             this.fetchCurrencies();
             this.fetchMarkets();
             this.getPendingDeposits();
             this.getPendingWithdraws();
             this.getBalances();

         },

         updated() {

             $('#tblbalances').DataTable();
             $('#tblebalancemarket').DataTable();

         },

         methods: {
             quantityChange() {
                 this.form_withdraw.total = this.form_withdraw.quantity - this.form_withdraw.fee;
             },

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

             changeMarket () {
                 if (this.market_type == 'btc') {
                     $('#btc-markets').show();
                     $('#eth-markets').hide();
                 } else {
                     $('#btc-markets').hide();
                     $('#eth-markets').show();
                 }
             },

             gotoMarket (param) {
                 this.$router.push({ name: 'trading', query: {MarketName: param}});
             },

             async fetchCurrencies() {
                 const {data} = await axios.get(urls.API_BASE_URL + '/_api/currencies');
                 await this.$store.dispatch('wallet/getCurrencies', {res: data.data});
             },

             showWithdraw(param) {
                 this.form_withdraw.quantity = 0;
                 this.form_withdraw.total = this.form_withdraw.quantity - this.form_withdraw.fee;
                 this.withdraw_currency = param;
                 this.form_withdraw.currency_id = param.id;
                 $('#withdraw-modal').modal();
             },

             showDeposit(param) {
                 this.form_deposit.amount = 0;
                 this.form_deposit.address = '';
                 this.deposit_currency = param;
                 this.form_deposit.currency_id = param.id;
                 $('#deposit-modal').modal();
             },

             async requestDeposit() {

                 let vm = this;
                 this.form_deposit.user_id = vm.user.id;
                 this.isLoading = true;
                 this.addTableRowHtml = '';
                 const {data} = await this.form_deposit.post(urls.API_BASE_URL + '/_api/requestDeposit');
                 this.isLoading = false;
                 if (data.code == codes.SUCCESS) {
                     $('#tbldeposithistory .dataTables_empty').remove();
                     this.addTableRowHtml = '<tr role="row" class="odd"><td class="sorting_1">' + data.data.date.date + '</td><td>' + data.data.symbol +
                                            '</td><td>' + data.data.quantity + '</td><td>' + data.data.status + '</td></tr>';
                     const toast = swal.mixin({
                         toast: true,
                         position: 'center',
                         showConfirmButton: false,
                         timer: 3000
                     });

                     toast({
                         type: 'success',
                         title: 'Deposit has been entered successfully.'
                     });
                     $('#tbldeposithistory').append(this.addTableRowHtml);

                     this.form_deposit.amount = 0;
                     this.form_deposit.address = '';
                     $('#deposit-modal').modal('hide');
                 }
             },

             async requestWithdraw() {

                 let vm = this;
                 this.form_withdraw.user_id = vm.user.id;
                 this.isLoading = true;
                 this.addTableRowHtml = '';
                 const {data} = await this.form_withdraw.post(urls.API_BASE_URL + '/_api/requestWithdraw');
                 this.isLoading = false;
                 if (data.code == codes.SUCCESS) {
                     $('#tblwithdrawhistory .dataTables_empty').remove();
                     this.addTableRowHtml = '<tr role="row" class="odd"><td class="sorting_1">' + data.data.date.date + '</td><td>' + data.data.symbol +
                         '</td><td>' + data.data.quantity + '</td><td>' + data.data.status + '</td></tr>';

                     $('#tblwithdrawhistory').append(this.addTableRowHtml);
                     const toast = swal.mixin({
                         toast: true,
                         position: 'center',
                         showConfirmButton: false,
                         timer: 3000
                     });

                     toast({
                         type: 'success',
                         title: 'Withdrawal has been entered successfully.'
                     });

                     this.form_withdraw.quantity = 0;
                     this.form_withdraw.address = '';
                     this.form_withdraw.total = 0;
                     $('#withdraw-modal').modal('hide');
                 }
             },

             async getDeposits() {

                 let vm = this;
                 const { data } = await axios.get(urls.API_BASE_URL + '/_api/Deposits/' + vm.user.id);
                 await this.$store.dispatch('wallet/getdepositHistory', {res: data.data})
                 vm.depositHistoryTable.clear();
                 this.depositHistorys.forEach(function (history) {
                     vm.depositHistoryTable.row.add([
                         history.date.date,
                         history.symbol,
                         history.amount,
                         history.status,
                     ]).draw(false);
                 })
             },

             async getWithdraws() {

                 let vm = this;
                 const { data } = await axios.get(urls.API_BASE_URL + '/_api/Withdraws/' + vm.user.id);
                 await this.$store.dispatch('wallet/getwithdrawHistory', {res: data.data})
                 vm.withdrawHistoryTable.clear();
                 this.withdrawHistorys.forEach(function (history) {
                     vm.withdrawHistoryTable.row.add([
                         history.date.date,
                         history.symbol,
                         history.quantity,
                         history.status,
                     ]).draw(false);
                 })
             },

             async getPendingDeposits() {

                 let vm = this;
                 const {data} = await axios.get(urls.API_BASE_URL + '/_api/PendingDeposits/' + vm.user.id);
                 await this.$store.dispatch('wallet/getPendingDeposits', {res: data.data})
                 vm.pendingDepositsTable.clear();
                 this.pendingDeposits.forEach(function (deposit) {
                     vm.pendingDepositsTable.row.add([
                         deposit.date.date,
                         deposit.symbol,
                         deposit.amount,
                         deposit.is_confirmed,
                     ]).draw(false);
                 })
             },

             async getPendingWithdraws() {

                 let vm = this;
                 const {data} = await axios.get(urls.API_BASE_URL + '/_api/PendingWithdraws/' + vm.user.id);
                 await this.$store.dispatch('wallet/getPendingWithdraws', {res: data.data})
                 vm.pendingWithdrawsTable.clear();

                 this.pendingWithdraws.forEach(function (withdraw) {
                     vm.pendingWithdrawsTable.row.add([
                         withdraw.date.date,
                         withdraw.symbol,
                         withdraw.quantity,
                         withdraw.status,
                     ]).draw(false);
                 })
             },

             async getBalances() {

                 let vm = this;
                 const {data} = await axios.get(urls.API_BASE_URL + '/_api/Balances/' + vm.user.id);
                 await this.$store.dispatch('wallet/getBalances', {res: data.data})

                 // vm.pendingWithdrawsTable.clear();
                 //
                 // this.pendingWithdraws.forEach(function (withdraw) {
                 //     vm.pendingWithdrawsTable.row.add([
                 //         withdraw.date.date,
                 //         withdraw.symbol,
                 //         withdraw.quantity,
                 //         withdraw.status,
                 //     ]).draw(false);
                 // })
             },
         },

         computed: mapGetters({
             currencies: 'wallet/currencies',
             user: 'auth/user',
             depositHistorys: 'wallet/depositHistorys',
             withdrawHistorys: 'wallet/withdrawHistorys',
             pendingDeposits: 'wallet/pendingDeposits',
             pendingWithdraws: 'wallet/pendingWithdraws',
             balanceCurrencies: 'wallet/balanceCurrencies',
         })

     };

</script>

<style scoped>

</style>