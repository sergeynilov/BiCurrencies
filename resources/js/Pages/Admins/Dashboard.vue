<template>

    <admin-layout>

        <template #header>
            <h1 class="m-0">Dashboard 123</h1>
        </template>

        <section class="content" style="height: 100% !important; margin-bottom: 50px !important;">

            <div class="container-fluid">
                <h4>Currencies</h4>
                <div class="row"> <!-- Currencies ROW BLOCK START -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">All</span>
                                <span class="info-box-number">
                                    {{ all_currencies_count }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i
                                    class="fab fa-creative-commons-sa"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Active</span>
                                <span class="info-box-number">{{ active_currencies_count }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i
                                class="fab fa-creative-commons-nc"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Inactive</span>
                                <span class="info-box-number">{{ inactive_currencies_count }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Histories values</span>
                                <span class="info-box-number">{{ all_currencies_histories_count }}</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- Currencies ROW BLOCK END -->


                <h4>Users</h4>
                <div class="row"> <!-- Users ROW BLOCK START -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">All</span>
                                <span class="info-box-number">
                                    {{ all_users_count }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i
                                    class="fab fa-creative-commons-sa"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Active</span>
                                <span class="info-box-number">{{ active_users_count }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i
                                class="fab fa-creative-commons-nc"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Inactive</span>
                                <span class="info-box-number">{{ inactive_users_count }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">New( Waiting activation )</span>
                                <span class="info-box-number">{{ new_users_count }}</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- Users ROW BLOCK END -->


                <h4>Currency subscriptions</h4>
                <div class="row mb-8 pb-8"> <!-- USER_CURRENCY_SUBSCRIPTIONS ROW BLOCK START -->
                    <div class="col-12 col-sm-6 col-md-4 pb-8"  v-for="(nextUserCurrencySubscription, index) in userCurrencySubscriptions" :key="index">
                        <div class='currency-image-wrapper'>
                            <img :src="nextUserCurrencySubscription.currency_media_image_url" class="img-fluid border-upper-radius admin_img_icon_wrapper" alt="#">
                            <p class="currency-top-count">{{ nextUserCurrencySubscription.currency_subscriptions_count }}</p>
                        </div>
                        <p class="info-box-text">
                            {{ nextUserCurrencySubscription.currency_char_code }}/
                            {{ nextUserCurrencySubscription.currency_name }}
                        </p>
                    </div>
                </div> <!-- USER_CURRENCY_SUBSCRIPTIONS ROW BLOCK END -->


                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>

    </admin-layout>

</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'


import {
    getHeaderIcon,
    pluralize,
    pluralize3,
    momentDatetime,
    getErrorMessage,
    showFlashMessage,
    getDictionaryLabel,
} from '@/commonFuncs'
import {dashboardJsMomentDatetimeFormat} from '@/app.settings.js'
import * as sanitizeHtml from 'sanitize-html'

import {onMounted, ref} from "vue";
import axios from "axios";
import {usePage} from '@inertiajs/inertia-vue3';

// import VueUploadComponent from 'vue-upload-component'
// app.component('file-upload', VueUploadComponent)

export default {
    props: [],

    name: 'DashboardEdit',
    components: {
        AdminLayout,
        // FileUpload: VueUploadComponent,
    },
    setup(props) {
        let active_currencies_count = ref(0)
        let inactive_currencies_count = ref(0)
        let all_currencies_count = ref(0)
        let all_currencies_histories_count = ref(0)

        let active_users_count = ref(0)
        let inactive_users_count = ref(0)
        let new_users_count = ref(0)
        let all_users_count = ref(0)
        let userCurrencySubscriptions = ref([])

        function LoadDashboardCurrencyInfo() {
            axios.get(route('admin.dashboard.get_currency_info'))
                .then(({data}) => {
                    console.log('LoadDashboardCurrencyInfo data::')
                    console.log(data)
                    active_currencies_count.value = data.active_currencies_count
                    inactive_currencies_count.value = data.inactive_currencies_count
                    all_currencies_count.value = data.all_currencies_count
                    all_currencies_histories_count.value = data.all_currencies_histories_count
                })
                .catch(e => {
                    console.error(e)
                })
        }

        function LoadDashboardUsersInfo() {
            axios.get(route('admin.dashboard.get_users_info'))
                .then(({data}) => {
                    console.log('LoadDashboardUsersInfo data::')
                    console.log(data)
                    active_users_count.value = data.active_users_count
                    inactive_users_count.value = data.inactive_users_count
                    new_users_count.value = data.new_users_count
                    all_users_count.value = data.all_users_count
                    // all_currencies_histories_count.value = data.all_currencies_histories_count
                })
                .catch(e => {
                    console.error(e)
                })
        } // LoadDashboardUsersInfo

        function LoadDashboardUserCurrencySubscriptionsInfo() {
            axios.get(route('admin.dashboard.get_user_currency_subscriptions_info'))
                .then(({data}) => {
                    console.log('LoadDashboardUserCurrencySubscriptionsInfo data::')
                    console.log(data)
                    userCurrencySubscriptions.value = data.userCurrencySubscriptions
                    // inactive_users_count.value = data.inactive_users_count
                    // new_users_count.value = data.new_users_count
                    // all_users_count.value = data.all_users_count
                    // all_currencies_histories_count.value = data.all_currencies_histories_count
                })
                .catch(e => {
                    console.error(e)
                })
        } // LoadDashboardUserCurrencySubscriptionsInfo

        function adminDashboardEditOnMounted() {
            showFlashMessage()
/*

            console.log('adminDashboardEditOnMounted usePage().props.value.site_name::')
            console.log( usePage().props.value.site_name )
            console.log('Edit.vue  usePage().props.value::')
            console.log( usePage().props.value)
*/


            // console.log('Edit.vue  usePage().props.value.flash::')
            // console.log( usePage().props.value.jetstream.flash)
            // console.log('Edit.vue  usePage().props.value.flash_type.message::')
            // console.log( usePage().props.value.flash_type.message)
            // jetstream:Object
            LoadDashboardCurrencyInfo()
            LoadDashboardUsersInfo()
            // get_user_currency_subscriptions_info
            LoadDashboardUserCurrencySubscriptionsInfo()
        }

        onMounted(adminDashboardEditOnMounted)


        return { // setup return
            // Listing Page state
            LoadDashboardCurrencyInfo,
            LoadDashboardUsersInfo,
            LoadDashboardUserCurrencySubscriptionsInfo,
            // LoadDashboardCurrencyInfo,
            active_currencies_count,
            inactive_currencies_count,
            all_currencies_count,
            all_currencies_histories_count,

            active_users_count,
            inactive_users_count,
            new_users_count,
            all_users_count,

            userCurrencySubscriptions,
            // Common methods
            getHeaderIcon,
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            showFlashMessage,
            getDictionaryLabel,
            sanitizeHtml,
        }
    }, // setup() {

}
</script>

<style>

.currency-image-wrapper {
    position: relative;
}
.currency-image-wrapper .currency-top-count {
    position: absolute;
    display: inline-block;
    padding: 2px 5px;
    background: #eee;
    color: #000;
    z-index: 2;
}
.currency-image-wrapper .currency-top-count {
    background: green;
    color: white;
    top: 8px;
    left: 8px;
    border: 2px solid white;
}

</style>


