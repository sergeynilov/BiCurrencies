<template>
    <i class="fal fa-bells"></i>

    <user-layout>

        <vue-final-modal
            v-model="show_user_notifications_filters_modal"
            classes="admin_listing_modal_container"
            content-class="admin_listing_modal_content"
        >
            <h5 class="admin_listing_modal_header m-0 m-0">
                <i :class="getHeaderIcon('filter')" class="mr-2"></i>Notification data
            </h5>

            <div class="content admin_listing_modal_content_editor_form ">
                <div class="block_2columns_md p-2">
                    <div class="horiz_divider_left_13">
                        <label for="">From:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        ?????
                    </div>
                </div>
            </div>
            <button class="admin_listing_modal_close m-0 mt-3 mr-2" @click="hideUserNotificationFiltersModal">
                x
            </button>

            <div class="admin_listing_modal_footer">
                <button type="button" class="btn btn-secondary btn-xs mt-1"
                        @click="hideUserNotificationFiltersModal">
                    <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-success btn-sm text-uppercase ml-4"
                        @click="applyUserNotificationFilters">
                    <i :class="getHeaderIcon('save')" class="mr-1"></i>Apply
                </button>
            </div>

        </vue-final-modal>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                settingsFilterOnlyUnreadNotificationsLabels::{{ settingsFilterOnlyUnreadNotificationsLabels }}<br>
                                filter_only_unread_notifications::{{ filter_only_unread_notifications }}<br>

                                <div class="block_2columns_md p-2"> <!-- filter_only_unread_notifications -->
                                    <div class="horiz_divider_left_13">
                                        <label for="filter_only_unread_notifications">By unread:</label>
                                    </div>
                                    <div class="horiz_divider_right_23">
