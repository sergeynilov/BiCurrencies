<template>
    <i class="fal fa-bells"></i>

    <user-layout>

        <vue-final-modal
            v-model="show_user_notifications_filters_modal"
            classes="user_listing_modal_container"
            content-class="user_listing_modal_content"
        >
            <h5 class="user_listing_modal_header m-0 m-0">
                <i :class="getHeaderIcon('filter')" class="icon_right_text_margin"></i>Notification data
            </h5>

            <div class="content user_listing_modal_content_editor_form ">

                <div class="block_2columns_md p-2"> <!-- id -->
                    <div class="horiz_divider_left_13">
                        <label>Id:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        {{ notificationForView.id }}
                    </div>
                </div> <!-- class="block_2columns_md" id -->


                <div class="block_2columns_md p-2"> <!-- notifiable_type -->
                    <div class="horiz_divider_left_13">
                        <label>Notifiable type:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        {{ notificationForView.notifiable_type }}
                    </div>
                </div> <!-- class="block_2columns_md" notifiable_type -->


                <div class="block_2columns_md p-2"> <!-- notification_to_user -->
                    <div class="horiz_divider_left_13">
                        <label>Notification to user:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <!--                        {{ notificationUserForView.id}}=>-->
                        {{ notificationUserForView.name }}
                    </div>
                </div> <!-- class="block_2columns_md" notification_to_user -->


                <div class="block_2columns_md p-2"> <!-- data -->
                    <div class="horiz_divider_left_13">
                        <label>Data:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <div class="pre-formatted" v-html="notificationForView.data"></div>
                        <!--                        <p>-->
                        <!--                            lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut-->
                        <!--                        </p>-->
                        <!--                        <p>-->
                        <!--                            lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut-->
                        <!--                        </p>-->
                    </div>
                </div> <!-- class="block_2columns_md" data -->

                <div class="block_2columns_md p-2" v-if="notificationForView.read_at_formatted">
                    <!-- read_at_formatted -->
                    <div class="horiz_divider_left_13">
                        <label>Read at:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        {{ notificationForView.read_at_formatted }}
                    </div>
                </div> <!-- class="block_2columns_md" read_at_formatted -->

                <div class="block_2columns_md p-2"> <!-- created_at_formatted -->
                    <div class="horiz_divider_left_13">
                        <label>Created at:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        {{ notificationForView.created_at_formatted }}
                    </div>
                </div> <!-- class="block_2columns_md" created_at_formatted -->

            </div>


            <button class="user_listing_modal_close m-0 mt-3 mr-2" @click="hideUserNotificationFiltersModal">
                x
            </button>

            <div class="user_listing_modal_footer">
                <button type="button" class="btn btn-secondary btn-sm"
                        @click="hideUserNotificationFiltersModal">
                    <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
                </button>
            </div>

        </vue-final-modal>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                settingsFilterOnlyUnreadNotificationsLabels::{{
                                    settingsFilterOnlyUnreadNotificationsLabels
                                }}<br>
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
                                            class="admin_multiselect_lte admin_editable_input"
                                        />
                                    </div>
                                </div> <!-- class="block_2columns_md" filter_only_unread_notifications -->

                            </div>

                            <div class="card-body p-0" v-show="notificationRows.length == 0">
                                <p class="text-sm text-warning p-2 pl-4">
                                    <i :class="getHeaderIcon('info')" class="icon_right_text_margin"></i>
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
                                            <button type="button" class="btn btn-primary btn-sm text-uppercase right_btn_from_left_margin"
                                                    @click="markAsReadUserNotification(notification.id)">
                                                <i :class="getHeaderIcon('unmark')" class="action_icon icon_right_text_margin"
                                                   title="Mark as read notification "></i>markAsRead
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm text-uppercase right_btn_from_left_margin"
                                                    @click="destroyUserNotification(notification.id)">
                                                <i :class="getHeaderIcon('unmark')" class="action_icon icon_right_text_margin"
                                                   title="Delete notification "></i>delete
                                            </button>

                                            <button type="button" class="btn btn-info btn-sm text-uppercase right_btn_from_left_margin"
                                                    @click="viewUserNotification(notification.id)">
                                                <i :class="getHeaderIcon('unmark')" class="mr-1"
                                                   title="View notification details "></i>action_icon icon_right_text_margin
                                            </button>
                                        </td>

                                        <td>{{ notification.type }}</td>
                                        <td class="text-right">{{ notification.data }}</td>

                                        <td>{{
                                                momentDatetime(notification.read_at, settingsJsMomentDatetimeFormat)
                                            }}
                                        </td>
                                        <td>{{
                                                momentDatetime(notification.created_at, settingsJsMomentDatetimeFormat)
                                            }}
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ListingPagination
                                    parent_component_key="notification"
                                    :current_page="current_page"
                                    :filtered_rows_count="0"
                                    :page_rows_count="notificationRows.length"
                                    :items_per_page="notifications_per_page"
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
import axios from 'axios'
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
// import app from '@/main.js'

