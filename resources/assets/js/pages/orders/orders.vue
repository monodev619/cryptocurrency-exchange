<template>
    <div class="orders">
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
            <div class="row bitcoinmarkets">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-t-10">OPEN ORDERS</h4>
                            <div class="table-responsive m-t-20">
                                <table id="tblopenorders" class="table table-orders table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ORDER DATE</th>
                                        <th>MARKET</th>
                                        <th>TYPE</th>
                                        <th>BID/ASK</th>
                                        <th>FILLED</th>
                                        <th>UNITS TOTAL</th>
                                        <th>ACTUAL RATE</th>
                                        <th>EST.TOTAL</th>
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
                                        <td>0.00000000</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>BTC</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>%0.8</td>
                                        <td>0.00000000</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ethereummarkets">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-t-10">MY ORDER HISTORY</h4>
                            <div class="table-responsive m-t-20">
                                <table id="tblorderhistory" class="table table-orders table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>CLOSED DATE</th>
                                        <th>OPENED DATE</th>
                                        <th>MARKET</th>
                                        <th>TYPE</th>
                                        <th>BID/ASK</th>
                                        <th>UNITS FILLED</th>
                                        <th>UNITS TOTAL</th>
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
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>%0.8</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>BTC</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>%0.8</td>
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

    import Form from 'vform';
    import { mapGetters } from 'vuex';
    import '~/plugins/datatables/jquery.dataTables.min';
    import '~/plugins/bootstrap-select/bootstrap-select.min';
    import '~/plugins/bootstrap-select/bootstrap-select.min.css';
    import BootstrapVue from 'bootstrap-vue';
    import axios from 'axios';
    import * as urls from '../../constants/url-constants';

    export default {
        name: "orders",
        middleware: 'auth',

        data: () => ({
            btc_market_table: null,
            eth_market_table: null,
            market_type: 'btc',
        }),

        mounted() {
            $('.selectpicker').selectpicker();

            this.btc_market_table = $('#tblbtcmarket').DataTable();
            this.eth_market_table = $('#tblethmarket').DataTable();
            $('#eth-markets').hide();

            $('#tbleordersmarket').dataTable();
            $('#tblopenorders').dataTable();
            $('#tblorderhistory').dataTable();

            this.fetchMarkets();
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
                    console.log(vm.btc_market_table.row(this).data()[0])
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
        },

        computed: {

        }
    }
</script>

<style scoped>

</style>