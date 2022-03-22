<template>
    <admin-layout>
        <vue-final-modal
            v-model="show_currency_history_filters_modal"
            classes="admin_listing_modal_container"
            content-class="admin_listing_modal_content"
        >
            <h5 class="admin_listing_modal_header m-0 m-0">
                <i :class="getHeaderIcon('filter')" class="mr-2"></i>Currency history filter
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
                <button type="button" class="btn btn-secondary btn-xs mt-1"
                        @click="hideCurrencyHistoryFiltersModal">
                    <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-success btn-sm text-uppercase ml-4"
                        @click="applyCurrencyHistoryFilters">
                    <i :class="getHeaderIcon('save')" class="mr-1"></i>Apply
                </button>
            </div>

        </vue-final-modal>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                            <div class="card card-primary card-tabs">
                                <div class="card-header p-2">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item">
                                            <!--                                                    active-->
                                            <a class="nav-link " id="currency-details-tab" data-toggle="pill"
                                               href="#custom-tabs-one-home" role="tab"
                                               aria-controls="custom-tabs-one-home" aria-selected="true">Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="currency-history-tab" data-toggle="pill"
                                               href="#custom-tabs-one-profile" role="tab"
                                               aria-controls="custom-tabs-one-profile"
                                               aria-selected="false">History</a>
                                        </li>
                                        <li class="nav-item">
                                            <!--                                            active-->
                                            <a class="nav-link" id="currency-tab" data-toggle="pill"
                                               href="#currency" role="tab"
                                               aria-controls="currency"
                                               aria-selected="false">Image</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill"
                                               href="#custom-tabs-one-settings" role="tab"
                                               aria-controls="custom-tabs-one-settings"
                                               aria-selected="false">Settings</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <!--                                                show active-->
                                        <div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel"
                                             aria-labelledby="currency-details-tab">

