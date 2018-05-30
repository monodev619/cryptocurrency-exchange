<template>
  <body class="fix-header">
        <div id="main-wrapper">
              <header class="topbar">
                <navbar/>
              </header>
              <div class="height"></div>
              <div class="content">
                <!--<div class="preloader">-->
                  <!--<svg class="circular" viewBox="25 25 50 50">-->
                    <!--<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>-->
                <!--</div>-->
                <child/>
              </div>
        <footer class="footer"> © 2018 Admin Press Admin by themedesigner.in </footer>
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

  mounted() {
      $('.preloader').fadeOut();
  }
}
</script>
