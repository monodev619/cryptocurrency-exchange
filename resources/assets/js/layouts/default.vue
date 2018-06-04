<template>
  <body class="fix-header">
        <div id="main-wrapper">
              <header class="topbar">
                <navbar/>
              </header>
              <div class="height"></div>
              <div class="content">
                <child/>
              </div>
            <footer class="footer" v-bind:class="{ 'left-240':change_footer}" v-if="show_footer"><span class="footercaption">2018</span></footer>
    </div>
  </body>
</template>

<script>

import Navbar from '~/components/Navbar'
import Sidebar from "../components/Sidebar";

export default {
  name: 'MainLayout',

  components: {
      Sidebar,
      Navbar,
  },

  data: () => ({
     show_footer:true,
      change_footer:false
  }),

    watch:{
        $route (to, from){

            if (to.name == 'login' || to.name == 'register') {
                this.show_footer = false;

            } else {

                this.show_footer = true;

            }
            if (to.name == 'orders' || to.name == 'wallets' || to.name == 'mainwindow' || to.name == 'settings')  {

                this.change_footer = true;

            }
            else if (to.name == 'markets' || to.name == 'home') {
                this.change_footer = false;
            }
        }
    },

  mounted() {
          this.change_footer = false;
          $('.preloader').fadeOut();
          if (this.$route.name === 'orders' || this.$route.name === 'wallets' || this.$route.name === 'mainwindow' || this.$route.name === 'settings') {
              this.change_footer = true;
          }
  }


}
</script>
