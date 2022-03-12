<template>
    <div class="sidebar" :style="{ width: sidebarWidth }">
        <!--        collapsed::{{ collapsed}}-->
        <h1>
            <span v-if="collapsed">
                <div>V</div>
                <div>S</div>
            </span>
            <span v-else>
                Vue Sidebar
            </span>
        </h1>

        <SidebarLink link_to="frontend.current_rates" link_icon="home">Home</SidebarLink>
        <SidebarLink link_to="admin.dashboard.index" link_icon="home">Dashboard</SidebarLink>
        <!--        <SidebarLink to="/dashboard" icon="fas fa-columns">Dashboard</SidebarLink>-->
        <SidebarLink link_to="admin.currencies.index" link_icon="currency" link_active="'admin.currencies.*'">Currencies 1</SidebarLink>
        <!--        <SidebarLink to="/friends" icon="fas fa-users">Friends</SidebarLink>-->
        <!--        <SidebarLink to="/image" icon="fas fa-image">Images</SidebarLink>-->

        <!--        <li class="nav-item" >
                    <inertia-link :href="route('admin.currencies.index')" class="nav-link" :class="route().current('admin.currencies.*') ? 'active' : ' '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Currencies  0
                        </p>
                    </inertia-link>
                </li>

                <li class="nav-item" >
                    <inertia-link :href="route('admin.settings.index')" class="nav-link" :class="route().current('admin.settings.*') ? 'active' : ' '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Settings 0
                        </p>
                    </inertia-link>
                </li>

                <li class="nav-item" >
                    <inertia-link :href="route('admin.users.index')" class="nav-link" :class="route().current('admin.users.*') ? 'active' : ' '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Users 321
                            &lt;!&ndash;                                        v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin || $page.props.auth.hasRole.moderator"&ndash;&gt;
                        </p>
                    </inertia-link>
                </li>

                -->
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
import {collapsed, toggleSidebar, sidebarWidth} from './state'
import {ref, computed, onMounted} from 'vue'

import {
    getHeaderIcon,
    getErrorMessage,
} from '@/commonFuncs'

export default {
    name: 'Sidebar',
    props: {},
    components: {SidebarLink},
    setup() {

        // const is_left_sidebar_visible = ref(true)


        const adminSidebarOnMounted = async () => {
            window.emitter.on('leftAdminSidebarSwitchEvent', params => {
                console.log('TARGET leftAdminSidebarSwitchEvent params::')
                console.log(params)
                collapsed.value = !collapsed.value
                // if (params.parentComponentKey === 'user') {
                //     userRowsPaginationPageClicked(params.page)
                // }
            })

        }

        onMounted(adminSidebarOnMounted)

        return { // setup return
            collapsed, toggleSidebar, sidebarWidth,

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
    padding: 0.75em;

    color: rgba(255, 255, 255, 0.7);

    transition: 0.2s linear;
}

.rotate-180 {
    transform: rotate(180deg);
    transition: 0.2s linear;
}
</style>


