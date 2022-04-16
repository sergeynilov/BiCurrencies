<template>
    <admin-layout>

        <vue-final-modal
            v-model="show_filters_modal"
            classes="admin_listing_modal_container"
            content-class="admin_listing_modal_content"
        >
            <h5 class="admin_listing_modal_header m-0 m-0">
                <i :class="getHeaderIcon('filter')" class="action_icon icon_right_text_margin"></i>CMS Items Filter
            </h5>

            <div class="content admin_listing_modal_content_editor_form ">

                <!--                    orderDirectionSelectionArray::{{ orderDirectionSelectionArray}}<br>-->
                <!--                    cms_items_filtered_count::{{ cms_items_filtered_count }}<br>-->
                <!--                    filter_title::{{ filter_title }}<br>-->
                <!--                    order_by::{{ order_by }}<br>-->
                <!--                    order_direction::{{ order_direction }}<br>-->
                <div class="block_2columns_md p-2"> <!-- filter_title -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="filter_title" value="By Name:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="filter_title" type="text" class="form-control admin_editable_input"
                                   v-model="filter_title" placeholder="By CMS Item title"
                                   autocomplete="off"/>
                    </div>
                </div> <!-- class="block_2columns_md" filter_title -->

                <div class="block_2columns_md p-2"> <!-- order_by -->
                    <div class="horiz_divider_left_13">
                        <label class="admin_editable_label" for="order_by">Order by:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <Multiselect
                            v-model="order_by"
                            id="order_by"
                            mode="single"
                            :options="orderBySelectionArray"
                            valueProp="id"
                            :searchable="false"
                            :max="-1"
                            ref="multiselect"
                            label="name"
                            track-by="name"
                            placeholder="Select order by"
                            class="admin_multiselect_lte admin_editable_input"
                        />
                    </div>
                </div> <!-- class="block_2columns_md" order_by -->

                <div class="block_2columns_md p-2"> <!-- order_direction -->
                    <div class="horiz_divider_left_13">
                        <label class="admin_editable_label" for="order_direction">Direction:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <Multiselect
                            v-model="order_direction"
                            id="order_direction"
                            mode="single"
                            :options="orderDirectionSelectionArray"
                            valueProp="id"
                            :searchable="false"
                            :max="-1"
                            ref="multiselect"
                            label="name"
                            track-by="name"
                            placeholder="Select order direction"
                            class="admin_multiselect_lte admin_editable_input"
                        />
                    </div>
                </div> <!-- class="block_2columns_md" order_direction -->

            </div>
            <button class="admin_listing_modal_close m-0 mt-3 mr-2" @click="hideFiltersModal">
                x
            </button>

            <div class="admin_listing_modal_footer">
                <button type="button" class="btn btn-secondary"
                        @click="hideFiltersModal">
                    <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
                </button>
                <button type="button" class="btn btn-success btn-sm text-uppercase right_btn_from_left_margin"
                        @click="applyFilters">
                    <i :class="getHeaderIcon('save')" class="action_icon icon_right_text_margin"></i>Apply
                </button>
                <button type="button" class="btn btn-sm btn_remove_right_aligned  mt-1" @click="clearFilters()"
                        v-show="filter_title">
                    <i :class="getHeaderIcon('clear')" class="action_icon icon_right_text_margin"
                       title="Clear filters"></i>
                </button>
            </div>
        </vue-final-modal>

        <div class="card">
            <div class="card-header">

                <ListingHeader
                    :show_filters_button="true"
                    :parent_component_key="'cms_item'"
                    :filtered_rows_count="cms_items_filtered_count"
                    :page_rows_count="CMSItemRows.length"
                    :left_header_icon="getHeaderIcon('cms_item')"
                    :headerTitle="'CMS Items'"
                    :rightAddButtonLink="'admin.cms_items.create'"
                    :itemTitle="pluralize(CMSItemRows.length, 'cms item', 'cms items')"
                    :rightAddButtonLinkTitle="'New'"
                    :right_icon="'cms_item'"
                >
                </ListingHeader>

            </div>

            <div class="card-body p-0" v-if="CMSItemRows.length == 0">
                <p class="text-sm text-warning p-2 pl-4">
                    <i :class="getHeaderIcon('info')" class="icon_right_text_margin"></i>
                    No data found. Try to change filter options.
                </p>
            </div>

            <div class="card-body table-responsive p-0" v-if="CMSItemRows.length > 0">
                <table class="table table-striped table-hover text-nowrap">
                    <thead>
                    <tr class="admin_listing_header">
                        <th class="text-capitalize">Id</th>
                        <th class="text-capitalize text-right"></th>
                        <th class="text-capitalize">Title</th>
                        <th class="text-capitalize">Key</th>
                        <th class="text-capitalize">Author</th>
                        <th class="text-capitalize">Published</th>
                        <th class="text-capitalize">Created</th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr v-for="(nextCMSItem, index) in CMSItemRows" :key="index" class="admin_listing_tr">
                        <td>{{ nextCMSItem.id }}</td>
                        <td class="text-right d-flex flex-nowrap">
                            <inertia-link :href="route('admin.cms_items.edit', nextCMSItem)"
                                          class="btn btn-info m-1 p-1  pb-0 pt-0"
                                          :class="route().current('admin.cms_items.*') ? 'published' : ' '">
                                <i :class="getHeaderIcon('edit')" class="action_icon icon_right_text_margin"
                                   title="Edit"></i>
                            </inertia-link>
                        </td>

                        <td>{{ nextCMSItem.title }}</td>
                        <td>{{ nextCMSItem.key }}</td>
                        <td>
                            {{ nextCMSItem.author.name }}
                        </td>
                        <td>{{ getDictionaryLabel(nextCMSItem.published, settingsCMSItemPublishedLabels) }}
                        </td>
                        <td>
                            {{ momentDatetime(nextCMSItem.created_at, settingsJsMomentDatetimeFormat) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <paginate
                    v-show="cms_items_pages_count > 1"
                    v-model="current_page"
                    :page-count="cms_items_pages_count"
                    :click-handler="paginateClick"
                    :first-last-button="false"
                    :page-range="2"
                    :margin-pages="3"
                    :prev-text="'<'"
                    :next-text="'>'"
                    :container-class="'admin_pagination'"
                >
                </paginate>

            </div>
        </div>

    </admin-layout>
</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'
import axios from 'axios'
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import Multiselect from '@vueform/multiselect'

import {
    getHeaderIcon,
    getErrorMessage,
    pluralize,
    pluralize3,
    momentDatetime,
    getDictionaryLabel,
    showFlashMessage,
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'

import {
    settingsJsMomentDatetimeFormat, settingsCMSItemPublishedLabels
} from '@/app.settings.js'

import ListingHeader from '@/components/ListingHeader.vue'

export default {
    name: 'adminCMSItemsList',
    components: {
        AdminLayout,
        ListingHeader,
        Multiselect,
        VueFinalModal,
        ModalsContainer,
        // JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetLabel,
    },
    setup() {

        let show_filters_modal = ref(false)
        let order_by = ref('title')
        let order_direction = ref('asc')
        let filter_title = ref('')

        let orderBySelectionArray = ref([
            {id: 'title', name: 'Title'},
            {id: 'key', name: 'Key'},
            {id: 'published', name: 'Published'},
            {id: 'created_at', name: 'Created'}
        ])

        let orderDirectionSelectionArray = ref([
            {id: 'asc', name: 'Ascending'},
            {id: 'desc', name: 'Descending'},
        ])


        let cms_items_per_page = ref(2)
        let current_page = ref(1)
        let cms_items_filtered_count = ref(0)
        let cms_items_pages_count = ref(0)
        let CMSItemRows = ref([])

        function cms_itemsFilterApplied() { // TODO
            loadCMSItems()
        }

        function loadCMSItems() {
            console.log('loadCMSItems::')

            let filters = {
                page: current_page.value,
                order_by: order_by.value,
                order_direction: order_direction.value,
                filter_title: filter_title.value,
            }
            console.log('filters::')
            console.log(filters)
            axios.post(route('admin.cms_items.filter'), filters)
                .then(({data}) => {
                    console.log('loadCMSItems data::')
                    console.log(data)
                    CMSItemRows.value = data.data
                    cms_items_filtered_count.value = data.meta.total
                    cms_items_pages_count.value = data.meta.last_page
                    cms_items_per_page.value = parseInt(data.meta.per_page)
                })
                .catch(e => {
                    console.error(e)
                })
        } // loadCMSItems() {

        function paginateClick(page) {
            // console.log('paginateClick page::')
            // console.log(page)
            current_page.value = page
            loadCMSItems()
        }

        function showFiltersModal() {
            console.log('showFiltersModal::')
            show_filters_modal.value = true
        }

        function hideFiltersModal() {
            console.log('hideFiltersModal::')
            show_filters_modal.value = false
        }

        function clearFilters() {
            filter_title.value = ''
            order_by.value = ''
            order_direction.value = ''
        }

        function applyFilters() {
            console.log('applyFilters::')
            current_page.value = 1
            loadCMSItems(true)

            show_filters_modal.value = false
            let filters_count_text = getFiltersCountText()
            console.log('filters_count_text::')
            console.log(filters_count_text)

            let filters = {filter_title: filter_title}
            window.emitter.emit('listingFilterModifiedEvent', {
                parent_component_key: 'cms_item',
                filters: filters,
                filters_count_text: filters_count_text
            })
        }

        function getFiltersCountText() {
            let ret = 0
            if (show_filters_modal.value) return ''
            if (filter_title.value != '') {
                ret++
            }
            console.log('getFiltersCountText ret::')
            console.log(ret)
            if (!ret) return ''
            return (ret > 0 ? ret + ' ' : '') + pluralize3(ret, ' no filters set', ' filter is set', ' filters are set')
        } // getFiltersCountText


        function updateHandler(p1, p2) {
            console.log('updateHandler p1::')
            console.log(p1)
            console.log('updateHandler p2::')
            console.log(p2)

        }

        function CMSItemRowsPaginationPageClicked(page) {
            current_page.value = page
            loadCMSItems()
        }


        function adminCMSItemsListOnMounted() {
            showFlashMessage()
            window.emitter.on('listingHeaderRightButtonClickedEvent', params => {
                // console.log('TARGET listingHeaderRightButtonClickedEvent params::')
                // console.log(params)
                if (params.parent_component_key === 'cms_item') {
                    console.log('!!!!!loadCMSItems::')
                    loadCMSItems()
                }
            })
            window.emitter.on('paginationPageChangedEvent', params => {
                console.log('TARGET paginationPageChangedEvent params::')
                console.log(params)
                if (params.parent_component_key === 'cms_item') {
                    CMSItemRowsPaginationPageClicked(params.page)
                }
            })
            window.emitter.on('showFiltersModalEvent', params => {
                console.log('TARGET showFiltersModalEvent params::')
                console.log(params)
                if (params.parent_component_key === 'cms_item') {
                    showFiltersModal()
                }
            })
            loadCMSItems()
            // showFiltersModal()// DEBUGGING
        } // function adminCMSItemsListOnMounted() {

        onMounted(adminCMSItemsListOnMounted)

        return { // setup return
            // Listing Page state
            current_page,
            cms_items_per_page,
            CMSItemRows,
            cms_items_filtered_count,
            cms_items_pages_count,

            // Page actions
            loadCMSItems,
            CMSItemRowsPaginationPageClicked,
            cms_itemsFilterApplied,
            // updateHandler,
            paginateClick,

            // Settings vars
            settingsJsMomentDatetimeFormat,
            settingsCMSItemPublishedLabels,

            // Listing filtering
            show_filters_modal,
            filter_title,
            order_by,
            order_direction,
            orderBySelectionArray,
            orderDirectionSelectionArray,
            clearFilters,
            showFiltersModal,
            hideFiltersModal,
            applyFilters,

            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            getHeaderIcon,
            getDictionaryLabel,
            showFlashMessage,

        }
    }, // setup() {

}
</script>

