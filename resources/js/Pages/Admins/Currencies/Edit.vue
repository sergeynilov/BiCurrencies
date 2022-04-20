<template>
    <admin-layout>
        <vue-final-modal
            v-model="show_currency_history_filters_modal"
            classes="admin_listing_modal_container"
            content-class="admin_listing_modal_content"
        >
            <h5 class="admin_listing_modal_header m-0 m-0">
                <i :class="getHeaderIcon('filter')" class="action_icon icon_right_text_margin"></i>
                Currency history filter
            </h5>

            <div class="content admin_listing_modal_content_editor_form ">
                <div class="block_2columns_md p-2"> <!-- currency_history_filter_date_from -->
                    <div class="horiz_divider_left_13">
                        <label for="currency_history_filter_date_from">From:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <Datepicker
                            id="currency_history_filter_date_from"
                            v-model="currency_history_filter_date_from"
                            :minDate="currency_history_filter_date_from"
                            locale="en-US"
                            format="d MMMM, yyyy"
                        >
                            <template v-slot:belowDate>
                                <span></span>
                            </template>
                        </datepicker>
                    </div>
                </div> <!-- class="block_2columns_md" currency_history_filter_date_from -->

                <div class="block_2columns_md p-2"> <!-- currency_history_filter_date_till -->
                    <div class="horiz_divider_left_13">
                        <label for="currency_history_filter_date_till">Till:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <Datepicker
                            id="currency_history_filter_date_till"
                            v-model="currency_history_filter_date_till"
                            :maxDate="currency_history_filter_date_till"
                            locale="en-US"
                            format="d MMMM, yyyy"
                        >
                            <template v-slot:belowDate>
                                <span></span>
                            </template>
                        </datepicker>

                    </div>
                </div> <!-- class="block_2columns_md" currency_history_filter_date_till -->

            </div>
            <button class="admin_listing_modal_close m-0 mt-3 mr-2" @click="hideCurrencyHistoryFiltersModal">
                x
            </button>

            <div class="admin_listing_modal_footer">
                <button type="button" class="btn btn-secondary btn-sm"
                        @click="hideCurrencyHistoryFiltersModal">
                    <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
                </button>
                <button type="button" class="btn btn-success btn-sm text-uppercase right_btn_from_left_margin"
                        @click="applyCurrencyHistoryFilters">
                    <i :class="getHeaderIcon('save')" class="action_icon icon_right_text_margin"></i>Apply
                </button>
            </div>

        </vue-final-modal>


        <div class="card card-primary card-tabs">
            <div class="card-header p-2">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <!--                                                    active-->
                        <a class="nav-link active" id="currency-details-tab" data-toggle="pill"
                           href="#custom-tabs-one-home" role="tab"
                           aria-controls="custom-tabs-one-home" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item">
                        <!--                                            active-->
                        <a class="nav-link" id="currency-tab" data-toggle="pill"
                           href="#currency" role="tab"
                           aria-controls="currency"
                           aria-selected="false">Image</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="custom-tabs-one-description-tab"
                           data-toggle="pill"
                           href="#custom-tabs-one-description" role="tab"
                           aria-controls="custom-tabs-one-description"
                           aria-selected="false">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="currency-history-tab" data-toggle="pill"
                           href="#custom-tabs-one-profile" role="tab"
                           aria-controls="custom-tabs-one-profile"
                           aria-selected="false">History</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content h-100" id="custom-tabs-one-tabContent">
                    <!--                                                show active-->
                    <div class="tab-pane show active" id="custom-tabs-one-home" role="tabpanel"
                         aria-labelledby="currency-details-tab">
                        <currency-form-editor :is_insert="false"
                                              :currency="currency"></currency-form-editor>
                    </div>

                    <!--                                        show active-->
                    <div class="tab-pane fade" id="currency" role="tabpanel"
                         aria-labelledby="currency-tab">
                        <FileUploaderPreviewer
                            :imageUploader="currencyImageUploader"
                            :image_url="currency_image_url"
                            :image_info="currency_image_info"
                            :parent_component_key="'currency_editor'"
                            :layout="'admin'"

                        ></FileUploaderPreviewer>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-one-description" role="tabpanel"
                         aria-labelledby="custom-tabs-one-description-tab">

                        <quill-editor
                            :options="editorOptions"
                            theme="snow"
                            v-model:content="descriptionFormEditor.description"
                            contentType="html"

                        >{{ descriptionFormEditor.description }}
                        </quill-editor>
                        <div class="invalid-feedback mb-3" v-if="descriptionFormEditor.errors"
                             :class="{ 'd-block' : descriptionFormEditor.errors && descriptionFormEditor.errors.description}">
                        </div>

                        <div class="admin_listing_modal_footer">
                            <button type="button"
                                    class="btn btn-success btn-sm text-uppercase right_btn_from_left_margin"
                                    @click="saveDescriptionFormEditor">
                                <i :class="getHeaderIcon('save')"
                                   class="action_icon icon_right_text_margin"></i>Save
                            </button>
                        </div>
                    </div>

                    <!--                                        fade show active -->
                    <div class="tab-pane fade" id="custom-tabs-one-profile"
                         role="tabpanel" aria-labelledby="currency-history-tab">
                        <ListingHeader
                            :show_filters_button="true"
                            :parent_component_key="'currencies_history'"
                            :filtered_rows_count="currencies_history_filtered_count"
                            :page_rows_count="currencyHistoryRows.length"
                            :left_header_icon="getHeaderIcon('currencies_history')"
                            :headerTitle="'History'"
                            :rightAddButtonLink="''"
                            :itemTitle="pluralize(currencyHistoryRows.length, 'histories', 'histories')"
                            :rightAddButtonLinkTitle="''"
                            :right_icon="''"
                        >
                        </ListingHeader>

                        <div class="card-body p-0" v-show="currencyHistoryRows.length == 0">
                            <p class="text-sm text-warning p-2 pl-4">
                                <i :class="getHeaderIcon('info')"
                                   class="action_icon icon_right_text_margin"></i>
                                No data found. Try to change filter options.
                            </p>
                        </div>

                        <div class="card-body table-responsive p-0"
                             v-show="currencyHistoryRows.length > 0">

                            <table class="table table-striped table-hover text-nowrap">
                                <thead>
                                <tr class="admin_listing_header">
                                    <th class="text-capitalize">Id</th>
                                    <th class="text-capitalize text-right"></th>
                                    <th class="text-capitalize">Day</th>
                                    <th class="text-capitalize">Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(currencyHistory, index) in currencyHistoryRows"
                                    :key="index" class="admin_listing_tr">
                                    <td>{{ currencyHistory.id }}</td>
                                    <td class="text-right d-flex flex-nowrap">
                                        <button class="btn btn-danger p-0 px-1  m-0  ml-1 "
                                                @click="deleteCurrencyHistory(currencyHistory)">
                                            <i :class="getHeaderIcon('remove')"
                                               class="action_icon icon_right_text_margin"
                                               title="Delete"></i>
                                        </button>
                                    </td>
                                    <td>{{ currencyHistory.day_label }}</td>
                                    <td>{{ formatValue(currencyHistory.value, rate_decimal_numbers) }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix" v-if="currencyHistoryRows.length > 0">
                            <paginate
                                v-show="currencies_history_pages_count > 1"
                                v-model="currencies_history_current_page"
                                :page-count="currencies_history_pages_count"
                                :click-handler="currencyHistoryPaginationPageClicked"
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

                </div>
            </div>

            <!-- /.card -->

        </div>

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'


import {
    getHeaderIcon,
    pluralize,
    pluralize3,
    isEmpty,
    formatValue,
    momentDatetime,
    getErrorMessage,
    showFlashMessage,
    getDictionaryLabel,
    dateIntoDbFormat,
    getFileSizeAsString,
} from '@/commonFuncs'
import {settingsJsMomentDatetimeFormat, settingsAppColors} from '@/app.settings.js'

import CurrencyFormEditor from '@/Pages/Admins/Currencies/Form'
import {onMounted, ref, watchEffect} from "vue";
import axios from "axios";
import ListingHeader from '@/components/ListingHeader.vue'
import FileUploaderPreviewer from '@/components/FileUploaderPreviewer.vue'


// Vue.component('QuillEditor', VueQuill.QuillEditor);
import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import QuillBetterTable from 'quill-better-table' // https://github.com/soccerloway/quill-better-table

import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

import {ModalsContainer, VueFinalModal} from "vue-final-modal";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from '@inertiajs/inertia'

export default {

    props: {
        currency: {
            type: Object,
            required: true,
        },
        minCurrencyHistoryDay: {
            type: String,
            required: false,
        },
        currencyImage: {
            type: Object,
            required: true,
        }
    },

    name: 'adminCurrenciesEdit',
    components: {
        AdminLayout,
        ListingHeader,
        FileUploaderPreviewer,
        Datepicker,
        VueFinalModal,
        ModalsContainer,
        // CKEditor,
        CurrencyFormEditor,
        QuillEditor,
    },
    setup(props) {
        let currency_history_filter_date_from = ref( props.minCurrencyHistoryDay)

        var d = new Date();
        let show_currency_history_filters_modal = ref(false)
        var today_date = dateIntoDbFormat(d)
        let currency_history_filter_date_till = ref(today_date)
        if (isEmpty(currency_history_filter_date_from.value)) {
            currency_history_filter_date_from.value = today_date
        }
        let currency = ref(props.currency)
        let currencyHistoryRows = ref([])
        let rate_decimal_numbers = ref(2)
        let currencies_history_filtered_count = ref(0)
        let currencies_history_pages_count = ref(0)
        let currencies_history_per_page = ref(0)
        let currencies_history_current_page = ref(1)

        let currency_image_url = ref(props.currencyImage.url)
        let currency_image_info = ref(props.currencyImage.file_name + ', ' + getFileSizeAsString(props.currencyImage.size) + ', ' + props.currencyImage.width + '*' + props.currencyImage.height)
        let currencyImageUploader = ref(useForm({
            image: '',
            currency_id: props.currency.id,
            image_filename: '',
        }))

        let descriptionFormEditor = ref(useForm({
            id: props.currency.id,
            description: props.currency.description,
        }))

        let editorOptions = ref(
            [['better-table', 'bold', 'italic'], ['link', 'image']]
        )

        function saveDescriptionFormEditor() {
            descriptionFormEditor.value.put(route('admin.currencies.description_save', descriptionFormEditor.value.id), {
                preserveScroll: false,
                onSuccess: (resp) => {
                    Swal.fire(
                        'Saved!',
                        'Description successfully saved !',
                        'success'
                    )
                },
                onError: (e) => {
                    console.log(e)
                    Toast.fire({
                        icon: 'error',
                        title: 'Description saving error!'
                    })
                }
            })
        }

        function fetchCurrencyImage(currencyImageFile) {
            fetch(currencyImageFile.blob).then(function (response) {
                if (response.ok) {
                    return response.blob().then(function (imageBlob) {
                        currencyImageUploader.value.image = imageBlob
                        currencyImageUploader.value.image_filename = currencyImageFile.name

                        currencyImageUploader.value.post(route('admin.currencies.upload_image'), {
                            preserveScroll: true,
                            onSuccess: (resp) => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'You have uploaded image successfully'
                                })
                                window.emitter.emit('imageBlobFetchedEvent', {
                                    parent_component_key: 'currency_editor',
                                    resp: resp,
                                })
                                Inertia.visit(route('admin.currencies.edit', currencyImageUploader.value.currency_id), {only: ['currencyImage'],})
                                // loadCurrencyImage()
                            },
                            onError: (e) => {
                                console.log(e)
                            }
                        })
                    })
                } else {
                    return response.json().then(function (jsonError) {
                        console.error(jsonError)
                    })
                }
            }).catch(function (e) {
                console.error(e)
            }) // fetch(currencyImageFile.blob).then(function (response) {

        }


        function loadCurrencyHistory() {
            if (!isEmpty(currency_history_filter_date_from.value) && typeof currency_history_filter_date_from.value.getMonth === 'function') {
                currency_history_filter_date_from.value = dateIntoDbFormat(currency_history_filter_date_from.value)
                // console.log('CHANGED currency_history_filter_date_from.value::')
                // console.log(currency_history_filter_date_from.value)
            }
            if (!isEmpty(currency_history_filter_date_till.value) && typeof currency_history_filter_date_till.value.getMonth === 'function') {
                currency_history_filter_date_till.value = dateIntoDbFormat(currency_history_filter_date_till.value)
                // console.log('CHANGED currency_history_filter_date_till.value::')
                // console.log(currency_history_filter_date_till.value)
            }

            let url = route('admin.currency_histories.index', [currency.value.id, currencies_history_current_page.value, currency_history_filter_date_from.value, currency_history_filter_date_till.value])
            axios.get(url)
                .then(({data}) => {
                    // console.log('loadCurrencyHistory data::')
                    // console.log(data)
                    currencyHistoryRows.value = data.data
                    currencies_history_filtered_count.value = data.meta.total
                    currencies_history_per_page.value = parseInt(data.meta.per_page)
                    currencies_history_pages_count.value = data.meta.last_page
                })
                .catch(e => {
                    console.error(e)
                })
        } // loadCurrencyHistory() {


        function deleteCurrencyHistory(currencyHistory) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to delete this currency history!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // console.log('deleteCurrencyHistory currencyHistory::')
                    // console.log(currencyHistory)
                    axios.delete(route('admin.currency_histories.destroy', currencyHistory.id))
                        .then(({data}) => {
                            loadCurrencyHistory()
                            Swal.fire(
                                'Deleted!',
                                'Currency history has been deleted.',
                                'success'
                            )
                        })
                        .catch(e => {
                            console.error(e)
                        })
                }
            })
        } // function deleteCurrencyHistory(currencyHistory) {


        function currencyHistoryPaginationPageClicked(page) {
            currencies_history_current_page.value = page
            loadCurrencyHistory()
        }

        function showCurrencyHistoryFiltersModal() {
            show_currency_history_filters_modal.value = true
        }

        function hideCurrencyHistoryFiltersModal() {
            show_currency_history_filters_modal.value = false
        }

        function applyCurrencyHistoryFilters() {
            currencies_history_current_page.value = 1
            loadCurrencyHistory(true)

            show_currency_history_filters_modal.value = false
            let filters_count_text = getCurrencyHistoryFiltersCountText()
            let filters = {filter_name: 'filter_name'}
            window.emitter.emit('listingFilterModifiedEvent', {
                parent_component_key: 'currencies_history',
                filters: filters,
                filters_count_text: filters_count_text
            })
        }

        function getCurrencyHistoryFiltersCountText() {
            let ret = 0
            if (show_currency_history_filters_modal.value) return ''
            if (currency_history_filter_date_from.value != '') {
                ret++
            }
            if (currency_history_filter_date_till.value != '') {
                ret++
            }
            if (!ret) return ''
            return (ret > 0 ? ret + ' ' : '') + pluralize3(ret, ' no filters set', ' filter is set', ' filters are set')
        } // getCurrencyHistoryFiltersCountText


        function adminCurrencyEditOnMounted() {
            showFlashMessage()
            axios.get(route('get_settings_value', {key: 'rate_decimal_numbers'}))
                .then(({data}) => {
                    rate_decimal_numbers.value = data.value
                })
                .catch(e => {
                    console.error(e)
                })

            loadCurrencyHistory()
            window.emitter.on('FileUploaderPreviewerUploadImageEvent', params => {
                if (params.parent_component_key === 'currency_editor') {
                    fetchCurrencyImage(params.uploadedImageFile)
                }
            })

            window.emitter.on('showFiltersModalEvent', params => {
                if (params.parent_component_key === 'currencies_history') {
                    showCurrencyHistoryFiltersModal()
                }
            })

            window.emitter.on('listingHeaderRightButtonClickedEvent', params => {
                if (params.parent_component_key === 'currencies_history') {
                    loadCurrencyHistory()
                }
            })

        }
        onMounted(adminCurrencyEditOnMounted)

        return { // setup return

            // Listing Page state
            currency,
            currency_image_url,
            currency_image_info,
            currencyHistoryRows,
            currencies_history_filtered_count,
            currencies_history_pages_count,
            currencies_history_per_page,
            currencies_history_current_page,
            descriptionFormEditor,
            saveDescriptionFormEditor,
            editorOptions,

            // Listing filtering
            show_currency_history_filters_modal,
            hideCurrencyHistoryFiltersModal,
            applyCurrencyHistoryFilters,

            // Currency History listing
            currency_history_filter_date_from,
            currency_history_filter_date_till,

            // format,
            currencyHistoryPaginationPageClicked,
            deleteCurrencyHistory,
            currencyImageUploader,

            // Common methods
            rate_decimal_numbers,
            getHeaderIcon,
            pluralize,
            pluralize3,
            isEmpty,
            momentDatetime,
            getErrorMessage,
            showFlashMessage,
            getDictionaryLabel,
            dateIntoDbFormat,
            formatValue,
            getFileSizeAsString
        }
    }, // setup() {

}
</script>
