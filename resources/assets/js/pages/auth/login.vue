<template>
  <div class="login-register">
    <div class="login-box card">
      <div class="card-body">
        <form class="form-horizontal form-material" @submit.prevent="login" @keydown="form.onKeydown($event)">
          <h3 class="box-title m-b-20">Log In</h3>
          <div class="form-group ">
            <div class="col-xs-12">
              <input class="form-control" type="text" required="" name="email" v-model="form.email" placeholder="Email"> </div>
          </div>
          <div class="form-group">
            <div class="col-xs-12">
              <input class="form-control" type="password" required="" name="password" v-model="form.password" placeholder="Password"> </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="checkbox checkbox-primary pull-left p-t-0">
                <input id="checkbox-signup" type="checkbox" name="remember" v-model="remember">
                <label for="checkbox-signup"> Remember me </label>
              </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
          </div>
          <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
              <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
            </div>
          </div>
          <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
              <p>Don't have an account? <router-link :to="{name: 'register'}" class="text-info m-l-5"><b>Register</b></router-link></p>
            </div>
          </div>
        </form>
        <form class="form-horizontal" id="recoverform" action="index.html">
          <div class="form-group ">
            <div class="col-xs-12">
              <h3>Recover Password</h3>
              <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
            </div>
          </div>
          <div class="form-group ">
            <div class="col-xs-12">
              <input class="form-control" type="text" required="" placeholder="Email"> </div>
          </div>
          <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
              <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/_api/login');

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
          token: data.data,
          remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      await this.$store.dispatch('auth/fetchProfile')

      // Redirect home.
      this.$router.push({ name: 'home' })
    }
  }
}
</script>
