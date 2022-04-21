<template>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        <Navbar></Navbar>

        <slot></slot>

        <Footer></Footer>

    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->

</template>


<script>
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'

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
import Navbar from '@/Pages/Frontend/Navbar.vue'
import Footer from '@/Pages/Frontend/Footer.vue'

export default {
    name: 'FrontendLayout',
    components: {
        VueFinalModal,
        Navbar,
        Footer
    },
    setup() {

        let app_version = ref('D')

        function FrontendLayoutMounted() {
        }

        onMounted(FrontendLayoutMounted)

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

.frontend_editable_label {
    /*color: $admin_editable_input_color !important;*/
    white-space: break-spaces;
}

.form_processing {
    align-self: center;
    align-items: center;
    background-image: url(/images/big_loading.gif);
    background-repeat: no-repeat;
    background-size: 30px 30px;
    width: 30px;
    height: 30px;
    margin: 2px;
    margin-left: 8px;
    padding: 0;
}

.action_icon {
    cursor: pointer;
}

.icon_right_text_margin {
    margin-right: 3px;
}

.frontend_modal_content_wrapper {
    /*border: 2px dotted blue !important;*/
    overflow-y: scroll;
    max-height: 600px;
    padding: 0;
    margin: 0;
}

.frontend_img_preview_wrapper {
    text-align: center !important;
    padding: 4px;
    margin: 2px;
    border: red;
    /*border: $admin_border_separator_color;*/
    max-width: 340px;
    height: auto;
}

.btn-outline-secondary {
    background-color: gray;
}

.btn-outline-success {
    background-color: blue;
}


.right_btn_from_left_margin {
    margin-left: 30px !important;
}


.frontend_pagination {
    /*color: greenyellow;*/
    /*background-color:#FFF5D6;*/
    /*color: $frontend_text_color;*/
    /*background-color:  $frontend_background_color;*/
    width: 100%;
    display: flex;
    justify-content: flex-start !important;
    margin: 5px;
    padding: 5px;
    max-width: 1280px;
}

.frontend_pagination li {
    list-style: none;
}

.page-link {
    cursor: pointer;
}


.frontend_listing_header {
    color: $ frontend_listing_header_color !important;
}

.frontend_listing_cell {
    color: $ frontend_listing_cell_color !important;
}

.frontend_ul ul {
    list-style: none;
    /*display: inline-block;*/
    padding: 0;
    margin: 0;
}

.frontend_ul li {
    list-style: none;
    /*display: inline-block;*/
}


.pre-formatted, .pre-formatted > p {
    margin: 0;
    margin-bottom: 10px;
    padding: 2px;
    line-height: 1.6em;
    text-align: left;
}


.frontend_modal_container {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: $ frontend_background_color;
    margin-top: 65px !important;
}

.frontend_modal_header {
    /*background: blue !important;*/
    /*color:blue;*/
    background: #FFF3D3 !important;
    color: $ frontend_background_color;
    border-bottom: 1px solid #a5bdbb;
    border-radius: 0.25rem !important;
    padding: 6px 0 6px 0;
    margin: 0;
    position: relative;
}

.frontend_modal_footer {
    border-top: 1px solid #a5bdbb;
    border-radius: 0.25rem !important;
    background: #FFF3D3 !important;
    margin: 0;
    padding: 10px 0 10px 0;
}

.frontend_modal_content {
    position: relative;
    width: 80%;
    margin-left: 4px;
    /*margin-top: 20px;*/
    min-height: 400px;
    padding: 0;
    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
    box-shadow: inset 0 0 0 transparent !important;
    display: flex;
    flex-direction: column;
    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */
    background: rgba(222, 255, 252, 1.0);
}

.frontend_content_text {
    background-color: $ frontend_background_color;
    color: $ frontend_text_color;
}


.frontend_modal_close {
    background-color: $ frontend_text_color;
    color: $ frontend_background_color;
    position: absolute;
    top: 0;
    margin-top: 22px;
    margin-right: 12px;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 24px;
    height: 24px;
    /*margin: 4px 4px 0 0;*/
    cursor: pointer;
}

.frontend_modal_close::hover {
    /*color: $frontend_text_color !important;*/
    background-color: $ frontend_text_color;
    color: $ frontend_background_color;
}


.frontend_modal_content_editor_form {
    margin-top: 0.7rem;
    flex: 1; /* same as flex: 1 1 auto; */
    background: $ frontend_background_color;
}


.currency_image_left_aligned {
    border: 1px dotted gray;
    padding: 2px;
    margin: 5px;
    max-width: 140px;
    height: auto;
}

.i {
    margin-right: 4px;
    /*border: 2px dotted red;*/
}

.currency_big_image {
    /*    border: 2px dotted red;*/
    padding: 2px;
    margin: 5px;
    /*max-height: 300px !important;*/
    height: 300px !important;
    /*max-width: 100% !important;*/
    width: auto;
    max-width: 300px;
}


.author_avatar_big_image {
    border: 1px dotted gray;
    padding: 2px;
    margin: 5px;
    max-height: 260px !important;
    width: auto;
    max-width: 260px;
}

.page_image_left_aligned {
    border: 1px dotted gray;
    padding: 2px;
    margin: 5px;
    max-width: 440px;
    height: auto;
}


/* Medium ≥768px  ipad or ipad mini */
@media only screen and (min-width: 768px) and (max-width: 991px) {
    /* Ipad Pro md */
    .page_image_left_aligned {
        max-width: 320px;
    }

    .frontend_modal_content {
        min-height: 450px;
        width: 50%;
        background: $ frontend_background_color !important;
    }
}


/* Small ≥ 576px Nexus7  - sm*/
@media only screen and (min-width: 576px) and (max-width: 767px) {
    .page_image_left_aligned {
        max-width: 250px;
    }
}

/*  Extra small < 576px	iphon5/SE  */
@media only screen and (max-width: 575px) {
    .page_image_left_aligned {
        max-width: 145px;
    }
}


</style>
