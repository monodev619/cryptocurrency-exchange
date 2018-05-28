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
        components: {Sidebar}
    }
</script>

<style scoped>

</style>