<template>

    <user-layout>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title flex-nowrap user_content_text">
                    Your profile
                </h3>
            </div>

            <div class=" card-primary card-tabs">
                <div class="card-header p-2">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <!--                                                    active-->
                            <a class="nav-link " id="currency-details-tab" data-toggle="pill"
                               href="#tabs-profile-details" role="tab"
                               aria-controls="tabs-profile-details" aria-selected="true">
                                Your profile details
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link " id="tabs-profile-user-currency-subscriptions-tab"
                               data-toggle="pill"
                               href="#tabs-profile-user-currency-subscriptions" role="tab"
                               aria-controls="tabs-profile-user-currency-subscriptions"
                               aria-selected="false">
                                Currency subscriptions
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-0">
                    <div class="tab-content h-100" id="custom-tabs-one-tabContent">
                        <!--                                                show active-->
                        <div class="tab-pane fade" id="tabs-profile-details" role="tabpanel"
                             aria-labelledby="currency-details-tab">

                            <div class="block_2columns_md p-2"> <!-- id -->
                                <div class="horiz_divider_left_13">
                                    <label for="id" class="user_editable_label">Id:</label>
                                </div>
                                <div class="horiz_divider_right_23">
                                    <input type="text" class="form-control" id="id" disabled v-model="profileUser.id">
                                </div>
                            </div> <!-- class="block_2columns_md" id -->

                            <div class="block_2columns_md p-2"> <!-- name -->
                                <div class="horiz_divider_left_13">
                                    <label class="user_editable_label" for="name">Name:</label>
                                </div>
                                <div class="horiz_divider_right_23">
                                    <input type="text" class="form-control" id="name" v-model="profileUser.name"
                                           disabled>
                                </div>
                            </div> <!-- class="block_2columns_md" name -->

                            <div class="block_2columns_md p-2"> <!-- name -->
                                <div class="horiz_divider_left_13">
                                    <label class="user_editable_label">Permissions:</label>
                                </div>
                                <div class="horiz_divider_right_23">
                                    <p class="pe-xl-9"
                                       v-for="(nextProfileUserPermission, index) in profileUserPermissions"
                                       :key="index">
                                        {{ nextProfileUserPermission.name }}
                                    </p>
                                </div>
                            </div> <!-- class="block_2columns_md" name -->


                            <div class="block_2columns_md p-2"> <!-- created_at -->
                                <div class="horiz_divider_left_13">
                                    <label class="user_editable_label" for="created_at">Created:</label>
                                </div>
                                <div class="horiz_divider_right_23">
                                    <input type="text" class="form-control" id="created_at" disabled
                                           v-model="createdAtLabel">
                                </div>
                            </div> <!-- class="block_2columns_md" created_at -->

                            <div class="block_2columns_md p-2" v-if="profileUser.updated_at">
                                <!-- created_at -->
                                <div class="horiz_divider_left_13">
                                    <label class="user_editable_label" for="updated_at">Updated:</label>
                                </div>
                                <div class="horiz_divider_right_23">
                                    <input type="text" class="form-control" id="updated_at" disabled
                                           v-model="updatedAtLabel">
                                </div>
                            </div> <!-- class="block_2columns_md" updated_at -->

                        </div>


                        <div class="tab-pane show active" id="tabs-profile-user-currency-subscriptions" role="tabpanel"
                             aria-labelledby="tabs-profile-user-currency-subscriptions-tab">
                            <ListingHeader
                                :show_filters_button="false"
                                :parent_component_key="'user_currency_subscriptions'"
                                :page_rows_count="userCurrencySubscriptions.length"
                                :left_header_icon="getHeaderIcon('currency')"
                                :headerTitle="'Currencies'"
                                :rightAddButtonLink="''"
                                :itemTitle="pluralize(userCurrencySubscriptions.length,  'currency', 'currencies')"
                                :rightAddButtonLinkTitle="''"
                                :right_icon="''"
                            >
                            </ListingHeader>

                            <div class="p-0" v-show="userCurrencySubscriptions.length == 0">
                                <p class="text-sm text-warning p-2 pl-4">
                                    <i :class="getHeaderIcon('info')" class="icon_right_text_margin"></i>
                                    No data found. Try to change filter options.
                                </p>
                            </div>

                            <div class="table-responsive p-0"
                                 v-show="userCurrencySubscriptions.length > 0">

                                <table class="table table-striped table-hover text-nowrap">
                                    <thead>
                                    <tr class="user_listing_header">
                                        <th class="text-capitalize">Id</th>
                                        <th class="text-capitalize">Currency</th>
                                        <th class="text-capitalize text-right"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(nextUserCurrencySubscription, index) in userCurrencySubscriptions"
                                        :key="index" class="user_listing_tr">
                                        <td>
                                            <!--                                        {{nextUserCurrencySubscription.id}}=>-->
                                            {{ nextUserCurrencySubscription.is_selected }}
                                        </td>

                                        <td>
                                            {{ nextUserCurrencySubscription.name }}
                                        </td>

                                        <td class="text-right d-flex flex-nowrap">

                                            <div v-show="nextUserCurrencySubscription.is_selected">
                                                <i :class="getHeaderIcon('check')"
                                                   class="icon_right_text_margin"
                                                   title="You are subscribed to this currency"></i>
                                                Subscribe
                                                <button class="btn btn-danger p-0 px-1  m-0  ml-1"
                                                        @click.prevent="unpinNextUserCurrencySubscription(nextUserCurrencySubscription)">
                                                    <i :class="getHeaderIcon('remove')"
                                                       class="action_icon icon_right_text_margin"
                                                       title="Unsubscribe from this currency"></i> Unsubscribe
                                                </button>
                                            </div>

                                            <div v-show="!nextUserCurrencySubscription.is_selected">Not subscribed
                                                <button class="btn btn-success p-0 px-1  m-0  ml-1 "
                                                        @click.prevent="subscribeNextUserCurrencySubscription(nextUserCurrencySubscription)">
                                                    <i :class="getHeaderIcon('remove')"
                                                       class="action_icon icon_right_text_margin"
                                                       title="You are subscribed to this currency"></i> Subscribe
                                                </button>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- tabs-profile-user-currency-subscriptions -->

                    </div>


                </div> <!-- tab-content -->

                <div class="card-footer user_color clearfix flex m-2 p-2">
                    <button type="button" class="btn btn-secondary btn-sm"
                            @click="goHome">
                        <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Home
                    </button>
                </div>

            </div> <!-- card-tabs -->
        </div>

    </user-layout>

