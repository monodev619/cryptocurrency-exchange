<template>
  <nav class="navbar top-navbar navbar-expand-md navbar-light">
    <div class="navbar-header">
      <router-link :to="{ name: 'markets' }" class="navbar-brand">
        <b><img src="../../images/logo-light-icon.png" alt="homepage" class="light-logo" /></b>
        <span>
          <img src="../../images/logo-text.png" alt="homepage" class="dark-logo" />
          <img src="../../images/logo-light-text.png" class="light-logo" alt="homepage" />
        </span>
      </router-link>
    </div>

    <div class="navbar-collapse">

      <ul class="navbar-nav ml-auto my-lg-0">
        <li v-if="user" class="nav-item">
          <router-link :to="{ name: 'markets' }" class="nav-link">
            {{ $t('market') }}
          </router-link>
        </li>
        <li v-if="user" class="nav-item">
          <router-link :to="{ name: 'orders' }" class="nav-link">
            {{ $t('Orders') }}
          </router-link>
        </li>
        <li v-if="user" class="nav-item">
          <router-link :to="{ name: 'wallets' }" class="nav-link">
            {{ $t('Wallets') }}
          </router-link>
        </li>
        <li v-if="user" class="nav-item">
          <router-link :to="{ name: 'settings' }" class="nav-link">
            {{ $t('Settings') }}
          </router-link>
        </li>
        <li v-if="user"class="nav-item">
          <a href="#" class="nav-link" @click.prevent="logout">
            <fa icon="sign-out-alt" fixed-width/>
            {{ $t('logout') }}
          </a>
        </li>

        <template v-else>
          <li class="nav-item">
            <router-link :to="{ name: 'markets' }" class="nav-link">
              {{ $t('market') }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
              {{ $t('login') }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
              {{ $t('register') }}
            </router-link>
          </li>
        </template>

        <!--<li class="nav-item">-->
          <!--<a href="#" class="nav-link" @click.prevent="logout">-->
          <!--<fa icon="sign-out-alt" fixed-width/>-->
          <!--{{ $t('logout') }}-->
          <!--</a>-->
        <!--</li>-->
      </ul>
    </div>
  </nav>

  <!--<nav class="navbar navbar-expand-lg navbar-light bg-white">-->
    <!--<div class="container">-->
      <!--<router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">-->
        <!--{{ appName }}-->
      <!--</router-link>-->

      <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">-->
        <!--<span class="navbar-toggler-icon"/>-->
      <!--</button>-->

      <!--<div id="navbarToggler" class="collapse navbar-collapse">-->
        <!--<ul class="navbar-nav">-->
          <!--<locale-dropdown/>-->
          <!--&lt;!&ndash; <li class="nav-item">-->
            <!--<a class="nav-link" href="#">Link</a>-->
          <!--</li> &ndash;&gt;-->
        <!--</ul>-->

        <!--<ul class="navbar-nav ml-auto">-->
          <!--&lt;!&ndash; Authenticated &ndash;&gt;-->
          <!--<li v-if="user" class="nav-item dropdown">-->
            <!--<a class="nav-link dropdown-toggle text-dark"-->
               <!--href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
              <!--<img :src="user.photo_url" class="rounded-circle profile-photo mr-1">-->
              <!--{{ user.email }}-->
            <!--</a>-->
            <!--<div class="dropdown-menu">-->
              <!--<router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">-->
                <!--<fa icon="cog" fixed-width/>-->
                <!--{{ $t('settings') }}-->
              <!--</router-link>-->

              <!--<div class="dropdown-divider"/>-->
              <!--<a href="#" class="dropdown-item pl-3" @click.prevent="logout">-->
                <!--<fa icon="sign-out-alt" fixed-width/>-->
                <!--{{ $t('logout') }}-->
              <!--</a>-->
            <!--</div>-->
          <!--</li>-->
          <!--&lt;!&ndash; Guest &ndash;&gt;-->
          <!--<template v-else>-->
            <!--<li class="nav-item">-->
              <!--<router-link :to="{ name: 'login' }" class="nav-link" active-class="active">-->
                <!--{{ $t('login') }}-->
              <!--</router-link>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
              <!--<router-link :to="{ name: 'register' }" class="nav-link" active-class="active">-->
                <!--{{ $t('register') }}-->
              <!--</router-link>-->
            <!--</li>-->
          <!--</template>-->
        <!--</ul>-->
      <!--</div>-->
    <!--</div>-->
  <!--</nav>-->
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
