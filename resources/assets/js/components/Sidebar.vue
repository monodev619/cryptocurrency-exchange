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
                            <li @click="selected = 'profile'" :class="{blue:selected == 'profile'}"><router-link :to="{name: 'settings.profile' }" :class="{blue:selected == 'profile'}">{{ $t('My Profile')}}</router-link></li>
                            <li @click="selected = 'identy'" :class="{blue:selected == 'identy'}"><a href="app-chat.html">{{ $t('identity')}}</a></li>
                            <li @click="selected = 'enable'" :class="{blue:selected == 'enable'}"><a href="app-ticket.html">{{ $t('enable')}}</a></li>
                        </ul>
                    </li>
                    <li class="nav-small-cap"><i class="mdi mdi-firefox"></i><span class="hide-menu">&nbsp; {{ $t('msitesetting')}}</span>
                        <ul aria-expanded="false">
                            <li @click="selected = 'pass'" :class="{blue:selected == 'pass'}"><router-link :to="{ name: 'settings.password' }" :class="{blue:selected == 'pass'}">{{ $t('password')}}</router-link></li>
                            <li @click="selected = 'api'" :class="{blue:selected == 'api'}"><a href="app-compose.html">{{ $t('apikey')}}</a></li>
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
            selected:'profile'
        }),
    }
</script>

<style scoped>

</style>