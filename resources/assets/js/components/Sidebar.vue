<template>
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-devider"></li>
                    <li class="nav-small-cap"><i class="mdi mdi-settings"></i>&nbsp; SETTINGS</li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">SUMMARY</span></a>
                        <ul aria-expanded="false">
                            <li><a href="index.html">My Activity </a></li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span class="hide-menu">ACCOUNT</span></a>
                        <ul aria-expanded="false">
                            <li><router-link :to="{ name: 'setting' }">{{ $t('My Profile')}}</router-link></li>
                            <li><a href="app-chat.html">Identity Verification</a></li>
                            <li><a href="app-ticket.html">Enable Account</a></li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-firefox"></i><span class="hide-menu">SITE SETTINGS</span></a>
                        <ul aria-expanded="false">
                            <li><a href="app-email.html">Password</a></li>
                            <li><a href="app-email-detail.html">Two-Factor Authentication</a></li>
                            <li><a href="app-compose.html">API Keys</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
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