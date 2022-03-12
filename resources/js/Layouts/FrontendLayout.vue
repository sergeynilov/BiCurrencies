<template>
    <div class="darkRRR-mode">
        <div class="wrapper">

            <!-- Preloader -->
            <!--                    <div class="preloader flex-column justify-content-center align-items-center">-->
            <!--                        <img class="animation__wobble" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
            <!--                    </div>-->

            <!-- Navbar -->
            <!--            <Navbar></Navbar>-->
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <!--            <Sidebar></Sidebar>-->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">

                            <div class="col-sm-6">
                                <h1 class="m-0">
                                    Frontend v2
                                    <i class="test-device p-1 m-1" v-if="app_version == 'D'">
                                        {{ app_version}}
                                    </i>

                                </h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <slot name="header"></slot>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <!--                resources/js/Layouts/FrontendLayout.vue-->
                <slot></slot>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!--            <Footer />-->
        </div>
    </div>

</template>


<script>
import axios from 'axios' // eslint-disable-line
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import Multiselect from '@vueform/multiselect'
import Pagination from '@/components/ListingPagination.vue'


// import Pagination from '@/components/Pagination'

import {
    getHeaderIcon,
    getErrorMessage,
    pluralize,
    pluralize3,
    momentDatetime,
    getDictionaryLabel,
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels
} from '@/app.settings.js'

// file:///mnt/_work_sdb8/wwwroot/lar/BiCurrencies/resources/js/Components/ListingHeader.vue
// import app from '@/main.js'

export default {
    name: 'FrontendLayout',
    components: {
        VueFinalModal,
    },
    setup() {
        const app_version = ref('D')



        const FrontendLayoutListOnMounted = async () => {
            // window.emitter.on('paginationPageChangedEvent', params => {
            //     console.log('TARGET paginationPageChangedEvent params::')
            //     console.log(params)
            //     if (params.parentComponentKey === 'currency') {
            //         currencyRowsPaginationPageClicked(params.page)
            //     }
            // })

        } // const FrontendLayoutListOnMounted = async () => {

        onMounted(FrontendLayoutListOnMounted)

        return { // setup return
            // Listing Page state
            app_version,


            // Settings vars
            settingsJsMomentDatetimeFormat,
            settingsCurrencyActiveLabels,
            settingsCurrencyIsTopLabels,


            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            getHeaderIcon,
            getDictionaryLabel,
        }
    }, // setup() {

}
</script>


<style>
.currencies_modal_container {
    display: flex;
    justify-content: center;
    align-items: center;
    /*background-color: #343A40;*/
    /*background-color: olive !important;*/
}

.currencies_modal_header {
    background-color: #0f6d7c;
    color: $ text-color;
    /*border-bottom: 2px solid rgba(123,123,123);*/
    border-bottom: 1px solid $ text-color;
    /*padding: 0;*/
    padding: 0.5rem 0.5rem;
    margin: 0;
    position: relative;
    /*border-top-left-radius: 0.5rem;*/
    /*border-top-right-radius: 0.5rem;*/
}

.currencies_modal_footer {
    /*border-top: 1px solid white;*/
    padding: 0.8rem;
    /*background-color: yellow;*/
}

.currencies_modal_content {
    position: relative;
    width: 50%;

    margin-left: 4px;
    min-height: 360px;
    /*max-height: 360px;*/
    padding: 0;
    overflow: auto;
    /*background-color: red !important;*/
    background-color: #343A40 !important;
    /*border-radius: 4px;*/

    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
    box-shadow: inset 0 0 0 transparent !important;
    /*border: 2px dotted yellow !important;*/


    /*height: 100%;*/
    /*//////////*/
    display: flex;
    flex-direction: column;

    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */

    background: rgba(255, 255, 255, .1);

}

/* Medium ≥768px  ipad or ipad mini */
@media only screen and (min-width: 768px) and (max-width: 991px) {
    /* Ipad Pro md */
    .currencies_modal_content {
        min-height: 500px;
        /*background-color: yellow !important;*/
    }
}

.currencies_modal_close {
    background-color: #0f6d7c;
    color: $ text-color !important;
    position: absolute;
    top: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 24px;
    height: 24px;
    /*margin: 4px 4px 0 0;*/
    cursor: pointer;
}

.currencies_modal_close::hover {
    color: $ text-color !important;
    background-color: #0f6d7c;
}

.multiselect {
    /*    display: block  !important;*/
    /*    width: 100%  !important;*/
    /*    height: calc(2.25rem + 2px)  !important;*/
    /*    padding: 0.375rem 0.75rem  !important;*/
    /*    font-size: 1rem  !important;*/
    /*    font-weight: 400  !important;*/
    /*    line-height: 1.5  !important;*/
    /*    background-clip: padding-box  !important;*/
    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
    box-shadow: inset 0 0 0 transparent !important;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;


    background-color: #343A40 !important;
    color: $ admin_form_background_color !important;
}


.currencies_modal_content_editor_form {
    margin-top: 0.7rem;
    flex: 1; /* same as flex: 1 1 auto; */
    background-color: #343A40;
}


</style>
