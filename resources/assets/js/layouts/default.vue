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
      change_footer:true
    }),

    watch:{
        $route (to, from){

            this.change_footer = true;

            if (to.name.indexOf('login') != -1 || to.name.indexOf('register') != -1) {
                this.show_footer = false;
            } else {
                this.show_footer = true;
            }

           if (to.name.indexOf('markets') != -1 || to.name.indexOf('home') != -1) {
                this.change_footer = false;
           }

        }
    },

    mounted() {
          this.change_footer = true;

    }
}
</script>
