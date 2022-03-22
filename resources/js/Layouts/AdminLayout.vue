<template>

    <div class="dark-mode">
        <div class="wrapper">

            <!-- Preloader -->
<!--                         <div class="preloader flex-column justify-content-center align-items-center">-->
<!--                             <img class="animation__wobble" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
<!--                         </div>-->
            <Navbar></Navbar>

            <Sidebar/>
            <div :style="{ 'margin-left': sidebarWidth }" style="  height:100%;">

                <!-- Main content -->
                <slot></slot>
                <!-- /.content -->


            </div>

            <Footer />

        </div>
    </div>
</template>

<script>
import Footer from '@/components/Footer'
import Navbar from '@/components/Navbar'

import Sidebar from '@/components/sidebar/Sidebar'
import {sidebarWidth} from '@/components/sidebar/state'

// import Sidebar from '@/components/Sidebar'
export default {

    setup() {
        return {sidebarWidth}
    },

    name: 'AdminLayout',
    components: {
        Footer, Navbar, Sidebar // , Sidebar
        // AdminLayout,
    },
}
</script>
