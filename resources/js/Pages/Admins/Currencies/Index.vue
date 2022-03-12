<template>
    <div>
        <admin-layout>

            <vue-final-modal
                v-model="show_filters_modal"
                classes="admin_listing_modal_container"
                content-class="admin_listing_modal_content"
            >
                <h5 class="admin_listing_modal_header m-0 m-0">
                    <i :class="getHeaderIcon('filter')" class="mr-2"></i>Currencies Filter
                </h5>

                <div class="content admin_listing_modal_content_editor_form ">

                    <!--                    orderDirectionSelectionArray::{{ orderDirectionSelectionArray}}<br>-->
<!--                    currencies_filtered_count::{{ currencies_filtered_count }}<br>-->
<!--                    filter_name::{{ filter_name }}<br>-->
<!--                    order_by::{{ order_by }}<br>-->
<!--                    order_direction::{{ order_direction }}<br>-->
                    <div class="block_2columns_md p-2"> <!-- filter_name -->
                        <div class="horiz_divider_left_13">
                            <label for="filter_name">By name:</label>
                        </div>
                        <div class="horiz_divider_right_23">
                            <input type="text" class="form-control" id="filter_name"
                                   placeholder="By Currency Name" v-model="filter_name"
                                   autofocus="autofocus" autocomplete="off">
                        </div>
                    </div> <!-- class="block_2columns_md" filter_name -->

                    <div class="block_2columns_md p-2"> <!-- order_by -->
                        <div class="horiz_divider_left_13">
                            <label for="order_by">Order by:</label>
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
                                class="multiselect-admin-lte"
                            />
                        </div>
                    </div> <!-- class="block_2columns_md" order_by -->

                    <div class="block_2columns_md p-2"> <!-- order_direction -->
                        <div class="horiz_divider_left_13">
                            <label for="order_direction">Direction:</label>
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
                                class="multiselect-admin-lte"
                            />
                        </div>
                    </div> <!-- class="block_2columns_md" order_direction -->

                </div>
                <button class="admin_listing_modal_close m-0 mt-3 mr-2" @click="hideFiltersModal">
                    x
                </button>

                <div class="admin_listing_modal_footer">
                    <button type="button" class="btn btn-secondary btn-xs mt-1"
                            @click="hideFiltersModal">
                        <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-success btn-sm text-uppercase ml-4" @click="applyFilters">
                        <i :class="getHeaderIcon('save')" class="mr-1"></i>Apply
                    </button>
                    <button type="button" class="btn btn-sm btn_remove_right_aligned  mt-1" @click="clearFilters()" v-show="filter_name">
                        <i :class="getHeaderIcon('clear')" class="mr-1" title="Clear filters"></i>
                    </button>
                </div>

            </vue-final-modal>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
