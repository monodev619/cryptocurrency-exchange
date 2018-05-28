import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import Vuetify from 'vuetify'

import '~/plugins'
import '~/components'

Vue.config.productionTip = false

window.$ = window.jQuery = require('jquery');

Vue.use(Vuetify)

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
});
