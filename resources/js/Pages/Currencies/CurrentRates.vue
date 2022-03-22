<template>
    <div>
        <frontend-layout>


            activeCurrencyRows.length::{{ activeCurrencyRows.length}}
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


<!--
{ "id": 5, "name": "Danish krone", "num_code": "208", "char_code": "DKK", "bgcolor": "#DC3545", "color": "#ffffff", "is_top": 0, "active": 1, "ordering": 14, "currency_histories_count": 13, "created_at": "2022-03-06 14:55:34", "created_at_formatted": "6 March, 2022 2:55:34 PM", "updated_at": null, "updated_at_formatted": "" }
-->


                            <div class="card" v-show="activeCurrencyRows.length > 0">
                                <div class="card-header">
                                    <h3 class="card-title">Current currencies rate</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-12"  v-for="(activeCurrency, index) in activeCurrencyRows" :key="index">
                                        activeCurrency.color::{{ activeCurrency.color }}<br>
                                        activeCurrency.bgcolor::{{ activeCurrency.bgcolor }}<br>
                                        <div class="info-box shadow-none">
<!--                                            bg-info-->
                                            <span class="info-box-icon " :style="'color:'+activeCurrency.color +'; background-color:'+activeCurrency.bgcolor "><i class="far fa-envelope"></i></span>