<!--                            currencies_filtered_count::{{ currencies_filtered_count}}<br>-->
                            <div class="card">
                                <div class="card-header">

                                    <ListingHeader :showLoadingImage=!is_page_loaded
                                                   :show_filters_button="true"
                                                   :parentComponentKey="'currency'"
                                                   :filtered_rows_count="currencies_filtered_count"
                                                   :page_rows_count="currencyRows.length"
                                                   :headerIcon="getHeaderIcon('currency')"
                                                   :headerTitle="'Currencies'"
                                                   :rightAddButtonLink="'admin.currencies.create'"
                                                   :itemTitle="pluralize(currencyRows.length, 'currency', 'currencies')"
                                                   :rightAddButtonLinkTitle="'New'"
                                                   :rightIcon="'currency'"
                                    >
                                    </ListingHeader>

                                </div>

                                <div class="card-body p-0" v-show="currencyRows.length == 0">
                                    <p class="text-sm text-warning p-2 pl-4">
                                        <i :class="getHeaderIcon('info')" class="mr-1"></i>
                                        No data found. Try to change filter options.
                                    </p>
                                </div>

                                <div class="card-body table-responsive p-0" v-show="currencyRows.length > 0">
                                    <table class="table table-striped table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th class="text-capitalize">Id</th>
                                            <th class="text-capitalize text-right"></th>
                                            <th class="text-capitalize">Name</th>
                                            <th class="text-capitalize">Char code</th>
                                            <th class="text-capitalize">Number Code</th>
                                            <th class="text-capitalize">Is top</th>
                                            <th class="text-capitalize">Active</th>
                                            <th class="text-capitalize">Ordering</th>
                                            <th class="text-capitalize">Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(currency, index) in currencyRows" :key="index">
                                            <td>{{ currency.id }}</td>
                                            <td class="text-right d-flex flex-nowrap">
                                                <inertia-link :href="route('admin.currencies.edit', currency)"
                                                              class="btn btn-info m-1 p-1  pb-0 pt-0"
                                                              :class="route().current('admin.currencies.*') ? 'active' : ' '">
                                                    <i :class="getHeaderIcon('edit')" class="mr-1" title="Edit"></i>
                                                </inertia-link>
                                            </td>

                                            <td>{{ currency.name }}</td>
                                            <td class="text-right">{{ currency.char_code }}</td>
                                            <td>{{ currency.num_code }}</td>
                                            <td>{{
                                                    getDictionaryLabel(currency.is_top, settingsCurrencyIsTopLabels)
                                                }}
                                            </td>
                                            <td>{{
                                                    getDictionaryLabel(currency.active, settingsCurrencyActiveLabels)
                                                }}
                                            </td>
                                            <td class="text-right">{{ currency.ordering }}</td>
                                            <td>{{
                                                    momentDatetime(currency.created_at, settingsJsMomentDatetimeFormat)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <ListingPagination
                                        parentComponentKey="currency"
                                        :currentPage="current_page"
                                        :filtered_rows_count="currencies_filtered_count"
                                        :page_rows_count="currencyRows.length"
                                        :itemsPerPage="currencies_per_page"
                                        :showNextPriorButtons=false
                                        :showPageNumberLabel="false"
                                        :showRowsLabel="false"
                                        :itemTitle="pluralize(currencies_filtered_count, 'currency', 'currencies')"
                                    >
                                    </ListingPagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </admin-layout>
    </div>
</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'
import axios from 'axios' // eslint-disable-line
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import Multiselect from '@vueform/multiselect'
import Pagination from '@/components/ListingPagination.vue'


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
import ListingHeader from '@/components/ListingHeader.vue'
import ListingPagination from '@/components/ListingPagination.vue'
// import app from '@/main.js'

export default {
    name: 'adminCurrenciesList',
    components: {
        AdminLayout,
        ListingHeader,
        ListingPagination,
        Multiselect,
        VueFinalModal,
        Pagination,
        ModalsContainer
    },
    setup() {

        const show_filters_modal = ref(false)
        const order_by = ref('name')
        const order_direction = ref('asc')
        const filter_name = ref('')

        const orderBySelectionArray = ref([
            {id: 'id', name: 'Name'},
            {id: 'char_code', name: 'Char code'},
            {id: 'is_top', name: 'Is top'},
            {id: 'active', name: 'Active'},
            {id: 'ordering', name: 'Ordering'},
            {id: 'created_at', name: 'Created'}
        ])

        const orderDirectionSelectionArray = ref([
            {id: 'asc', name: 'Ascending'},
            {id: 'desc', name: 'Descending'},
        ])


        let currencies_per_page = ref(2)
        const current_page = ref(1)
        let currencies_filtered_count = ref(0)
        let currencyRows = ref([])

        let is_page_loaded = ref(true)

        function currenciesFilterApplied() { // TODO
            loadCurrencies()
        }

        function loadCurrencies() {
            is_page_loaded.value = false
            //
            console.log('loadCurrencies::')
            // console.log(currentLoggedCurrencyToken)

            // let filterPublished = ''
            // forumPublishedLabels.map((nextForumPublishedLabel) => {
            //     if (nextForumPublishedLabel.label === filterSelectionPublished.value) {
            //         filterPublished = nextForumPublishedLabel.code
            //     }
            // })

            let filters = {
                page: current_page.value,
                order_by: order_by.value,
                order_direction: order_direction.value,
                filter_name: filter_name.value,
            }
            console.log('filters::')
            console.log(filters)
            axios.post(route('admin.currencies.filter'), filters)
                .then(({data}) => {
                    console.log('data::')
                    console.log(data)
                    currencyRows.value = data.data
                    currencies_filtered_count.value = data.meta.total
                    is_page_loaded.value = true
                    currencies_per_page.value = parseInt(data.meta.per_page)
                })
                .catch(error => {
                    console.error(error)
                    // showPopupMessage('Currencies Editor', error.response.data.message, 'warn')
                    // Toast.fire({
                    //     icon: 'error',
                    //     title: 'Getting currency error : ' + getErrorMessage(error)
                    // })
                    is_page_loaded.value = true
                })
        } // loadCurrencies() {

        function showFiltersModal() {
            console.log('showFiltersModal::')
            show_filters_modal.value = true
        }

        function hideFiltersModal() {
            console.log('hideFiltersModal::')
            show_filters_modal.value = false
        }

        function clearFilters() {
            filter_name.value = ''
            order_by.value = ''
            order_direction.value = ''
        }

        function applyFilters() {
            console.log('applyFilters::')
            current_page.value = 1
            loadCurrencies(true)

            show_filters_modal.value = false
            let filters_count_text = getFiltersCountText()
            let filters = {filter_name: filter_name}
            window.emitter.emit('listingFilterModifiedEvent', {
                parentComponentKey: 'currency',
                filters: filters,
                filters_count_text: filters_count_text
            })
        }

        function getFiltersCountText() {
            let ret = 0
            if (show_filters_modal.value) return ''
            if (filter_name.value != '') {
                ret++
            }
            // console.log('ret::')
            // console.log(ret)
            if (!ret) return ''
            return (ret > 0 ? ret + ' ' : '') + pluralize3(ret, ' no filters set', ' filter is set', ' filters are set')
        } // getFiltersCountText


        function currencyRowsPaginationPageClicked(page) {
            current_page.value = page
            loadCurrencies()
        }


        const adminCurrenciesListOnMounted = async () => {
            window.emitter.on('listingHeaderRightButtonClickedEvent', params => {
                console.log('TARGET listingHeaderRightButtonClickedEvent params::')
                console.log(params)
                if (params.parentComponentKey === 'currency') {
                    console.log('!!!!!loadCurrencies::')
                    loadCurrencies()
                }
            })
            window.emitter.on('paginationPageChangedEvent', params => {
                console.log('TARGET paginationPageChangedEvent params::')
                console.log(params)
                if (params.parentComponentKey === 'currency') {
                    currencyRowsPaginationPageClicked(params.page)
                }
            })
            window.emitter.on('showFiltersModalEvent', params => {
                console.log('TARGET showFiltersModalEvent params::')
                console.log(params)
                if (params.parentComponentKey === 'currency') {
                    showFiltersModal()
                }
            })
            loadCurrencies()
            // showFiltersModal()// DEBUGGING
        } // const adminCurrenciesListOnMounted = async () => {

        onMounted(adminCurrenciesListOnMounted)

        return { // setup return
            // Listing Page state
            current_page,
            currencies_per_page,
            currencyRows,
            currencies_filtered_count,

            // Page actions
            loadCurrencies,
            currencyRowsPaginationPageClicked,
            currenciesFilterApplied,

            // Settings vars
            settingsJsMomentDatetimeFormat,
            settingsCurrencyActiveLabels,
            settingsCurrencyIsTopLabels,

            // Listing filtering
            show_filters_modal,
            filter_name,
            order_by,
            order_direction,
            is_page_loaded,
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
        }
    }, // setup() {

}
</script>