export default {
    name: 'userNotificationsList',
    components: {
        UserLayout,
        ListingHeader,
        Pagination,
        Multiselect,
        VueFinalModal,
        ModalsContainer,
    },
    setup() {

        let notifications_per_page = ref(2)
        let current_page = ref(1)
        let notifications_filtered_count = ref(0)
        let notificationRows = ref([])
        let notificationForView = ref([])
        let notificationUserForView = ref([])

        let filter_only_unread_notifications = ref(1)
        let show_user_notifications_filters_modal = ref(false)

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
                .catch(e => {
                    console.error(e)
                })
        } // loadNotifications() {


        function notificationRowsPaginationPageClicked(page) {
            console.log('notificationRowsPaginationPageClicked page::')
            console.log(page)

            current_page.value = page
            loadNotifications()
        }


        function markAsReadUserNotification(id) {
            console.log('markAsReadUserNotification id::')
            console.log(id)

            Swal.fire({
                title: 'Are you sure?',
                text: "You what to mark this notification as read!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, mark!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(route('user.notifications.update', id), {'action': 'unmark'})
                        .then(({data}) => {
                            console.log('markAsReadUserNotification data::')
                            console.log(data)
                            loadNotifications()
                        })
                        .catch(e => {
                            console.error(e)
                        })
                }
            })
        } // function markAsReadUserNotification(id) {

        function destroyUserNotification(id) {
            console.log('destroyUserNotification id::')
            console.log(id)

            Swal.fire({
                title: 'Are you sure?',
                text: "You what to delete this notification !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(route('user.notifications.destroy', id))
                        .then(({data}) => {
                            console.log('loadNotifications data::')
                            console.log(data)
                            loadNotifications()
                        })
                        .catch(e => {
                            console.error(e)
                        })
                }
            })
        }

        function viewUserNotification(id) {
            // console.log('viewUserNotification id::')
            // console.log(id)
            axios.get(route('user.notifications.show', id))
                .then(({data}) => {
                    // console.log('viewUserNotification data::')
                    // console.log(data)
                    // console.log('viewUserNotification data.notification::')
                    // console.log(data.notification)
                    notificationForView.value = data.notification
                    notificationUserForView.value = data.notificationUser
                    show_user_notifications_filters_modal.value = true
                })
                .catch(e => {
                    console.error(e)
                })
        }

        function hideUserNotificationFiltersModal() {
            console.log('hideUserNotificationFiltersModal::')
            show_user_notifications_filters_modal.value = false
        }

        function applyUserNotificationFilters() {
            console.log('applyUserNotificationFilters  current_page.value ::')
            console.log(current_page.value)
            current_page.value = 1
        }


        function userNotificationsListOnMounted() {
            window.emitter.on('listingHeaderRightButtonClickedEvent', params => {
                // console.log('TARGET listingHeaderRightButtonClickedEvent params::')
                // console.log(params)
                if (params.parent_component_key === 'notification') {
                    console.log('!!!!!loadNotifications::')
                    loadNotifications()
                }
            })
            window.emitter.on('paginationPageChangedEvent', params => {
                console.log('TARGET paginationPageChangedEvent params::')
                console.log(params)
                if (params.parent_component_key === 'notification') {
                    notificationRowsPaginationPageClicked(params.page)
                }
            })
            loadNotifications()
            // viewUserNotification('cbc17517-9046-4250-8976-03cbf7dc65bf') // DEBUGGIN
        }

        onMounted(userNotificationsListOnMounted)

        return { // setup return
            // Listing Page state
            current_page,
            notifications_per_page,
            notificationRows,
            notificationForView,
            notificationUserForView,
            notifications_filtered_count,

            // Listing filtering
            show_user_notifications_filters_modal,
            filter_only_unread_notifications,
            filterOnlyUnreadNotificationsChanged,

            // Page actions
            loadNotifications,
            notificationRowsPaginationPageClicked,
            markAsReadUserNotification,
            destroyUserNotification,
            viewUserNotification,
            hideUserNotificationFiltersModal,

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

<style>


.user_listing_modal_container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.user_listing_modal_header {
    background-color: #e9ead8;
    color: $ user_text_color;
    /*border-bottom: 2px solid rgba(123,123,123);*/
    border-bottom: 1px solid dimgrey;
    /*padding: 0;*/
    padding: 0.5rem 0.5rem;
    margin: 0;
    position: relative;
    /*border-top-left-radius: 0.5rem;*/
    /*border-top-right-radius: 0.5rem;*/
}

.user_listing_modal_footer {
    border-top: 1px solid dimgrey;
    padding: 0.8rem;
    background-color: #e9ead8;
}

.user_listing_modal_content {
    position: relative;
    width: 90%;

    margin-left: 4px;
    /*min-height: 360px;*/
    /*max-height: 360px;*/
    height: 620px;

    padding: 0;
    /*overflow: auto;*/
    /*background-color: red !important;*/
    background-color: #fff !important;
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

    background: rgba(0, 0, 0, .1);

}

/* Medium ≥768px  ipad or ipad mini */
@media only screen and (min-width: 768px) and (max-width: 991px) {

    /* Ipad Pro md */
    .user_listing_modal_content {
        min-height: 500px;
        /*background-color: yellow !important;*/
    }
}

.user_listing_modal_close {
    background-color: #E9EAD8;
    color: $ user_text_color !important;
    position: absolute;
    top: -4px;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 24px;
    height: 24px;
    /*margin: 4px 4px 0 0;*/
    cursor: pointer;
    border: none;
}

.user_listing_modal_close::hover {
    color: $ user_text_color !important;
    background-color: #fff;
}


.user_listing_modal_content_editor_form {
    height: 620px;
    overflow-x: scroll;
    overflow-y: auto;
    white-space: nowrap;

    margin-top: 0.7rem;
    flex: 1; /* same as flex: 1 1 auto; */
    background-color: #fff;

}

</style>
