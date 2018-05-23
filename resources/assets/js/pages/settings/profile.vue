
<template>
    <div>
       <sidebar/>
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">My Profile</h3>
                </div>
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row ">
                    <div class="card col-lg-4">
                        <img class="card-img" src="../../../images/background/socialbg.jpg" alt="Card image">
                        <div class="card-img-overlay card-inverse social-profile d-flex ">
                            <div class="align-self-center">
                                <img src="../../../images/users/1.jpg" class="img-circle" width="100">
                                <h4 class="card-title">{{user.data.email}}</h4>
                                <h6 class="card-subtitle">{{user.data.name}}</h6>
                                <p class="text-white">Thank you for registering with BooCoin. To create your profile and identity verification, please complete the form below.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">

                            <div class="tab-pane" id="settings" role="tabpanel">
                                <div class="card-body">
                                    <form class="form-horizontal form-material">
                                        <div class="form-group">
                                            <label class="col-md-12">Full Name</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="month col-sm-4">
                                                <label class="">Birth Month</label>
                                                <div class="">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="day col-sm-4">
                                                <label class="">Birth Day</label>
                                                <div class="">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="year col-sm-4">
                                                <label class="">Birth Year</label>
                                                <div class="">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-12">Country</label>
                                            <div class="col-sm-12">
                                                <select class="form-control form-control-line">
                                                    <option>Choose your country...</option>
                                                    <option>London</option>
                                                    <option>India</option>
                                                    <option>Usa</option>
                                                    <option>Canada</option>
                                                    <option>Thailand</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--<div class="form-group">-->
                                            <!--<label class="col-md-12">Password</label>-->
                                            <!--<div class="col-md-12">-->
                                                <!--<input type="password" value="password" class="form-control form-control-line">-->
                                            <!--</div>-->
                                        <!--</div>-->
                                        <div class="form-group">
                                            <label class="col-md-12">Phone No</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Street address</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Apt or unit</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">City</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-12">Select Country</label>
                                            <div class="col-sm-12">
                                                <select class="form-control form-control-line">
                                                    <option>London</option>
                                                    <option>India</option>
                                                    <option>Usa</option>
                                                    <option>Canada</option>
                                                    <option>Thailand</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success">Submit</button>
                                            </div>
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

    // import { mapGetters } from 'vue'
    import { mapGetters } from 'vuex'
    import Sidebar from "../../components/Sidebar";

    export default {
        components: {Sidebar},
        middleware: 'auth',

        computed: mapGetters({
            user: 'auth/user'
        }),

        metaInfo () {
            return { title: this.$t('setting') }
        }
    }
</script>
