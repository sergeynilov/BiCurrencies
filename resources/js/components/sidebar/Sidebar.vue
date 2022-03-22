<template>
    <div class="sidebar" :style="{ width: sidebarWidth }">
        <h3>
            <span v-if="collapsed">
                <div>{{ getInitialLetter($page.props.auth.site_name, true) }}</div>
                <div>{{ getInitialLetter($page.props.auth.site_name, false) }}</div>
            </span>
            <span v-else>
                {{ $page.props.auth.site_name }}
            </span>
        </h3>

        <SidebarLink link_to="home" link_icon="home">Home</SidebarLink>
        <SidebarLink link_to="frontend.current_rates" link_icon="home">Current rates</SidebarLink>
        <SidebarLink link_to="admin.dashboard.index" link_icon="dashboard" :active_component="'Admins/Dashboard'">Dashboard
        </SidebarLink>
        <!--        <SidebarLink to="/dashboard" icon="fas fa-columns">Dashboard</SidebarLink>-->
        <SidebarLink link_to="admin.currencies.index" link_icon="currency" :active_component="'Admins/Currencies'">
            Currencies
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

export default {
    name: 'Sidebar',
    props: {},
    components: {SidebarLink},
    setup() {

        // console.log('Sidebar.vue  usePage().props::')
        // console.log( usePage().props)
        // console.log('Sidebar.vue  usePage().props.value::')
        // console.log( usePage().props.value)
        // console.log('Sidebar.vue  usePage().props.auth::')
        // console.log( usePage().props.auth)
        //

        function toggleSidebar() {
            collapsed.value = !collapsed.value
            window.emitter.emit('AdminSidebarCollapseSwitcherEvent', {
                parentComponentKey: 'Sidebar'
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


        const adminSidebarOnMounted = async () => {
            // $page.props.auth.site_name $agent_device

            //                 <div>{{ getInitialLetter($page.props.auth.site_name, true) }}</div>

            /*
                        console.log('Sidebar.vue  usePage().props.auth.value.agent_device::')
                        console.log( usePage().props.auth.value.agent_device)
            */

            window.emitter.on('AdminTopNavbarSwitchEvent', params => {
                console.log('TARGET AdminTopNavbarSwitchEvent params::')
                console.log(params)
                collapsed.value = !collapsed.value
                // if (params.parentComponentKey === 'user') {
                //     userRowsPaginationPageClicked(params.page)
                // }
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
            // is_left_sidebar_visible
        }
    }, // setup() {---

}
</script>


<style>
:root {
    --sidebar-bg-color: #343A40;
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


