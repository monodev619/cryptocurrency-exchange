<template>

  <div class="login-register register">
    <div class="login-box card">
      <div class="card-body">
        <form class="form-horizontal form-material" @submit.prevent="register" @keydown="form.onKeydown($event)">
          <h3 class="box-title m-b-20">{{ $t('Register') }}</h3>
          <div class="has-danger" v-if="validation_error"><div class="form-control-feedback">{{ $t('invalid_credential') }}</div></div>
          <div class="form-group">
            <div class="col-xs-12">
              <input class="form-control" type="text" required="" name="name" v-model="form.name" :placeholder="$t('name')">
            </div>
          </div>
          <div class="has-danger" v-if="validation_error"><div class="form-control-feedback">{{ $t('invalid_credential') }}</div></div>
          <div class="form-group ">
            <div class="col-xs-12">
              <input class="form-control" type="text" required="" name="email" v-model="form.email" :placeholder="$t('email')">
            </div>
          </div>
          <div class="has-danger" v-if="validation_error"><div class="form-control-feedback">{{ $t('invalid_credential') }}</div></div>
          <div class="form-group ">
            <div class="col-xs-12">
              <input class="form-control" type="password" required="" name="password" v-model="form.password" :placeholder="$t('password')">
            </div>
          </div>
          <div class="has-danger" v-if="validation_error"><div class="form-control-feedback">{{ $t('invalid_credential') }}</div></div>
          <div class="form-group">
            <div class="col-xs-12">
              <input class="form-control" type="password" required="" name="password_confirmation" v-model="form.password_confirmation" :placeholder="$t('confirm_password')">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="checkbox checkbox-success p-t-0 p-l-10">
                <input id="checkbox-signup" type="checkbox" v-on:click="changeResult">
                <label for="checkbox-signup"> {{ $t('agree')}} <a href="#">{{ $t('terms' )}}</a></label>
              </div>
            </div>
          </div>
          <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
              <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" :disabled="agreeTerm">{{ $t('register')}}</button>
            </div>
          </div>
          <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
              <p>{{ $t('aleadyhave')}} <router-link :to="{name: 'login'}" class="text-info m-1-5"> <b>{{ $t('login')}}</b></router-link></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</template>

<script>
import Form from 'vform'
import * as codes from '~/constants/response-codes';

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
      // validation_error:false,
      agreeTerm : true
  }),

  methods: {
    async register () {
      // Register the user.
        this.validation_error = false;

      const { data } = await this.form.post('/_api/register')

      // if (data.code == codes.VALIDATION_ERROR) {
      //     this.validation_error = true;
      // }

      // Log in the user.
      const { data: { token } } = await this.form.post('/_api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', { token })

      // Update the user.
      await this.$store.dispatch('auth/updateUser', { user: data })

      // Redirect home.
      this.$router.push({ name: 'home' })
    },

      changeResult() {
        if (this.agreeTerm) {
            this.agreeTerm = false;
        }
        else {
            this.agreeTerm = true;
        }
    }
  }
}
</script>
