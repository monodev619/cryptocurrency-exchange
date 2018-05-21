<template>
  <body class="fix-header">
    <div id="main-wrapper">
      <header class="topbar">
        <navbar/>
      </header>

      <div class="">
        <child/>
      </div>
    </div>
  </body>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
