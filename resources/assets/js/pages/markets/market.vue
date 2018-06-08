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
                                <tr @click="gotoMarket">
                                    <td>Bitcoin</td>
                                    <td>BTC</td>
                                    <td>0.00000000</td>
                                    <td>0.00000000</td>
                                    <td>0.00000000</td>
                                    <td>0.00000000</td>
                                    <td>%0.8</td>
                                    <td>0.00000000</td>
                                    <td>%0.8</td>
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
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>BTC</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>0.00000000</td>
                                        <td>%0.8</td>
                                        <td>%0.8</td>
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
    import '~/plugins/datatables/jquery.dataTables.min';

    export default {
        name: "market",
        middleware: 'auth',

        mounted() {
            $('#tblbitcoinmarkets').dataTable();
            $('#tblethereummarkets').dataTable();
        },

        data: () => ({

        }),

        methods: {
            gotoMarket () {
                this.$router.replace({ name: 'trading', query: {MarketName: "BTC-USD"}});
            }
        }
    }

</script>

<style scoped>

</style>