<!--                                        { code: 0, label: 'Show all notifications' },-->

                                        <Multiselect
                                            v-model="filter_only_unread_notifications"
                                            id="filter_only_unread_notifications"
                                            mode="single"
                                            @change="filterOnlyUnreadNotificationsChanged"
                                            :options="settingsFilterOnlyUnreadNotificationsLabels"
                                            valueProp="code"
                                            :searchable="true"
                                            :max="-1"
                                            ref="multiselect"
                                            label="label"
                                            track-by="label"
                                            class="multiselect-admin-lte"
                                        />
                                    </div>
                                </div> <!-- class="block_2columns_md" filter_only_unread_notifications -->

                            </div>

                            <div class="card-body p-0" v-show="notificationRows.length == 0">
                                <p class="text-sm text-warning p-2 pl-4">
                                    <i :class="getHeaderIcon('info')" class="mr-1"></i>
                                    You have no notifications now.
                                </p>
                            </div>

                            <div class="card-body table-responsive p-0" v-show="notificationRows.length > 0">
                                <table class="table table-striped table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-capitalize">Id</th>
                                        <th class="text-capitalize text-right"></th>
                                        <th class="text-capitalize">Type</th>
                                        <th class="text-capitalize">Data</th>


                                        <th class="text-capitalize">Read at</th>
                                        <th class="text-capitalize">Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(notification, index) in notificationRows" :key="index">
                                        <td>{{ notification.id }}</td>
                                        <td class="text-right d-flex flex-nowrap">


                                            <button type="button" class="btn btn-danger btn-sm text-uppercase ml-4" @click="destroyUserNotification(notification.id)">
                                                <i :class="getHeaderIcon('unmark')" class="mr-1" title="Unmark notification "></i>detele
                                            </button>



                                            <!--                                                <inertia-link :href="route('user.notifications.edit', notification)"-->
                                        <!--                                                              class="btn btn-info m-1 p-1  pb-0 pt-0"-->
                                        <!--                                                              :class="route().current('user.notifications.*') ? 'active' : ' '">-->
                                        <!--                                                    <i :class="getHeaderIcon('edit')" class="mr-1" title="Edit"></i>-->
                                        <!--                                                </inertia-link>-->
                                                                                    </td>

                                        <td>{{ notification.type }}</td>
                                        <td class="text-right">{{ notification.data }}</td>

                                        <td>{{ momentDatetime( notification.read_at, settingsJsMomentDatetimeFormat) }}</td>
                                        <td>{{ momentDatetime(notification.created_at, settingsJsMomentDatetimeFormat) }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ListingPagination
                                    parentComponentKey="notification"
                                    :currentPage="current_page"
                                    :filtered_rows_count="0"
                                    :page_rows_count="notificationRows.length"
                                    :itemsPerPage="notifications_per_page"
                                    :showNextPriorButtons=false
                                    :showPageNumberLabel="false"
                                    :showRowsLabel="false"
                                    :itemTitle="pluralize(notifications_filtered_count, 'notification', 'notifications')"
                                >
                                </ListingPagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </user-layout>

</template>


<script>
import UserLayout from '@/Layouts/UserLayout'
import axios from 'axios' // eslint-disable-line
import Pagination from '@/components/ListingPagination.vue'
import Multiselect from '@vueform/multiselect'
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

import {settingsJsMomentDatetimeFormat, settingsFilterOnlyUnreadNotificationsLabels} from '@/app.settings.js'

// file:///mnt/_work_sdb8/wwwroot/lar/BiNotifications/resources/js/Components/ListingHeader.vue
import ListingHeader from '@/components/ListingHeader.vue'
import ListingPagination from '@/components/ListingPagination.vue'
// import app from '@/main.js'

export default {
    name: 'userNotificationsList',
    components: {
        UserLayout,
        ListingHeader,
        ListingPagination,
        Pagination,
        Multiselect,
        VueFinalModal,
        ModalsContainer,
    },
    setup() {

        let notifications_per_page = ref(2)
        const current_page = ref(1)
        let notifications_filtered_count = ref(0)
        let notificationRows = ref([])

        const filter_only_unread_notifications = ref(1)
        const show_user_notifications_filters_modal = ref(false)

        function filterOnlyUnreadNotificationsChanged() {
            console.log('filter_only_unread_notifications.value ::')
            console.log(filter_only_unread_notifications.value)
            loadNotifications()

        }
        function loadNotifications() {
            console.log('loadNotifications filter_only_unread_notifications.value::')
            console.log(filter_only_unread_notifications.value)

            let filters = {
                page: current_page.value,
                filter_only_unread_notifications: filter_only_unread_notifications.value,
            }
            console.log('filters::')
            console.log(filters)
            axios.post(route('user.notifications.filter'), filters)
                .then(({data}) => {
                    console.log('loadNotifications data::')
                    console.log(data)
                    notificationRows.value = data.data
                    notifications_filtered_count.value = data.meta.total
                    notifications_per_page.value = parseInt(data.meta.per_page)
                })
                .catch(error => {
                    console.error(error)
                })
        } // loadNotifications() {


        function notificationRowsPaginationPageClicked(page) {
            console.log('notificationRowsPaginationPageClicked page::')
            console.log(page)

            current_page.value = page
            loadNotifications()
        }


        function destroyUserNotification(id) {
            console.log('destroyUserNotification id::')
            console.log(id)
            axios.get(route('user.notifications.show/' + id))
                .then(({data}) => {
                    console.log('loadNotifications data::')
                    console.log(data)
                    notificationRows.value = data.data
                    notifications_filtered_count.value = data.meta.total
                    notifications_per_page.value = parseInt(data.meta.per_page)
                })
                .catch(error => {
                    console.error(error)
                })

            //     Route::resource('notifications', UserNotificationsController::class);
            show_user_notifications_filters_modal.value = true
        }

        function hideUserNotificationFiltersModal() {
            console.log('hideUserNotificationFiltersModal::')
            show_user_notifications_filters_modal.value = false
        }

        function applyUserNotificationFilters() {
            console.log('applyUserNotificationFilters  current_page.value ::')
            console.log(current_page.value)
            current_page.value = 1
            // loadNotification(true)

/*
            show_user_notifications_filters_modal.value = false
            let filters_count_text = getUserNotificationFiltersCountText()
            let filters = {
                page: current_page.value,
                filter_only_unread_notifications: 'filter_only_unread_notifications'
            }
            window.emitter.emit('listingFilterModifiedEvent', {
                parentComponentKey: 'currencies_history',
                filters: filters,
                filters_count_text: filters_count_text
            })
*/
        }


        const userNotificationsListOnMounted = async () => {
            window.emitter.on('listingHeaderRightButtonClickedEvent', params => {
                console.log('TARGET listingHeaderRightButtonClickedEvent params::')
                console.log(params)
                if (params.parentComponentKey === 'notification') {
                    console.log('!!!!!loadNotifications::')
                    loadNotifications()
                }
            })
            window.emitter.on('paginationPageChangedEvent', params => {
                console.log('TARGET paginationPageChangedEvent params::')
                console.log(params)
                if (params.parentComponentKey === 'notification') {
                    notificationRowsPaginationPageClicked(params.page)
                }
            })
            loadNotifications()
        } // const userNotificationsListOnMounted = async () => {

        onMounted(userNotificationsListOnMounted)

        return { // setup return
            // Listing Page state
            current_page,
            notifications_per_page,
            notificationRows,
            notifications_filtered_count,

            // Listing filtering
            show_user_notifications_filters_modal,
            filter_only_unread_notifications,
            filterOnlyUnreadNotificationsChanged,
            destroyUserNotification,

            // Page actions
            loadNotifications,
            notificationRowsPaginationPageClicked,

            // Settings vars
            settingsJsMomentDatetimeFormat,
            settingsFilterOnlyUnreadNotificationsLabels,

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