<!--                                            editor::{{ editor }} <br>-->
<!--                                            editorData::{{ editorData }} <br>-->
<!--                                            editorConfig::{{ editorConfig }} <br>-->
<!--                                            <ckeditor-->
<!--                                                :editor="editor"-->
<!--                                                v-model="editorData"-->
<!--                                                      :config="editorConfig"-->
<!--                                            ></ckeditor>-->


                                            <form-editor :is_insert="false" :currency="currency"></form-editor>
                                        </div>

                                        <!--                                        fade show active -->
                                        <div class="tab-pane show active" id="custom-tabs-one-profile"
                                             role="tabpanel" aria-labelledby="currency-history-tab">

                                            currencies_history_filtered_count::{{ currencies_history_filtered_count }}
                                            <ListingHeader :showLoadingImage="false"
                                                           :show_filters_button="true"
                                                           :parentComponentKey="'currencies_history'"
                                                           :filtered_rows_count="currencies_history_filtered_count"
                                                           :page_rows_count="currencyHistoryRows.length"
                                                           :headerIcon="getHeaderIcon('currencies_history')"
                                                           :headerTitle="'History'"
                                                           :rightAddButtonLink="''"
                                                           :itemTitle="pluralize(currencyHistoryRows.length, 'histories', 'histories')"
                                                           :rightAddButtonLinkTitle="''"
                                                           :rightIcon="''"
                                            >
                                            </ListingHeader>

                                            <div class="card-body p-0" v-show="currencyHistoryRows.length == 0">
                                                <p class="text-sm text-warning p-2 pl-4">
                                                    <i :class="getHeaderIcon('info')" class="mr-1"></i>
                                                    No data found. Try to change filter options.
                                                </p>
                                            </div>

                                            <div class="card-body table-responsive p-0"
                                                 v-show="currencyHistoryRows.length > 0">

                                                <table class="table table-striped table-hover text-nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-capitalize">Id</th>
                                                        <th class="text-capitalize text-right"></th>
                                                        <th class="text-capitalize">Day</th>
                                                        <th class="text-capitalize">Value</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(currencyHistory, index) in currencyHistoryRows"
                                                        :key="index">
                                                        <td>{{ currencyHistory.id }}</td>
                                                        <td class="text-right d-flex flex-nowrap">
                                                            <button class="btn btn-danger p-0 px-1  m-0  ml-1 "
                                                                    @click="deleteCurrencyHistory(currencyHistory)">
                                                                <i :class="getHeaderIcon('remove')" class="mr-1"
                                                                   title="Delete"></i>
                                                            </button>
                                                        </td>
                                                        <td>{{ currencyHistory.day_label }}</td>
                                                        <td>{{ currencyHistory.value }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="card-footer clearfix" v-if="currencyHistoryRows.length > 0">
                                                ListingPagination::currencies_history_filtered_count::{{ currencies_history_filtered_count }}
                                                <ListingPagination
                                                    parentComponentKey="currency_history"
                                                    :currentPage="currencies_history_current_page"
                                                    :filtered_rows_count="currencies_history_filtered_count"
                                                    :page_rows_count="currencyHistoryRows.length"
                                                    :itemsPerPage="currencies_history_per_page"
                                                    :showNextPriorButtons=false
                                                    :showPageNumberLabel="false"
                                                    :showRowsLabel="false"
                                                    :itemTitle="pluralize(currencyHistoryRows.length, 'history', 'histories')"
                                                >
                                                </ListingPagination>
                                            </div>

                                        </div>
                                        <!--                                        show active-->

                                        <div class="tab-pane fade" id="currency" role="tabpanel"
                                             aria-labelledby="currency-tab">
                                            <file-upload
                                                ref="upload"
                                                v-model="imageFiles"
                                                post-action="/post.method"
                                                put-action="/put.method"
                                                @input-file="inputFile"
                                                @input-filter="inputFilter"
                                                class="btn btn-outline-primary btn-block"
                                                v-show="imageFiles.length === 0"
                                            >
                                                <i :class="getHeaderIcon('upload')" class="mr-1"></i>
                                                Upload file
                                            </file-upload>

                                            <div v-show="currency_image_url && imageFiles.length === 0" class="p-2">
                                                <img :src="currency_image_url" class="admin_img_preview_wrapper ">
                                                <p class="text-sm text-info p-2" v-show="currency_image_info">
                                                    <i :class="getHeaderIcon('info')"></i>
                                                    {{ currency_image_info }}
                                                </p>
                                            </div>

                                            <div v-show="imageFiles.length > 0" class="p-2">
                                                <table class="m-2 p-0">
                                                    <tr v-for="nextFile in imageFiles" :key="nextFile.name">
                                                        <img :src="nextFile.blob"
                                                             class="admin_img_preview_wrapper"
                                                             id="uploaded_image_file"/>
                                                        <div class="row_content_centered p-3">
                                                            <div class="p-2">
                                                                Name : <strong>{{ nextFile.name }}</strong>
                                                            </div>
                                                            <div class="p-2">
                                                                Size : <strong>{{
                                                                    getFileSizeAsString(nextFile.size)
                                                                }}</strong>
                                                            </div>

                                                            <div v-show="uploaded_image_width" class="p-2">
                                                                Width : <strong>{{
                                                                    uploaded_image_width
                                                                }}px</strong>
                                                            </div>

                                                            <div v-show="uploaded_image_height" class="p-2">
                                                                Height : <strong>{{
                                                                    uploaded_image_height
                                                                }}</strong>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="row_content_right_aligned" v-show="imageFiles.length">
                                                <button type="reset" class="btn btn-secondary btn-xs mt-1"
                                                        @click.prevent="cancelCurrencyImageUpload()">
                                                    <i :class="'i_link '+getHeaderIcon('cancel')"></i>Cancel
                                                </button>
                                                <button type="button"
                                                        class="btn btn-success btn-sm text-uppercase ml-4"
                                                        @click.prevent="uploadCancelCurrencyImage()">
                                                    <i :class="'i_link '+getHeaderIcon('save')"></i>Upload
                                                </button>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel"
                                             aria-labelledby="custom-tabs-one-settings-tab">
                                            Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna,
                                            iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit
                                            dolor.
                                            Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique.
                                            Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum
                                            placerat
                                            urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                                            consequat diam. Nunc et felis ut nisl commodo dignissim. In hac
                                            habitasse
                                            platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                        </div>
                                    </div>
                                </div>

                                <!-- /.card -->

                            </div>

                    </div>
                </div>
            </div>
        </section>

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'


import {
    getHeaderIcon,
    pluralize,
    pluralize3,
    isEmpty,
    momentDatetime,
    getErrorMessage,
    showFlashMessage,
    getDictionaryLabel,
    dateIntoDbFormat,
    getFileSizeAsString
} from '@/commonFuncs'
import {settingsJsMomentDatetimeFormat, settingsAppColors} from '@/app.settings.js'
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// resources/js/Pages/Admins/Currencies/Form.vue
// import { page } from '@inertiajs/inertia-vue3';

import formEditor from '@/Pages/Admins/Currencies/Form'
import {onMounted, ref, watchEffect} from "vue";
import axios from "axios";
import ListingPagination from '@/components/ListingPagination.vue'
import ListingHeader from '@/components/ListingHeader.vue'
// import {usePage} from '@inertiajs/inertia-vue3';

import Datepicker from 'vue3-date-time-picker';
import 'vue3-date-time-picker/dist/main.css';
import {ModalsContainer, VueFinalModal} from "vue-final-modal";

export default {
    props: ['currency', 'minCurrencyHistoryDay'],

    name: 'adminCurrenciesEdit',
    components: {
        AdminLayout,
        ListingPagination,
        ListingHeader,
        Datepicker,
        VueFinalModal,
        ModalsContainer,
        CKEditor,
        formEditor
    },
    setup(props) {
        console.log('resources/js/Pages/Admins/Currencies/Edit.vue setup props::')
        console.log(props)
        const currency_history_filter_date_from = ref(props.minCurrencyHistoryDay)
        var d = new Date();
        const show_currency_history_filters_modal = ref(false)
        var today_date = dateIntoDbFormat(d)
        const currency_history_filter_date_till = ref(today_date)
        // console.log('currency_history_filter_date_till::')
        if (isEmpty(currency_history_filter_date_from.value)) {
            currency_history_filter_date_from.value = today_date
        }
        let currency = ref(props.currency)
        let currencyHistoryRows = ref([])
        let currencies_history_filtered_count = ref(0)
        let currencies_history_per_page = ref(0)
        let currencies_history_current_page = ref(1)
        let imageFiles = ref([])
        let uploaded_image_width = ref(null)
        let uploaded_image_height = ref(null)
        let currencyImageFile = null
        let currency_image_url = ref(null)
        let currency_image_info = ref('')

        let editorData = ref(' editorData init text')
        let editor = ref(ClassicEditor)
        let editorConfig = ref({})

        watchEffect(() => {
            if (imageFiles.value) {
                console.log('imageFiles.value::')
                console.log(imageFiles.value)
                if (typeof imageFiles.value[0] === 'undefined') return
                var image = new Image()
                image.src = imageFiles.value[0].blob
                // image.onload = function () {
                // bus.$emit('imageUploadedEvent', this.width, this.height)
                // }
            }
        })


        // let files=ref([])
        /**
         * Has changed
         * @param  Object|undefined   newFile   Read only
         * @param  Object|undefined   oldFile   Read only
         * @return undefined
         */
        function inputFile(newFile, oldFile) {
            console.log('00 inputFile currencyImageFile  newFile::')
            console.log(newFile)

            if (newFile /* && oldFile && !newFile.active && oldFile.active */) {
                // Get response data
                currencyImageFile = newFile
                console.log('123 INSIDE inputFile currencyImageFile  newFile::')
                console.log(newFile)


                console.log('response', newFile.response)
                if (newFile.xhr) {
                    //  Get the response status code
                    console.log('status', newFile.xhr.status)
                }
            }
        }

        /**
         * Pretreatment
         * @param  Object|undefined   newFile   Read and write
         * @param  Object|undefined   oldFile   Read only
         * @param  Function           prevent   Prevent changing
         * @return undefined
         */
        function inputFilter(newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                // Filter non-image file
                if (!/\.(jpeg|jpe|jpg|gif|png|webp)$/i.test(newFile.name)) {
                    return prevent()
                }
            }
            // Create a blob field
            newFile.blob = ''
            let URL = window.URL || window.webkitURL
            if (URL && URL.createObjectURL) {
                newFile.blob = URL.createObjectURL(newFile.file)
            }
        }

        function cancelCurrencyImageUpload() {
            console.log('cancelCurrencyImageUpload::')
            imageFiles.value = []
            uploaded_image_width.value = null
            uploaded_image_height.value = null
        }

        function loadCurrencyImage() {
            // console.log('loadCurrencyImage currency.value.id::')
            // console.log(currency.value.id)
            axios.get(route('admin.currencies.get_image', currency.value.id))
                .then(({data}) => {
                    // console.log('loadCurrencyImage data::')
                    // console.log(data)
                    if (!isEmpty(data.image)) {
                        currency_image_url.value = data.image.url
                        currency_image_info.value = data.image.file_name + ', ' + getFileSizeAsString(data.image.size) + ', ' + data.image.width + '*' + data.image.height
                    }
                })
                .catch(error => {
                    console.error(error)
                })
        } // loadCurrencyImage() {

        function uploadCancelCurrencyImage() {
            console.log('uploadCancelCurrencyImage currencyImageFile::')
            console.log(currencyImageFile)
            // var self = this
            fetch(currencyImageFile.blob).then(function (response) {
                if (response.ok) {
                    return response.blob().then(function (imageBlob) {
                        let imageUploadData = new FormData()
                        imageUploadData.append('id', currency.value.id)
                        imageUploadData.append('image', imageBlob)
                        imageUploadData.append('image_filename', currencyImageFile.name)

                        axios.post(route('admin.currencies.upload_image'), imageUploadData).then(({data}) => {
                            // ('Image upload', 'Image uploaded successfully !', 'success')
                            Toast.fire({
                                icon: 'success',
                                title: 'Image uploaded successfully !'
                            })
                            loadCurrencyImage()
                            cancelCurrencyImageUpload()
                        }).catch((error) => {
                            console.error(error)
                            Toast.fire({
                                icon: 'error',
                                title: 'Image uploading error : ' /*+ error.response.data.message */ + ' !'
                            })

                            // ('Image upload', 'Image uploading error : ' + error.response.data.message + ' !', 'warn')
                        })
                    })
                } else {
                    return response.json().then(function (jsonError) {
                        console.error(jsonError)
                    })
                }
            }).catch(function (error) {
                console.error(error)
                console.log('There has been a problem with your fetch operation: ', error.message)
            }) // fetch(currencyImageFile.blob).then(function (response) {

        }


        function loadCurrencyHistory() {
            console.log('loadCurrencyHistory currency_history_filter_date_from.value::')
            console.log(currency_history_filter_date_from.value)
            console.log(typeof currency_history_filter_date_from.value)
            if (!isEmpty(currency_history_filter_date_from.value) && typeof currency_history_filter_date_from.value.getMonth === 'function') {
                currency_history_filter_date_from.value = dateIntoDbFormat(currency_history_filter_date_from.value)
                console.log('CHANGED currency_history_filter_date_from.value::')
                console.log(currency_history_filter_date_from.value)
            }
            // console.log('loadCurrencyHistory currency_history_filter_date_till.value::')
            // console.log(currency_history_filter_date_till.value)
            if (!isEmpty(currency_history_filter_date_till.value) && typeof currency_history_filter_date_till.value.getMonth === 'function') {
                currency_history_filter_date_till.value = dateIntoDbFormat(currency_history_filter_date_till.value)
                console.log('CHANGED currency_history_filter_date_till.value::')
                console.log(currency_history_filter_date_till.value)
            }

            let url = route('admin.currency_histories.index', [currency.value.id, currencies_history_current_page.value, currency_history_filter_date_from.value, currency_history_filter_date_till.value])
            axios.get(url)
                .then(({data}) => {
                    console.log('loadCurrencyHistory data::')
                    console.log(data)
                    currencyHistoryRows.value = data.data
                    currencies_history_filtered_count.value = data.meta.total
                    currencies_history_per_page.value = parseInt(data.meta.per_page)
                })
                .catch(error => {
                    console.error(error)
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
                            console.log('deleteCurrencyHistory data::')
                            console.log(data)
                            loadCurrencyHistory()
                            Swal.fire(
                                'Deleted!',
                                'Currency history has been deleted.',
                                'success'
                            )
                        })
                        .catch(error => {
                            console.error(error)
                        })
                }
            })
        } // function deleteCurrencyHistory(currencyHistory) {


        function currencyHistoryPaginationPageClicked(page) {
            currencies_history_current_page.value = page
            loadCurrencyHistory()
        }

        function showCurrencyHistoryFiltersModal() {
            console.log('showCurrencyHistoryFiltersModal::')
            show_currency_history_filters_modal.value = true
        }

        function hideCurrencyHistoryFiltersModal() {
            console.log('hideCurrencyHistoryFiltersModal::')
            show_currency_history_filters_modal.value = false
        }

        function applyCurrencyHistoryFilters() {
            console.log('applyCurrencyHistoryFilters::')
            currencies_history_current_page.value = 1
            loadCurrencyHistory(true)

            show_currency_history_filters_modal.value = false
            let filters_count_text = getCurrencyHistoryFiltersCountText()
            let filters = {filter_name: 'filter_name'}
            window.emitter.emit('listingFilterModifiedEvent', {
                parentComponentKey: 'currencies_history',
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
            console.log('getCurrencyHistoryFiltersCountText ret::')
            console.log(ret)
            if (!ret) return ''
            return (ret > 0 ? ret + ' ' : '') + pluralize3(ret, ' no filters set', ' filter is set', ' filters are set')
        } // getCurrencyHistoryFiltersCountText


        const adminCurrencyEditOnMounted = async () => {
            console.log('adminCurrencyEditOnMounted::')
            // console.log('Edit.vue mounted 1 this.currency')
            // console.log(currency)
            // console.log(formEditor)

            loadCurrencyHistory()
            loadCurrencyImage()
            window.emitter.on('paginationPageChangedEvent', params => {
                console.log('TARGET paginationPageChangedEvent params::')
                console.log(params)
                if (params.parentComponentKey === 'currency_history') {
                    currencyHistoryPaginationPageClicked(params.page)
                }
            })

            window.emitter.on('showFiltersModalEvent', params => {
                console.log('TARGET showFiltersModalEvent params::')
                console.log(params)
                if (params.parentComponentKey === 'currencies_history') {
                    showCurrencyHistoryFiltersModal()
                }
            })


            window.emitter.on('listingHeaderRightButtonClickedEvent', params => {
                console.log('TARGET listingHeaderRightButtonClickedEvent params::')
                console.log(params)
                if (params.parentComponentKey === 'currencies_history') {
                    console.log('!!!!!loadCurrencyHistory::')
                    loadCurrencyHistory()
                }
            })

            window.emitter.on('imageUploadedEvent', params => {
                console.log('TARGET imageUploadedEvent params::')
                console.log(params)
                uploaded_image_width.value = uploaded_image_width
                uploaded_image_height.value = uploaded_image_height

            })
            //
            // console.log('Edit.vue  usePage().props.value.flash::')
            // console.log( usePage().props.value.flash)

            // showFlashMessage()

        }
        console.log('BEFORE onMounted::')
        onMounted(adminCurrencyEditOnMounted)

        return { // setup return

            // Listing Page state
            currency,
            // minCurrencyHistoryDay,
            currency_image_url,
            currency_image_info,
            currencyHistoryRows,
            currencies_history_filtered_count,
            currencies_history_per_page,
            currencies_history_current_page,
            editorData,
            editor,
            editorConfig,

            // Listing filtering
            show_currency_history_filters_modal,
            showCurrencyHistoryFiltersModal,
            hideCurrencyHistoryFiltersModal,
            applyCurrencyHistoryFilters,

            // Currency History listing
            currency_history_filter_date_from,
            currency_history_filter_date_till,

            // format,
            loadCurrencyHistory,
            currencyHistoryPaginationPageClicked,
            deleteCurrencyHistory,

            // Currency Image
            inputFilter,
            inputFile,
            imageFiles,
            uploaded_image_width,
            uploaded_image_height,
            cancelCurrencyImageUpload,
            uploadCancelCurrencyImage,


            // Common methods
            getHeaderIcon,
            pluralize,
            pluralize3,
            isEmpty,
            momentDatetime,
            getErrorMessage,
            showFlashMessage,
            getDictionaryLabel,
            dateIntoDbFormat,
            getFileSizeAsString
        }
    }, // setup() {

}
</script>
