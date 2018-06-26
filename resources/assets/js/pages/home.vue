<!--<template>-->
  <!--<card :title="$t('home')">-->
    <!--{{ $t('you_are_logged_in') }}-->
  <!--</card>-->
<!--</template>-->

<!--<script>-->

  <!--import { mapGetters } from 'vue'-->
<!--export default {-->
  <!--middleware: 'auth',-->

  <!--metaInfo () {-->
    <!--return { title: this.$t('home') }-->
  <!--}-->
<!--}-->
<!--</script>-->

<template>

    <card :title="$t('home')">
        {{ $t('you_are_logged_in') }}
    </card>
    <router-link :to="{ name: 'login' }">
        {{ $t('login') }}
    </router-link>
</template>

<script>

    import { mapGetters } from 'vue'
    export default {
        middleware: 'auth',

        metaInfo () {
            return { title: this.$t('home') }
        }
    }
</script>
