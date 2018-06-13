<template>
    <div class="container-fluid">
        <div class="row bitcoinmarkets">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-t-10">BITCOIN MARKETS</h4>
                        <span class="current-bitcoin">Total Volume = 10284.324 &nbsp; 1BTC = $7552.5024</span>
                        <div class="table-responsive m-t-20">
                            <table id="tblbitcoinmarkets" class="table table-bordered table-striped markets">
                                <thead>
                                <tr>
                                    <th>MARKET</th>
                                    <th>CURRENCY</th>
                                    <th>VOLUME</th>
                                    <th>CHANGE</th>
                                    <th>LAST PRICE</th>
                                    <th>24HR HIGH</th>
                                    <th>24HR LOW</th>
                                    <th>% SPREAD</th>
                                    <th>ADDED</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-on:click="gotoMarket(btc_market.name)" v-for="btc_market in btc_markets">
                                    <td>{{ btc_market.name }}</td>
                                    <td>{{ btc_market.currency }}</td>
                                    <td>0.00000000</td>
                                    <td>0.00000000</td>
                                    <td>0.00000000</td>
                                    <td>0.00000000</td>
                                    <td>%0.8</td>
                                    <td>0.00000000</td>
                                    <td>%0.8</td>
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
                        <h4 class="card-title m-t-10">ETHEREUM MARKETS</h4>
                        <span class="currentethereum">Total Volume = 9185.477</span>
                        <div class="table-responsive m-t-20">
                            <table id="tblethereummarkets" class="table table-bordered table-striped markets">
                                <thead>
                                    <tr>
                                        <th>MARKET</th>
                                        <th>CURRENCY</th>
                                        <th>VOLUME</th>
                                        <th>CHANGE</th>
                                        <th>LAST PRICE</th>
                                        <th>24HR HIGH</th>
                                        <th>24HR LOW</th>
                                        <th>% SPREAD</th>
                                        <th>ADDED</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-on:click="gotoMarket(eth_market.name)" v-for="eth_market in eth_markets">
                                        <td>{{ eth_market.name }}</td>
                                        <td>{{ eth_market.currency }}</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>%0.8</td>
                                        <td>%0.8</td>
                                    </tr>
                                </tbody>
                            </table>
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
    import axios from 'axios';
    import * as urls from '../../constants/url-constants';


    export default {
        name: "market",
        // middleware: 'auth',

        updated() {
            $('#tblbitcoinmarkets').dataTable();
            $('#tblethereummarkets').dataTable();
        },

        mounted() {

        },

        methods: {
            async fetchMarkets () {
                const { data } = await axios.get(urls.API_BASE_URL + '/_api/markets');
                await this.$store.dispatch('market/getMarkets', {markets: data.data});
            },

            gotoMarket (param1) {
                this.$router.push({ name: 'trading', query: {MarketName: param1}});
            }

        },

        beforeMount() {
            this.fetchMarkets();
        },

        computed: mapGetters({
            btc_markets: 'market/btc_markets',
            eth_markets: 'market/eth_markets'

        })
    }

</script>

<style scoped>

</style>