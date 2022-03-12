<template>
    <div class="dark-mode">
        <div class="wrapper d1">

            <!-- Preloader -->
<!--             <div class="preloader flex-column justify-content-center align-items-center">-->
<!--                 <img class="animation__wobble" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
<!--             </div>-->

            <!-- Navbar -->
            <Navbar></Navbar>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->

<!--            <Sidebar></Sidebar>-->


            <Sidebar />
            <div :style="{ 'margin-left': sidebarWidth }">

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper d2">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0">{{ $page.props.auth.site_name }} : Admin area</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <slot name="header"></slot>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <slot></slot>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

            </div>




            <Footer />
        </div>
    </div>

</template>

<script>
import Footer from '@/components/Footer'
import Navbar from '@/components/Navbar'

import Sidebar from '@/components/sidebar/Sidebar'
import { sidebarWidth } from '@/components/sidebar/state'

// import Sidebar from '@/components/Sidebar'
export default {

    setup() {
        return { sidebarWidth }
    },

    components: {
        Footer, Navbar, Sidebar // , Sidebar
        // AdminLayout,
    },
}
</script>
