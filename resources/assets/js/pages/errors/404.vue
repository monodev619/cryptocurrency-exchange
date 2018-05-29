<template>
  <!--<card class="text-center">-->
    <!--<h3 class="mb-4">{{ $t('page_not_found') }}</h3>-->

    <!--<div class="links">-->
      <!--<router-link :to="{ name: 'welcome' }">-->
        <!--{{ $t('go_home') }}-->
      <!--</router-link>-->
    <!--</div>-->
  <!--</card>-->
  <section id="wrapper" class="error-page">
    <div class="">
      <div class="error-body text-center">
        <h1>{{ $t('404') }}</h1>
        <h3 class="text-uppercase">Page Not Found !</h3>
        <p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
        <a href="/home" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>
