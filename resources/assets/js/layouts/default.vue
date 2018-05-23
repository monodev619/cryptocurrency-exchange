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

  }
}
</script>
