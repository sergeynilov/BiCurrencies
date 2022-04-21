<template>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-4 d-block navbar-space"
         data-navbar-on-scroll="data-navbar-on-scroll">

        <div class="container">
            <jet-application-logo :icon_type="'small'" :layout="'frontend'" additive_class="mr-1 ml-1 mb-1" />

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span>
            </button>

            <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
                    <li class="nav-item px-2" data-anchor="data-anchor" v-if="route().current() != 'home'">
                        <inertia-link :href="route('home')" class="nav-link fw-medium ">
                            Home
                        </inertia-link>
                    </li>

                    <li class="nav-item px-2 d-flex flex-nowrap" data-anchor="data-anchor" v-if="loggedUser">
                        <inertia-link :href="route('admin.dashboard.index', loggedUser.id)" class="nav-link fw-medium " v-show="$page.props.auth.is_logged_user_admin">
                            <i :class="getHeaderIcon('admin')" class="action_icon" :title="loggedUser.id+':'+loggedUser.name + ', you have Admin rights'"></i>
                        </inertia-link>

                        <inertia-link :href="route('admin.dashboard.index', loggedUser.id)" class="nav-link fw-medium " v-show="$page.props.auth.is_logged_user_support_manager && !$page.props.auth.is_logged_user_admin">
                            <i :class="getHeaderIcon('support_manager')" class="action_icon" :title="loggedUser.id+':'+loggedUser.name + ', you have support manager rights'"></i>
                        </inertia-link>

                        <inertia-link :href="route('admin.dashboard.index', loggedUser.id)" class="nav-link fw-medium " v-show="$page.props.auth.is_logged_user_content_editor && !$page.props.auth.is_logged_user_admin">
                            <i :class="getHeaderIcon('content_editor')" class="action_icon" :title="loggedUser.id+':'+loggedUser.name + ', you have content editor rights'"></i>
                        </inertia-link>
                    </li>

                    <li class="nav-item px-2" data-anchor="data-anchor" v-if="route().current() != 'frontend.our_rules'">
                        <inertia-link :href="route('frontend.our_rules')" class="nav-link">
                            Our rules
                        </inertia-link>
                    </li>

                    <li class="nav-item px-2" data-anchor="data-anchor" v-if="route().current() != 'frontend.all_currencies'">
                        <inertia-link :href="route('frontend.all_currencies')" class="nav-link">
                            All currencies
                        </inertia-link>
                    </li>
                </ul>

                <button class="btn btn-outline-warning text-primary order-1 order-lg-0" v-show="!loggedUser"
                        @click="showUserLoginModal()">
                    Login
                </button>
                <inertia-link v-show="!loggedUser" :href="route('register_wizard')"
                    class="btn btn-outline-warning text-primary order-1 order-lg-0 d-flex flex-nowrap" :class="route().current('register_wizard') ? 'active' : ' '">
                    Register
                </inertia-link>
                <button class="nav-item px-2 action_icon" data-anchor="data-anchor" v-if="loggedUser"
                    @click.prevent="logout()">
                    <i :class="getHeaderIcon('logout')" class="action_icon mt-2"></i>
                </button>
            </div>

        </div>

    </nav>



    <vue-final-modal
        v-model="show_user_login_modal"
        classes="frontend_modal_container"
        content-class="frontend_modal_content"
    >
        <div class="row flex-center frontend_modal_header">
            <div class="col-md-6 order-0">
                <div class="p-1 m-0 text-start">
                    <h5>
                        <i :class="getHeaderIcon('user_login')" class="p-0 action_icon icon_right_text_margin"
                           style="margin-bottom: -2px !important; "></i>Login
                    </h5>
                </div>
            </div>
            <div class="col-md-6 order-1">
                <p class=" p-1 m-0 text-end">
                    <button class="frontend_modal_close p-0" @click.prevent="hideUserLoginModal">
                        x
                    </button>
                </p>
            </div>
        </div>

        <!--        formUserLoginEditor::{{ formUserLoginEditor }}<br>-->
        <!--        formUserLoginEditor.errors::{{ formUserLoginEditor.errors }}<br>-->
        <div class="content frontend_modal_content_editor_form frontend_modal_content_wrapper">
            <div class="block_2columns_md p-2"> <!-- modal_user_login_email -->
                <div class="horiz_divider_left_13">
                    <label for="modal_user_login_email">Email:</label>
                </div>
                <div class="horiz_divider_right_23">
                    <input type="text" class="form-control" id="modal_user_login_email"
                           v-model="formUserLoginEditor.email" maxlength="100">
                    <div class="fs-error mb-3" v-if="formUserLoginEditor.errors"
                         :class="{ 'd-block' : formUserLoginEditor.errors && formUserLoginEditor.errors.email}">
                        {{ formUserLoginEditor.errors.email }}
                    </div>

                </div>
            </div> <!-- class="block_2columns_md" modal_user_login_email -->

            <div class="block_2columns_md p-2"> <!-- modal_user_login_password -->
                <div class="horiz_divider_left_13">
                    <label for="modal_user_login_password">Password:</label>
                </div>
                <div class="horiz_divider_right_23">
                    <input type="text" class="form-control" id="modal_user_login_password"
                           v-model="formUserLoginEditor.password" maxlength="100">
                    <div class="fs-error mb-3" v-if="formUserLoginEditor.errors"
                         :class="{ 'd-block' : formUserLoginEditor.errors && formUserLoginEditor.errors.password}">
                        {{ formUserLoginEditor.errors.password }}
                    </div>
                </div>
            </div> <!-- class="block_2columns_md" modal_user_login_password -->
        </div>

    </vue-final-modal>


