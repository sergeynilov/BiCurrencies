<template>
    <div class="sidebar" :style="{ width: sidebarWidth }">
        <div v-if="collapsed" class="mb-2">
            <div>
                <jet-application-logo :icon_type="'small'" :layout="'admin'" additive_class="ml-1"/>
            </div>
            <div class="ml-2"><strong>{{ getInitialLetter(settings_site_name, true) }}</strong></div>
            <div class="ml-2"><strong>{{ getInitialLetter(settings_site_name, false) }}</strong></div>
        </div>

        <div v-if="!collapsed" class="d-flex flex-nowrap">
             <jet-application-logo :icon_type="'small'" :layout="'admin'" additive_class="mr-1" />
            <strong>{{ settings_site_name }}</strong>
        </div>

        <SidebarLink link_to="home" link_icon="home">Home</SidebarLink>
        <SidebarLink link_to="frontend.current_rates" link_icon="home">Current rates</SidebarLink>
        <SidebarLink link_to="admin.dashboard.index" link_icon="dashboard" :active_component="'Admins/Dashboard'">Dashboard
        </SidebarLink>
        <!--        <SidebarLink to="/dashboard" icon="fas fa-columns">Dashboard</SidebarLink>-->
        <SidebarLink link_to="admin.currencies.index" link_icon="currency" :active_component="'Admins/Currencies'">
            Currencies
        </SidebarLink>
        <SidebarLink link_to="admin.cms_items.index" link_icon="currency" :active_component="'Admins/CMSItems'">
            CMS Items
        </SidebarLink>
        <SidebarLink link_to="admin.settings.index" link_icon="settings" :active_component="'Admins/Settings'">Settings
        </SidebarLink>
        <a type="button" class=" nav-link" @click.prevent="logout()" title="logout">
            <i class="nav-icon fas fa-sign-out-alt"></i>
        </a>

        <span
            class="collapse-icon"
            :class="{ 'rotate-180': collapsed }"
            @click="toggleSidebar"
        >
      <i class="fas fa-angle-double-left"/>
    </span>
    </div>
</template>

<script>
import SidebarLink from './SidebarLink'
import {collapsed, sidebarWidth} from './state'
import {ref, computed, onMounted} from 'vue'

import {
    getHeaderIcon,
    getErrorMessage,
} from '@/commonFuncs'
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/inertia-vue3";
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import axios from "axios";

export default {
    name: 'Sidebar',
    props: {},
    components: {
        SidebarLink,
        JetApplicationLogo
    },
    setup() {
        let settings_site_name = ref('')

        //
        collapsed.value = false
        if (window.innerWidth <= 768 ) { // ipad or smaller
            collapsed.value = true
        }


        function toggleSidebar() {
            collapsed.value = !collapsed.value
            window.emitter.emit('AdminSidebarCollapseSwitcherEvent', {
                parent_component_key: 'Sidebar'
            })

        }

        function logout() {
            Inertia.post(route('logout'));
        }

        function getInitialLetter(text, first_letter) {
            // console.log('getInitialLetter text::')
            // console.log(text)
            if (first_letter) {
                return 'C';
            }
            if (!first_letter) {
                return 'R';
            }
            // Inertia.visit(route('admin.currencies.index'), {method: 'get'});
        }


        function adminSidebarOnMounted() {

            axios.get(route('get_settings_value', {key: 'site_name'}))
                .then(({data}) => {
                    settings_site_name.value = data.value
                })
                .catch(e => {
                    console.error(e)
                })

            window.emitter.on('AdminTopNavbarSwitchEvent', params => {
                console.log('TARGET AdminTopNavbarSwitchEvent params::')
                console.log(params)
                collapsed.value = !collapsed.value
            })
        }

        onMounted(adminSidebarOnMounted)

        return { // setup return
            collapsed,
            toggleSidebar,
            sidebarWidth,
            getInitialLetter,
            logout,

            // Common methods
            getErrorMessage,
            getHeaderIcon,
            settings_site_name
            // is_left_sidebar_visible
        }
    }, // setup() {---

}
</script>


<style>
:root {
    --sidebar-bg-color: $admin_background_color;
    --sidebar-item-hover: white;
    --sidebar-item-active: #276749;
}
</style>

<style scoped>
.sidebar {
    color: white;
    background-color: var(--sidebar-bg-color);

    float: left;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    bottom: 0;
    padding: 0.5em;

    transition: 0.3s ease;

    display: flex;
    flex-direction: column;
}

.sidebar h1 {
    height: 2.5em;
}

.collapse-icon {
    position: absolute;
    bottom: 0;
    padding: 0.3em;

    color: rgba(255, 255, 255, 0.7);

    transition: 0.2s linear;
}

.rotate-180 {
    transform: rotate(180deg);
    transition: 0.2s linear;
}
</style>


