<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4 "  VVVv-if="is_left_sidebar_block_visible">
        <!-- Brand Logo -->
        <inertia-link :href="route('current_rates')" class="brand-link">
            <img :src="'/dist/img/AdminLTELogo.png'" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ $page.props.auth.site_name }}</span>
        </inertia-link>

        <!-- Sidebar -->
        <div class="sidebar" style="display: noneRRR">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="'/dist/img/user2-160x160.jpg'" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info" v-if="is_left_sidebar_visible">
<!--                    <a href="#" class="d-block">{{ $page.props.user.name }}</a>-->
                    <inertia-link :href="route('admin.dashboard.index')" class="brand-link">
                        {{ $page.props.user.name }}
                    </inertia-link>

                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <inertia-link :href="route('admin.dashboard.index')" class="nav-link" :class="route().current('admin.dashboard.*') ? 'active' : ' '">
                            <i class="nav-icon `fas fa-tachometer-alt"></i>
                            <p v-if="is_left_sidebar_visible">
                                Dashboard
                            </p>
                        </inertia-link>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Tables
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
<!--                            <li class="nav-item" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin || $page.props.auth.hasRole.moderator || $page.props.auth.hasRole.developer">-->
<!--                                <inertia-link :href="route('admin.admins.index')" class="nav-link" :class="route().current('admin.admins.*') ? 'active' : ' '">-->
<!--                                    <i class="far fa-circle nav-icon"></i>-->
<!--                                    <p>-->
<!--                                        Admins-->
<!--                                    </p>-->
<!--                                </inertia-link>-->
<!--                            </li>-->
<!--                            <li class="nav-item" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin || $page.props.auth.hasRole.moderator">-->
<!--                                <inertia-link :href="route('admin.users.index')" class="nav-link" :class="route().current('admin.users.*') ? 'active' : ' '">-->
<!--                                    <i class="far fa-circle nav-icon"></i>-->
<!--                                    <p>-->
<!--                                        Users-->
<!--                                    </p>-->
<!--                                </inertia-link>-->
<!--                            </li>-->
                            <li class="nav-item" >
                                <inertia-link :href="route('admin.roles.index')" class="nav-link" :class="route().current('admin.roles.*') ? 'active' : ' '">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Roles
<!--                                        v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin || $page.props.auth.hasRole.moderator"-->
                                    </p>
                                </inertia-link>
                            </li>
                            <li class="nav-item" >
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
                                        <!--                                        v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin || $page.props.auth.hasRole.moderator"-->
                                    </p>
                                </inertia-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">MISCELLANEOUS</li>

                    <li class="nav-item">
                        <inertia-link :href="route('dashboard')" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Site </p>
                        </inertia-link>
                    </li>

                    <li class="nav-item">
                        <inertia-link :href="route('admin.currencies.index')" class="nav-link">
                            <i :class="getHeaderIcon('currency')"></i>
                            <p>Currencies </p>
                        </inertia-link>
                    </li>

                    <li class="nav-item">
                        <inertia-link :href="route('admin.users.index')" class="nav-link">
                            <i :class="getHeaderIcon('users')"></i>
                            <p>Users 90 </p>
                        </inertia-link>
                    </li>

                    <li class="nav-item">
                        <inertia-link :href="route('admin.settings.index')" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Settings </p>
                        </inertia-link>
                    </li>

                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form @submit.prevent="logout">
                            <button type="submit" class="nav-button">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
import {ref, computed, onMounted} from 'vue'

import {
    getHeaderIcon,
    getErrorMessage,
} from '@/commonFuncs'


import {
    settingsJsMomentDatetimeFormat,
} from '@/app.settings.js'

// file:///mnt/_work_sdb8/wwwroot/lar/BiUsers/resources/js/Components/ListingHeader.vue

export default {
    name: 'Sidebar',
    components: {
    },
    setup() {


        const is_left_sidebar_visible = ref(true)

        const adminSidebarOnMounted = async () => {
            window.emitter.on('leftAdminSidebarSwitchEvent', params => {
                // console.log('TARGET leftAdminSidebarSwitchEvent params::')
                // console.log(params)
                is_left_sidebar_visible.value= !is_left_sidebar_visible.value
                // if (params.parentComponentKey === 'user') {
                //     userRowsPaginationPageClicked(params.page)
                // }
            })

        }
        onMounted(adminSidebarOnMounted)

        return { // setup return

            // Common methods
            getErrorMessage,
            getHeaderIcon,
            is_left_sidebar_visible
        }
    }, // setup() {

}
</script>
