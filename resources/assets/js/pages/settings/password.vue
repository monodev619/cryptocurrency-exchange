<template>
    <div>
        <!--<sidebar/>-->
        <div class="page-wrapper page-wrapper-borderleft">
            <div class="row page-titles"><div class="col-md-5 align-self-center"></div></div>
            <div class="container-fluid">
                <div class="row ">

                    <div class="profile-content">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Password</h4>
                                </div>
                                <div class="card-body">
                                    <form action="#">
                                        <div class="form-body">
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Currently logged in as</label>
                                                        <hr>
                                                        <!--<input type="text" id="firstName" class="form-control" readonly placeholder="">-->
                                                        <!--<small class="form-control-feedback"> This is inline help </small> -->
                                                        <h4>Worldc584@gmail.com</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/row-->

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Current password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>New password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Confirm password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Change Password</button>
                                        </div>
                                    </form>
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
    import Sidebar from "../../components/Sidebar";
    export default {
        name: "password",
        components: {Sidebar}
    }
</script>

<style scoped>

</style>