<!--
                                            <div :style="'border: 0px dotted green; width:'+ ( innerWidth - editorIndent) + 'px; outline-style: outset; outline-color:#eaeaea;' ">
                                                <wysiwyg v-model="selection_users_assigned_to_task_action_memo"/>
                                            </div>

                                            -->
                                            <div class="info-box-content">
                                                <span class="info-box-text">{{ activeCurrency.name }}</span>
                                                <span class="info-box-number">{{ activeCurrency.currency_histories_count }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
<!--                                    &lt;!&ndash; /.col &ndash;&gt;-->
<!--                                    <div class="col-md-3 col-sm-6 col-12">-->
<!--                                        <div class="info-box shadow-sm">-->
<!--                                            <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>-->

<!--                                            <div class="info-box-content">-->
<!--                                                <span class="info-box-text">Shadows</span>-->
<!--                                                <span class="info-box-number">Small</span>-->
<!--                                            </div>-->
<!--                                            &lt;!&ndash; /.info-box-content &ndash;&gt;-->
<!--                                        </div>-->
<!--                                        &lt;!&ndash; /.info-box &ndash;&gt;-->
<!--                                    </div>-->
<!--                                    &lt;!&ndash; /.col &ndash;&gt;-->
<!--                                    <div class="col-md-3 col-sm-6 col-12">-->
<!--                                        <div class="info-box shadow">-->
<!--                                            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>-->

<!--                                            <div class="info-box-content">-->
<!--                                                <span class="info-box-text">Shadows</span>-->
<!--                                                <span class="info-box-number">Regular</span>-->
<!--                                            </div>-->
<!--                                            &lt;!&ndash; /.info-box-content &ndash;&gt;-->
<!--                                        </div>-->
<!--                                        &lt;!&ndash; /.info-box &ndash;&gt;-->
<!--                                    </div>-->
<!--                                    &lt;!&ndash; /.col &ndash;&gt;-->
<!--                                    <div class="col-md-3 col-sm-6 col-12">-->
<!--                                        <div class="info-box shadow-lg">-->
<!--                                            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>-->

<!--                                            <div class="info-box-content">-->
<!--                                                <span class="info-box-text">Shadows</span>-->
<!--                                                <span class="info-box-number">Large</span>-->
<!--                                            </div>-->
<!--                                            &lt;!&ndash; /.info-box-content &ndash;&gt;-->
<!--                                        </div>-->
<!--                                        &lt;!&ndash; /.info-box &ndash;&gt;-->
<!--                                    </div>-->
<!--                                    &lt;!&ndash; /.col &ndash;&gt;-->
                                </div>


                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="card-body p-0" v-show="activeCurrencyRows.length == 0">
                                        <p class="text-sm text-warning p-2 pl-4">
                                            <i :class="getHeaderIcon('info')"></i>
                                            No data found. Try to change filter options.
                                        </p>
                                    </div>


                                    <div class="card-body table-responsive p-0" v-show="activeCurrencyRows.length > 0">
                                        <table class="table table-striped table-hover text-nowrap">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Name(Char code)</th>
                                                <th>Rate</th>
                                                <th style="width: 40px">Label</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(currency, index) in activeCurrencyRows" :key="index">
                                                <td>{{ currency.id }}</td>
                                                <td>{{ currency.name }} ({{ currency.char_code }})</td>
                                                <td>
                                                    {{ currency }}
                                                    <!--                                                {{ formatLatestCurrencyHistoryValue(currency.latest_currency_history.value, 4) }}-->
                                                </td>

                                                <!--                                            [currency_histories_count] => 13-->
                                                <!--                                            [latest_currency_history] => Array-->
                                                <!--                                            (-->
                                                <!--                                            [id] => 398-->
                                                <!--                                            [day] => 2021-03-08-->
                                                <!--                                            [currency_id] => 2-->
                                                <!--                                            [nominal] => 1-->
                                                <!--                                            [value] => 6.1144459103-->
                                                <!--                                            [created_at] => 2021-03-08 15:50:53-->
                                                <!--                                            <td>-->
                                                <!--                                                <div class="progress progress-xs">-->
                                                <!--                                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>-->
                                                <!--                                                </div>-->
                                                <!--                                            </td>-->
                                                <!--                                            <td><span class="badge bg-danger">55%</span></td>-->
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                        </div>
                    </div>
                </div>
            </section>


        </frontend-layout>
    </div>
</template>


<script>
import FrontendLayout from '@/Layouts/FrontendLayout'
import axios from 'axios' // eslint-disable-line
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import Multiselect from '@vueform/multiselect'
import Pagination from '@/components/ListingPagination.vue'

import {
    getHeaderIcon,
    pluralize,
    pluralize3,
    momentDatetime,
    getErrorMessage,
    getDictionaryLabel,
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels
} from '@/app.settings.js'

// file:///mnt/_work_sdb8/wwwroot/lar/BiCurrencies/resources/js/Components/ListingHeader.vue
// import app from '@/main.js'

export default {
    name: 'currentRatesList',
    components: {
        FrontendLayout,
        // ListingHeader,
        // ListingPagination,
        Multiselect,
        VueFinalModal,
        Pagination,
        ModalsContainer
    },
    setup() {
        const activeCurrencyRows = ref([])
        const paginationLinks = ref([])
        const active_currencies_total_count = ref(0)
        const active_currencies_per_page = ref(20)
        const show_only_top_currencies =  ref(false)

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
            loadActiveCurrencies()
        }

        function loadActiveCurrencies() {
            console.log('-20 loadActiveCurrencies ::')
            // Route::post('current_rates/filter', [FrontendCurrencyController::class, 'filter'])->name('frontend.currencies_rates.filter');

            let filters = {page: current_page.value, show_only_top_currencies: show_only_top_currencies.value}
            axios.post(route('frontend.currencies_rates.filter'), filters)
                .then(({data}) => {
                    console.log('-20 loadActiveCurrencies data::')
                    console.log(data)
                    activeCurrencyRows.value = data.data
                    paginationLinks.value = data.meta.links
                    active_currencies_total_count.value = data.meta.total
                    active_currencies_per_page.value = data.meta.per_page
                })
                .catch(error => {
                    console.error(error)
                    // this.showPopupMessage('Currencies Editor', error.response.data.message, 'warn')
                })
        } // loadActiveCurrencies() {

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
            loadActiveCurrencies(true)

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
            loadActiveCurrencies()
        }


        const currentRatesListOnMounted = async () => {
            window.emitter.on('listingHeaderRightButtonClickedEvent', params => {
                console.log('TARGET listingHeaderRightButtonClickedEvent params::')
                console.log(params)
                if (params.parentComponentKey === 'currency') {
                    console.log('!!!!!loadActiveCurrencies::')
                    loadActiveCurrencies()
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
            loadActiveCurrencies()
            // showFiltersModal()// DEBUGGING
        } // const currentRatesListOnMounted = async () => {

        onMounted(currentRatesListOnMounted)

        return { // setup return
            // Listing Page state
            current_page,
            activeCurrencyRows,
            paginationLinks,
            active_currencies_total_count,
            active_currencies_per_page,

            // Page actions
            loadActiveCurrencies,
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
