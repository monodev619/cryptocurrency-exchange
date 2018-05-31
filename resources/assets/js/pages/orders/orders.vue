<template>
    <div class="container-fluid">
        <div class="row bitcoinmarkets">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-t-10">OPEN ORDERS</h4>
                        <div class="table-responsive m-t-20">
                            <table id="tblbitcoinmarkets" class="table table-bordered table-striped">
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
                            <table id="tblethereummarkets" class="table table-bordered table-striped">
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
</template>

<script>
    import '~/plugins/datatables/jquery.dataTables.min';

    export default {
        name: "orders",
        middleware: 'auth',

        mounted() {
            $('#tblbitcoinmarkets').dataTable();
            $('#tblethereummarkets').dataTable();
        },

        data: () => ({

        }),
    }
</script>

<style scoped>

</style>