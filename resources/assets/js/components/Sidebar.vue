<template>
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-devider"></li>
                    <li class="nav-small-cap"><i class="mdi mdi-settings"></i>&nbsp; {{ $t('msettings')}}</li>
                    <li class="nav-small-cap"><i class="mdi mdi-account-circle"></i><span class="hide-menu">&nbsp; {{ $t('maccount')}}</span>
                        <ul aria-expanded="false">
                            <li><router-link :to="{name: 'settings.profile' }" :class="{blue:this.current_url == 'settings.profile'}">{{ $t('My Profile')}}</router-link></li>
                            <li><a href="app-chat.html">{{ $t('identity')}}</a></li>
                            <li><a href="app-ticket.html">{{ $t('enable')}}</a></li>
                        </ul>
                    </li>
                    <li class="nav-small-cap"><i class="mdi mdi-firefox"></i><span class="hide-menu">&nbsp; {{ $t('msitesetting')}}</span>
                        <ul aria-expanded="false">
                            <li><router-link :to="{ name: 'settings.password' }" :class="{blue:this.current_url == 'settings.password'}">{{ $t('password')}}</router-link></li>
                            <li><a href="app-compose.html">{{ $t('apikey')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- End Sidebar scroll-->
    </aside>
</template>

<script>
    export default {
        name: "Sidebar",
        data: () => ({
            current_url:'settings.profile'
        }) ,
        watch:{
            $route (to, from){
                this.current_url = to.name;
                console.log(this.current_url);
            }
        }
    }

</script>

<style scoped>

</style>