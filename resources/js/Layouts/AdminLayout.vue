<template>

    <div class="dark-mode">
        <div class="wrapper">

            <!-- Preloader -->
<!--                         <div class="preloader flex-column justify-content-center align-items-center">-->
<!--                             <img class="animation__wobble" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
<!--                         </div>-->
            <AdminNavbar></AdminNavbar>

            <AdminSidebar/>
            <div :style="{ 'margin-left': sidebarWidth }" style="  height:100%;">

                <!-- Main content -->
                <section class="content">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <slot></slot>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- /.content -->

                <AdminFooter />

            </div>


        </div>
    </div>
</template>

<script>
import AdminFooter from '@/components/AdminFooter'
import AdminNavbar from '@/components/AdminNavbar'

import AdminSidebar from '@/components/sidebar/AdminSidebar'
import {sidebarWidth} from '@/components/sidebar/state'

export default {

    setup() {
        return {sidebarWidth}
    },

    name: 'AdminLayout',
    components: {
        AdminFooter, AdminNavbar, AdminSidebar
        // AdminLayout,
    },
}
</script>
