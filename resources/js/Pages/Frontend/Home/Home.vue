<template>

    <frontend-layout>

        <MainTopHeaderBlock></MainTopHeaderBlock>

        <TopCmsBlocks ></TopCmsBlocks>

        <OurAuthorsBlock></OurAuthorsBlock>

        <TopCurrenciesBlock :show_only_top_currencies="true"></TopCurrenciesBlock>


        <MainQuotesBlock></MainQuotesBlock>

        <MainContactUsBlock></MainContactUsBlock>


        </frontend-layout>


</template>

<script>
import FrontendLayout from '@/Layouts/FrontendLayout'
import axios from 'axios'
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import Multiselect from '@vueform/multiselect'
import TopCmsBlocks from '@/Pages/Frontend/Home/TopCmsBlocks.vue'
import TopCurrenciesBlock from '@/Pages/Frontend/Home/TopCurrenciesBlock.vue'
import OurAuthorsBlock from '@/Pages/Frontend/Home/OurAuthorsBlock.vue'
import MainTopHeaderBlock from '@/Pages/Frontend/Home/MainTopHeaderBlock.vue'
import MainContactUsBlock from '@/Pages/Frontend/Home/MainContactUsBlock.vue'
import MainQuotesBlock from '@/Pages/Frontend/Home/MainQuotesBlock.vue'

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
    name: 'HomePage',
    components: {
        FrontendLayout,
        Multiselect,
        VueFinalModal,
        TopCmsBlocks,
        TopCurrenciesBlock,
        OurAuthorsBlock,
        MainTopHeaderBlock,
        MainContactUsBlock,
        MainQuotesBlock,
        ModalsContainer
    },
    setup(props) {
        console.log('HOME props::')
        console.log(props)

        let activeCurrencyRows = ref([])
        let active_currencies_total_count = ref(0)
        let active_currencies_per_page = ref(20)
        let show_only_top_currencies =  ref(false)

        let show_filters_modal = ref(false)
        let order_by = ref('name')
        let order_direction = ref('asc')
        let filter_name = ref('')

        let orderBySelectionArray = ref([
            {id: 'id', name: 'Name'},
            {id: 'char_code', name: 'Char code'},
            {id: 'is_top', name: 'Is top'},
            {id: 'active', name: 'Active'},
            {id: 'ordering', name: 'Ordering'},
            {id: 'created_at', name: 'Created'}
        ])

        let orderDirectionSelectionArray = ref([
            {id: 'asc', name: 'Ascending'},
            {id: 'desc', name: 'Descending'},
        ])


        let currencies_per_page = ref(2)
        let current_page = ref(1)
        let currencies_filtered_count = ref(0)
        let currencyRows = ref([])

        function currenciesFilterApplied() { // TODO
            loadActiveCurrencies()
        }

        function loadActiveCurrencies() {
            console.log('-2 loadActiveCurrencies ::')
            // Route::post('current_rates/filter', [FrontendCurrencyController::class, 'filter'])->name('frontend.currencies_rates.filter');

            let filters = {page: current_page.value, show_only_top_currencies: show_only_top_currencies.value}
            axios.post(route('frontend.currencies_rates.filter'), filters)
                .then(({data}) => {
                    console.log('loadActiveCurrencies data::')
                    console.log(data)
                    // activeCurrencyRows.value = data.data
                    // active_currencies_total_count.value = data.meta.total
                    // active_currencies_per_page.value = data.meta.per_page
                })
                .catch(e => {
                    console.error(e)
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
                parent_component_key: 'currency',
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


        function HomeOnMounted() {
            window.emitter.on('listingHeaderRightButtonClickedEvent', params => {
                // console.log('TARGET listingHeaderRightButtonClickedEvent params::')
                // console.log(params)
                if (params.parent_component_key === 'currency') {
                    console.log('!!!!!loadActiveCurrencies::')
                    loadActiveCurrencies()
                }
            })
            window.emitter.on('paginationPageChangedEvent', params => {
                console.log('TARGET paginationPageChangedEvent params::')
                console.log(params)
                if (params.parent_component_key === 'currency') {
                    currencyRowsPaginationPageClicked(params.page)
                }
            })
            window.emitter.on('showFiltersModalEvent', params => {
                console.log('TARGET showFiltersModalEvent params::')
                console.log(params)
                if (params.parent_component_key === 'currency') {
                    showFiltersModal()
                }
            })
            loadActiveCurrencies()
            // showFiltersModal()// DEBUGGING
        } // function HomeOnMounted() {

        onMounted(HomeOnMounted)

        return { // setup return
            // Listing Page state
            current_page,
            activeCurrencyRows,
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