</template>


<script>
import UserLayout from '@/Layouts/UserLayout'
import axios from 'axios'
import ListingHeader from '@/components/ListingHeader.vue'
import Multiselect from '@vueform/multiselect'
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'


import {
    getHeaderIcon,
    getErrorMessage,
    pluralize,
    pluralize3,
    momentDatetime,
    getDictionaryLabel,
    showRTE,
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'

import {settingsJsMomentDatetimeFormat, settingsAppColors} from '@/app.settings.js'
import {Inertia} from "@inertiajs/inertia";

export default {
    name: 'userProfileIndex',

    props: {
        profileUser: {
            profileUser: Object,
            required: true,
        },
        profileUserPermissions: {
            profileUser: Object,
            required: true,
        },
        profile_user_media_image_url: {
            profileUser: String,
            required: true,
        }
    },


    components: {
        UserLayout,
        ListingHeader,
        Multiselect,
        VueFinalModal,
        ModalsContainer,
    },
    setup(props, attrs) {
        let profileUser = ref(props.profileUser)
        let profileUserPermissions = ref(props.profileUserPermissions)
        let profile_user_media_image_url = ref(props.profile_user_media_image_url)
        let userCurrencySubscriptions = ref([])
        let createdAtLabel = computed(() => {
            return momentDatetime(profileUser.value.created_at, settingsJsMomentDatetimeFormat)
        });
        let updatedAtLabel = computed(() => {
            return momentDatetime(profileUser.value.updated_at, settingsJsMomentDatetimeFormat)
        });

        function goHome() {
            Inertia.visit(route('home'), {method: 'get'});
        }

        function loadUserCurrencySubscriptions() {
            console.log('-2 loadUserCurrencySubscriptions ::')
            axios.get(route('user.user_currency_subscriptions.index', profileUser.value.id))
                .then(({data}) => {
                    console.log('loadUserCurrencySubscriptions data::')
                    console.log(data)
                    userCurrencySubscriptions.value = data
                })
                .catch(e => {
                    console.error(e)
                })
        } // loadUserCurrencySubscriptions() {

        function subscribeNextUserCurrencySubscription(currency) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to subscribe to selected currency!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, subscribe it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('subscribeNextUserCurrencySubscription currency::')
                    console.log(currency)
                    axios.post(route('user.user_currency_subscriptions.store', {currency_id: currency.id}))
                        .then(({data}) => {
                            console.log('subscribeNextUserCurrencySubscription data::')
                            console.log(data)
                            loadUserCurrencySubscriptions()
                            Swal.fire(
                                'Your currency subscriptions ! ',
                                'You were subscribed to selected currency successfully !',
                                'success'
                            )
                        })
                        .catch(e => {
                            showRTE(e)
                            console.error(e)
                        })
                }
            })
        } // function subscribeNextUserCurrencySubscription(currency) {


        function unpinNextUserCurrencySubscription(currency) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to unpin this currency ! ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, unpin it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('unpinNextUserCurrencySubscription currency::')
                    console.log(currency)
                    axios.delete(route('user.user_currency_subscriptions.destroy', currency.id))
                        .then(({data}) => {
                            console.log('unpinNextUserCurrencySubscription data::')
                            console.log(data)
                            loadUserCurrencySubscriptions()
                            Swal.fire(
                                'Your currency subscriptions ! ',
                                'You were unpinned from selected currency successfully !',
                                'success'
                            )
                        })
                        .catch(e => {
                            showRTE(e)
                            console.error(e)
                        })
                }
            })
        } // function unpinNextUserCurrencySubscription(currency) {


        function userProfileIndexOnMounted() {
            loadUserCurrencySubscriptions()
            // viewUserNotification('cbc17517-9046-4250-8976-03cbf7dc65bf') // DEBUGGIN
        } // function userProfileIndexOnMounted () {

        onMounted(userProfileIndexOnMounted)

        return { // setup return
            // Page state
            profileUser,
            profile_user_media_image_url,
            profileUserPermissions,


            // Page actions
            createdAtLabel,
            updatedAtLabel,
            goHome,
            loadUserCurrencySubscriptions,
            unpinNextUserCurrencySubscription,
            subscribeNextUserCurrencySubscription,
            userCurrencySubscriptions,

            // Settings vars
            settingsJsMomentDatetimeFormat,

            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            getHeaderIcon,
            getDictionaryLabel,
            showRTE,
        }
    }, // setup() {

}
</script>

