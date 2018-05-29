<template>
    <div>
        <sidebar></sidebar>
        <router-view></router-view>
    </div>
</template>

<script>
    import Sidebar from "../../components/Sidebar";
    export default {
        name: "setting",
        components: {Sidebar},
        mounted() {
            this.$router.push({ name: 'settings.profile'})
        }
    }
</script>

<style scoped>

</style>