</template>


<script>
import {ref, computed, onMounted, watchEffect} from 'vue'
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'

import {
    getHeaderIcon,
    pluralize,
    isEmpty,
    getFileSizeAsString,
} from '@/commonFuncs'

import {
    // settingsJsMomentDatetimeFormat,
} from '@/app.settings.js'
import {useForm} from "@inertiajs/inertia-vue3";
import {usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import axios from "axios";
import FileUploaderPreviewer from '@/components/FileUploaderPreviewer.vue'
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'

// file:///mnt/_work_sdb8/wwwroot/lar/BiUsers/resources/js/Components/ListingHeader.vue

export default {
    name: 'FrontendNavbar',
    components: {
        VueFinalModal,
        FileUploaderPreviewer,
        JetApplicationLogo,
        ModalsContainer
    },
    setup() {
        let app_version = ref('D')
        let loggedUser = ref(usePage().props.value.user)
        let show_user_login_modal = ref(false)
        let formUserLoginEditor = ref(useForm({
            email: 'demo_user@site.com',
            password: 'de1mo_u2se3r',
        }))

        function logout() {
            console.log('+logout::')
            Inertia.get(route('logout.perform'));
        }



        // USER LOGIN BEGIN
        function showUserLoginModal() {
            if (!isEmpty(usePage().props.value.user)) {
                Toast.fire({
                    icon: "warning",
                    title: "You are already logged into the system !"
                })
                return
            }
            show_user_login_modal.value = true
            // formUserLoginEditor.value.name = ''
            // formUserLoginEditor.value.email = ''
            // formUserLoginEditor.value.password = ''
            // formUserLoginEditor.value.password_2 = ''
        }

        function hideUserLoginModal() {
            show_user_login_modal.value = false
            formUserLoginEditor.value.name = ''
            formUserLoginEditor.value.email = ''
            formUserLoginEditor.value.password = ''
            formUserLoginEditor.value.password_2 = ''
        }


        function sendUserLoginModal() {
            console.log('sendUserLoginModal::')

            formUserLoginEditor.value.post(route('login'), {
                preserveScroll: false,
                onSuccess: (resp) => {
                    console.log('sendUserLoginModal resp::')
                    console.log(resp)
                    hideUserLoginModal()
                    Toast.fire({
                        icon: 'success',
                        title: 'Successful login!'
                    })
                },
                onError: (e) => {
                    console.log(e)
                }
            })
        }

        // USER LOGIN END

        function frontendNavbarOnMounted() {
        }
        onMounted(frontendNavbarOnMounted)

        return { // setup return
            loggedUser,

            showUserLoginModal,
            hideUserLoginModal,
            sendUserLoginModal,


            show_user_login_modal,
            formUserLoginEditor,
            logout,


            // Common methods
            getHeaderIcon,
            pluralize,
            isEmpty,
            getFileSizeAsString,
            app_version

        }
    }, // setup() {

}
</script>
<style>

.fixed-top {
position: relative !important;

}
</style>
