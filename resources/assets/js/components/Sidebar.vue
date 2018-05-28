<template>
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-devider"></li>
                    <li class="nav-small-cap"><i class="mdi mdi-settings"></i>&nbsp; SETTINGS</li>
                    <!--<li class="nav-small-cap"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">&nbsp; SUMMARY</span></li>-->
                    <!--<li>-->
                        <!--<ul aria-expanded="false">-->
                            <!--<li><a href="index.html">My Activity </a></li>-->
                        <!--</ul>-->
                    <!--</li>-->
                    <li class="nav-small-cap"><i class="mdi mdi-account-circle"></i><span class="hide-menu">&nbsp; ACCOUNT</span>
                        <ul aria-expanded="false">
                            <li><router-link :to="{name: 'settings.profile' }">{{ $t('My Profile')}}</router-link></li>
                            <li><a href="app-chat.html">Identity Verification</a></li>
                            <li><a href="app-ticket.html">Enable Account</a></li>
                        </ul>
                    </li>
                    <li class="nav-small-cap"><i class="mdi mdi-firefox"></i><span class="hide-menu">&nbsp; SITE SETTINGS</span>
                        <ul aria-expanded="false">
                            <li><router-link :to="{ name: 'settings.password' }">{{ $t('Password')}}</router-link></li>
                            <li><a href="app-compose.html">API Keys</a></li>
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
        name: "Sidebar"
    }
</script>

<style scoped>

</style>