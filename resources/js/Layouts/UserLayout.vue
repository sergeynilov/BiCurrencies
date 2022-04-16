<template>

    <div>
        <div class="wrapper">

            <!-- Preloader -->
            <!--                         <div class="preloader flex-column justify-content-center align-items-center">-->
            <!--                             <img class="animation__wobble" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
            <!--                         </div>-->
            <UserNavbar></UserNavbar>

                <!-- Main content -->
                <slot></slot>
                <!-- /.content -->

            <UserFooter />

        </div>
    </div>
</template>

<script>
import UserFooter from '@/components/UserFooter'
import UserNavbar from '@/components/UserNavbar'

// import Sidebar from '@/components/sidebar/AdminSidebar'

// import Sidebar from '@/components/Sidebar'
export default {

    setup() {
        return {

        }
    },

    name: 'UserLayout',
    components: {
        UserFooter, UserNavbar
    },
}
</script>

<style>
.user_color {
    /*background-color: maroon !important;*/
}
.user_editable_label {
    /*background-color: yellowgreen !important;*/
}
.user_listing_header {
    /*color: red !important;*/
}

.user_listing_tr {
    /*color: blue !important;*/
}

.user_content_text {

}

</style>
