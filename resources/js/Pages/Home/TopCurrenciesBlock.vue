<template>

    <section class="pt-4" id="team">

        <!--        rate_decimal_numbers::{{ rate_decimal_numbers }}-->
        <!--        activeCurrencyRows::{{ activeCurrencyRows}}-->

        <!--        { "id": 3, "name": "Icelandic króna", "num_code": "352", "char_code": "ISK", "bgcolor": "#DC3545", "color": "#ffffff", "is_top": 0, "active": 1, "ordering": 11, "currency_histories_count": 370, "media_image_url": "http://local-bi-currencies.com/storage/currency_app/3/icelandic-krona.png", "created_at": "2022-03-13 08:11:23", "created_at_formatted": "13 March, 2022 8:11:23 AM", "updated_at": null, "updated_at_formatted": "" },-->
        <!--        -->
        <div class="container">
            show_currency_history_modal::{{ show_currency_history_modal }}<br>

            <div class="row justify-content-center mb-6">
                <div class="col-lg-6 col-xxl-5 text-center mx-auto mb-7">
                    <h5 class="fw-bold fs-3 fs-lg-5 fs-xxl-7 lh-sm mb-3">Our leadership</h5>
                    <p class="mb-0">Meet our Organization leaders and experts. Our leadership team drives our company
                        and leads our people.</p>
                </div>
                <div class="col-xxl-11">
                    <div class="row flex-center gx-3">

                        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0 text-center shadow p-2"
                             v-for="(nextActiveCurrencyRow, index) in activeCurrencyRows" :key="index">
                            <img class="w-100" :src="nextActiveCurrencyRow.media_image_url" alt="..."
                                 :style="'color:'+nextActiveCurrencyRow.color +'; background-color:'+nextActiveCurrencyRow.bgcolor "/>

                            <div class="row flex-center p-0 m-0 "
                                 :style="'color:'+nextActiveCurrencyRow.color +'; background-color:'+nextActiveCurrencyRow.bgcolor">
                                <div class="col-md-10 order-0">
                                    <div class="p-1 m-0 text-start">
                                        <h5 class="fw-bold mt-4 mb-1"
                                            :style="'color:'+nextActiveCurrencyRow.color +'; background-color:'+nextActiveCurrencyRow.bgcolor ">
                                            <i :class="getHeaderIcon('info')" class="mr-1"
                                               :title="'Open article about '+nextActiveCurrencyRow.name+' currency'"></i>
                                            {{ nextActiveCurrencyRow.name }}=>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-md-2 order-1" v-if="nextActiveCurrencyRow.currency_histories_count > 0">
                                    <p class=" p-1 m-0 text-end">
                                        <i :class="getHeaderIcon('currencies_history')" class="mr-1"
                                           @click.prevent="showCurrencyHistoryModal(nextActiveCurrencyRow.id, nextActiveCurrencyRow.name)"
                                           :title="'Open currency history : '+nextActiveCurrencyRow.currency_histories_count + ' item(s)'"></i>
                                    </p>
                                </div>
                            </div>

                            <div class="row flex-center p-0 m-0 "
                                 :style="'color:'+nextActiveCurrencyRow.color +'; background-color:'+nextActiveCurrencyRow.bgcolor">
                                <div class="col-md-6 order-0">
                                    <div class="p-1 m-0 text-start">
                                        {{ nextActiveCurrencyRow.char_code }}
                                    </div>
                                </div>
                                <div class="col-md-6 order-1">
                                    <p class=" p-1 m-0 text-end">
                                       <span v-if="nextActiveCurrencyRow.latest_currency_history"
                                             class="align-content-end text-end">
                                            {{
                                               formatValue(nextActiveCurrencyRow.latest_currency_history.value, rate_decimal_numbers)
                                           }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->

    <vue-final-modal
        v-model="show_currency_history_modal"
        classes="contact_us_modal_container"
        content-class="contact_us_modal_content"
    >
        <div class="row flex-center contact_us_modal_header">
            <div class="col-md-6 order-0">
                <div class="p-1 m-0 text-start">
                    <h5>
                        <i :class="getHeaderIcon('currencies_history')" class="m-1 p-0 "
                           style="margin-bottom: -2px !important; "></i> Currency history
                    </h5>
                </div>
            </div>
            <div class="col-md-6 order-1">
                <p class=" p-1 m-0 text-end">
                    <button class="contact_us_modal_close p-0" @click="hideCurrencyHistoryModal">
                        x
                    </button>
                </p>
            </div>
        </div>

        <div class="content contact_us_modal_content_editor_form p-0 m-0">
            <div class="block_2columns_md p-2"> <!-- modal_contact_us_title -->
                <div class="horiz_divider_left_13">
                    <label for="modal_contact_us_title">Title:</label>
                </div>
                <div class="horiz_divider_right_23">
                    ????
                </div>
            </div> <!-- class="block_2columns_md" modal_contact_us_title -->
        </div>

        <div class="contact_us_modal_footer">
            <button type="button" class="btn btn-secondary btn-xs m-1 p-1"
                    @click="hideCurrencyHistoryModal">
                <i :class="getHeaderIcon('cancel')" class="m-0"></i>Cancel
            </button>
        </div>

    </vue-final-modal>

</template>


<script>
import FrontendLayout from '@/Layouts/FrontendLayout'
import axios from 'axios' // eslint-disable-line
import Multiselect from '@vueform/multiselect'
import Pagination from '@/components/ListingPagination.vue'
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'

import {
    getHeaderIcon,
    pluralize,
    pluralize3,
    momentDatetime,
    getErrorMessage,
    getDictionaryLabel,
    formatValue
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels
} from '@/app.settings.js'

// file:///mnt/_work_sdb8/wwwroot/lar/BiCurrencies/resources/js/Components/ListingHeader.vue
// import app from '@/main.js'

export default {
    name: 'TopCurrenciesBlockPage',
    components: {
        FrontendLayout,
        // ListingHeader,
        // ListingPagination,
        Multiselect,
        Pagination,
        VueFinalModal,
        ModalsContainer
    },
    setup(props) {
        console.log('props::')
        console.log(props)

        // const rate_decimal_numbers = ref(props.rate_decimal_numbers)
        const show_currency_history_modal = ref(false)
        const rate_decimal_numbers = ref(4)
        const activeCurrencyRows = ref([])
        const paginationLinks = ref([])
        const active_currencies_total_count = ref(0)
        const active_currencies_per_page = ref(20)
        const show_only_top_currencies = ref(false)


        let currencies_per_page = ref(2)
        const current_page = ref(1)
        let currencies_filtered_count = ref(0)
        let currencyRows = ref([])

        let is_page_loaded = ref(true)


        function showCurrencyHistoryModal(currency_id, currency_name) {
            console.log('currency_id::')
            console.log(currency_id)
            // Route::get('currency_history/{id}', [FrontendCurrencyController::class, 'get_currency_history'])->name('frontend.get_currency_history');

            axios.get(route('frontend.get_currency_history', currency_id))
                .then(({data}) => {
                    console.log('showCurrencyHistoryModal data::')
                    console.log(data)
                    // if (!isEmpty(data.image)) {
                    //     currency_image_url.value = data.image.url
                    //     currency_image_info.value = data.image.file_name + ', ' + getFileSizeAsString(data.image.size) + ', ' + data.image.width + '*' + data.image.height
                    // }
                    show_currency_history_modal.value = true
                })
                .catch(error => {
                    console.error(error)
                })
        }

        function hideCurrencyHistoryModal() {
            show_currency_history_modal.value = false
        }

        function loadActiveCurrencies() {
            console.log('-2 loadActiveCurrencies ::')
            // Route::post('current_rates/filter', [FrontendCurrencyController::class, 'filter'])->name('frontend.currencies_rates.filter');

            let filters = {page: current_page.value, show_only_top_currencies: show_only_top_currencies.value}
            axios.post(route('frontend.currencies_rates.filter'), filters)
                .then(({data}) => {
                    console.log('loadActiveCurrencies data::')
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
            loadActiveCurrencies()
        } // const currentRatesListOnMounted = async () => {

        onMounted(currentRatesListOnMounted)

        return { // setup return
            // Listing Page state
            current_page,
            activeCurrencyRows,
            paginationLinks,
            active_currencies_total_count,
            active_currencies_per_page,

            // Currency History Modal State
            showCurrencyHistoryModal,
            hideCurrencyHistoryModal,
            show_currency_history_modal,


            // Page actions
            loadActiveCurrencies,
            currencyRowsPaginationPageClicked,

            // Settings vars
            rate_decimal_numbers,
            settingsJsMomentDatetimeFormat,
            settingsCurrencyActiveLabels,
            settingsCurrencyIsTopLabels,

            // Listing filtering
            is_page_loaded,

            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            getHeaderIcon,
            getDictionaryLabel,
            formatValue
        }
    }, // setup() {

}
</script>
