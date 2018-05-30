<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-t-10">Balances</h4>
                        <!--<h6 class="card-subtitle">Total Volume = 10480.670 &nbsp; 1 BTC = $7,410.786</h6>-->
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
                                    <td>$164,500</td>
                                </tr>
                                <tr>
                                    <td>Bitcoin</td>
                                    <td>BTC</td>
                                    <td>0.00000000</td>
                                    <td>0.00000000</td>
                                    <td>0.00000000</td>
                                    <td>0.00000000</td>
                                    <td>%0.8</td>
                                    <td>$164,500</td>
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
        name: "balance",
        middleware: 'auth',
        mounted() {
            $('#tblbalances').dataTable();
        }
    }
</script>

<style scoped>

</style>