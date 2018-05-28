
<template>
    <div>
        <div class="page-wrapper page-wrapper-borderleft">
            <div class="row page-titles"><div class="col-md-5 align-self-center"></div></div>
            <div class="container-fluid">
                <div class="row ">

                    <div class="profile-content">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">My Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form action="#">
                                        <div class="form-body">
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Email address</label>
                                                        <input type="text" id="firstName" class="form-control" readonly placeholder="">
                                                        <!--<small class="form-control-feedback"> This is inline help </small> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Date of Birth</label>
                                                        <!--<input type="text" class="form-control" v-model="date" id="datepicker-autoclose" placeholder="mm/dd/yyyy">-->
                                                        <datepicker v-model="date" :format="dateFormatter"></datepicker>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Country</label>
                                                        <select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                            <option value="Category 1">Choose your country...</option>
                                                            <option value="Category 1">Category 1</option>
                                                            <option value="Category 2">Category 2</option>
                                                            <option value="Category 3">Category 5</option>
                                                            <option value="Category 4">Category 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Street</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Apt or unit</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>State or Province</label>
                                                        <select class="form-control custom-select">
                                                            <option>--Select your Country--</option>
                                                            <option>India</option>
                                                            <option>Sri Lanka</option>
                                                            <option>USA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>ZipCode</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Phone number(Optional)</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                            <button type="button" class="btn btn-inverse">Cancel</button>
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

    import { mapGetters } from 'vuex';
    import Sidebar from "../../components/Sidebar";
    import Datepicker from "vuejs-datepicker/src/components/Datepicker";


    export default {
        components: {Datepicker, Sidebar},
        middleware: 'auth',

        data() {
            return {
                date: '',
                config: {
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                }
            }
        },

        computed: mapGetters({
            user: 'auth/user'
        }),

        metaInfo () {
            return { title: this.$t('setting') }
        },

        mounted() {
            // this.date = this.date.getDate() + '/' + (this.date.getMonth() + 1) + '/' + this.date.getFullYear();
            // $('#datepicker-autoclose').datepicker();
        },

        methods: {
            dateFormatter(date) {
                return moment(date).format('YYYY-MM-DD');
            }
        }
    }
</script>