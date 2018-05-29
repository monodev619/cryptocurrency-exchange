
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
                                    <form @submit.prevent="updateProfile" @keydown="form.onKeydown($event)">
                                        <div class="form-body">
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Email address</label>
                                                        <input type="text" v-model="user.email" class="form-control" readonly placeholder="">
                                                        <div v-if="error.email" class="has-danger"><div class="form-control-feedback">This is required.</div></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Date of Birth</label>
                                                        <datepicker v-model="form.dob" :format="dateFormatter"></datepicker>
                                                        <div v-if="error.dob" class="has-danger"><div class="form-control-feedback">This field is required.</div></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Country</label>
                                                        <select class="form-control custom-select" data-placeholder="Choose a Country" tabindex="1" v-model="form.country">
                                                            <option disabled value="">Choose your country...</option>
                                                            <option>United State</option>
                                                            <option>China</option>
                                                            <option>Korea</option>
                                                        </select>
                                                        <div v-if="error.country" class="has-danger"><div class="form-control-feedback">This field is required.</div></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Street</label>
                                                        <input type="text" class="form-control" v-model="form.street">
                                                        <div v-if="error.street" class="has-danger"><div class="form-control-feedback">This field is required.</div></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Apt or unit</label>
                                                        <input type="text" class="form-control" v-model="form.apt">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" v-model="form.city">
                                                        <div v-if="error.city" class="has-danger"><div class="form-control-feedback">This field is required.</div></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>State or Province</label>
                                                        <select class="form-control custom-select" v-model="form.state">
                                                            <option disabled value="">Choose your State or Province...</option>
                                                            <option>NewYork</option>
                                                            <option>Washington</option>
                                                            <option>LA</option>
                                                        </select>
                                                        <div v-if="error.city" class="has-danger"><div class="form-control-feedback">This field is required.</div></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>ZipCode</label>
                                                        <input type="text" class="form-control" v-model="form.zipcode">
                                                        <div v-if="error.zipcode" class="has-danger"><div class="form-control-feedback">This field is required.</div></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Phone number(Optional)</label>
                                                        <input type="text" class="form-control" v-model="form.phone">
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
    import Form from 'vform';

    export default {
        components: {Datepicker, Sidebar},
        middleware: 'auth',

        data: () => ({

            form: new Form({
                dob: '',
                country: '',
                street: '',
                apt: '',
                city: '',
                state: '',
                zipcode: '',
                phone: ''
            }),

            error: {
                email:false,
                dob:false,
                country:false,
                street:false,
                city:false,
                state:false,                
                zipcode:false,
            }
        }),

        computed: mapGetters({
            user: 'auth/user',
            profile: 'auth/profile'
        }),

        metaInfo () {
            return { title: this.$t('Profile') }
        },

        mounted() {
            if (this.profile != null) {
                this.form.dob = this.profile.dob
                this.form.country = this.profile.country
                this.form.street = this.profile.street
                this.form.apt = this.profile.apt
                this.form.city = this.profile.city
                this.form.state = this.profile.state
                this.form.zipcode = this.profile.zipcode
                this.form.phone = this.profile.phone
            }
        },

        methods: {

            dateFormatter(date) {
                return moment(date).format('YYYY/MM/DD');
            },

            async updateProfile () {
                if(!this.validateForm()) return;
                const { data } = await this.form.post('/_api/updateProfile');
                await this.$store.dispatch('auth/fetchProfile');
                this.form.apt = '';
                this.form.dob = '';
                this.form.state = '';
                this.form.country = '';
                this.form.street = '';
                this.form.city = '';
                this.form.zipcode = '';
                this.form.phone = '';
            },

            validateForm() {
                var bSuccess = true;

                this.error.country = false;
                this.error.street = false;
                this.error.city = false;
                this.error.zipcode = false;
                this.error.dob = false;
                this.error.state = false;

                if (this.user.email.length == 0) {
                    this.error.email = true;
                    bSuccess = false;
                }

                if (this.form.dob.length == 0) {
                    this.error.dob = true;
                    bSuccess = false;
                }

                if (this.form.country.length == 0) {
                    this.error.country = true;
                    bSuccess = false;
                }
                if (this.form.street.length == 0) {
                    this.error.street = true;
                    bSuccess = false;
                }
                if (this.form.city.length == 0) {
                    this.error.city = true;
                    bSuccess = false;
                }
                 if (this.form.state.length == 0) {
                    this.error.state = true;
                    bSuccess = false;
                }
                 if (this.form.zipcode.length == 0) {
                    this.error.zipcode = true;
                    bSuccess = false;
                }

                 if (bSuccess) {
                    this.error.country = false;
                    this.error.street = false;
                    this.error.city = false;
                    this.error.zipcode = false;
                    this.error.dob = false;
                    this.error.state = false;
                }

                return bSuccess;
            },
        }
    }
</script>