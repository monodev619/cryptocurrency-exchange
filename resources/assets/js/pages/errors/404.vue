<template>
  <section id="wrapper" class="error-page">
    <div class="">
      <div class="error-body text-center">
        <h1>{{ $t('404') }}</h1>
        <h3 class="text-uppercase">{{ $t('page_not_found')}}</h3>
        <p class="text-muted m-t-30 m-b-30">{{ $t('youseem')}}</p>
        <a href="/home" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">{{ $t('backtohome')}}</a> </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>
