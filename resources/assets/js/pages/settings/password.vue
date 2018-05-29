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
                                    <form @submit.prevent="updatePassword" @keydown="form.onKeydown($event)">
                                        <div class="form-body">
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Currently logged in as</label>
                                                        <hr>
                                                        <h4>{{ user.email }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/row-->

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Current password</label>
                                                        <input type="password" class="form-control" v-model="form.old_password">
                                                        <div v-if="error.old_password" class="has-danger"><div class="form-control-feedback">This field is required.</div></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>New password</label>
                                                        <input type="password" class="form-control" v-model="form.password">
                                                        <div v-if="error.password" class="has-danger"><div class="form-control-feedback">This field is required.</div></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Confirm password</label>
                                                        <input type="password" class="form-control" v-model="form.password_confirmation">
                                                        <div v-if="error.password_confirmation" class="has-danger"><div class="form-control-feedback">This field is required.</div></div>
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
    import { mapGetters } from 'vuex';
    import Form from 'vform';
    import swal from 'sweetalert2';
    import i18n from '~/plugins/i18n';
    import * as codes from '~/constants/response-codes';

    export default {
        name: "password",
        components: {Sidebar},
        middleware: 'auth',

        computed: mapGetters({
            user: 'auth/user'
        }),

        data: () => ({
            form: new Form({
                old_password: '',
                password: '',
                password_confirmation: ''
            }),
            error: {
                old_password: false,
                password: false,
                password_confirmation: false
            }
        }),

        methods: {
            validateForm() {
                var bSuccess = true;

                this.error.old_password = false;
                this.error.password = false;
                this.error.password_confirmation = false;

                if (this.form.old_password.length == 0) {
                    this.error.old_password = true;
                    bSuccess = false;
                }
                if (this.form.password.length == 0) {
                    this.error.password = true;
                    bSuccess = false;
                }
                if (this.form.password_confirmation.length == 0) {
                    this.error.password_confirmation = true;
                    bSuccess = false;
                }

                if (bSuccess) {
                    this.error.old_password = false;
                    this.error.password = false;
                    this.error.password_confirmation = false;
                }

                return bSuccess;
            },

            async updatePassword() {
                if (!this.validateForm()) return;

                const { data } = await this.form.post('/_api/updatePassword');

                if (data.code == codes.SUCCESS) {
                    this.form.old_password = '';
                    this.form.password = '';
                    this.form.password_confirmation = '';
                } else if (data.code == codes.PASSWORD_MISMATCH) {
                    swal({
                        type: 'error',
                        title: i18n.t('error_alert_title'),
                        text: i18n.t('error_password_mismatch'),
                        reverseButtons: true,
                        confirmButtonText: i18n.t('ok'),
                        cancelButtonText: i18n.t('cancel')
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>