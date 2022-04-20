<template>
    <admin-layout>
        <!--                        settingsData::{{ settingsData }}-->

        settingsSmallIconImage::{{ settingsSmallIconImage}}
        <div class="card card-primary card-tabs">
            <div class="card-header p-2">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <!--                                                    active-->
                        <a class="nav-link " id="settings-details-tab" data-toggle="pill"
                           href="#settings-details" role="tab"
                           aria-controls="settings-details" aria-selected="true">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-app-images-tab" data-toggle="pill"
                           href="#settings-app-images" role="tab"
                           aria-controls="settings-app-images" aria-selected="true">App images</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="settings-operations-tab" data-toggle="pill"
                           href="#settings-operations" role="tab"
                           aria-controls="settings-operations"
                           aria-selected="false">Operations</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <!--                                                show active-->
                    <div class="tab-pane fade" id="settings-details" role="tabpanel"
                         aria-labelledby="settings-details-tab">
                        <form-editor :is_insert="false" :settingsData="settingsData[0]"
                                     :currenciesSelectionArray="currenciesSelectionArray"></form-editor>
                    </div>

                    <div class="tab-pane fade" id="settings-app-images" role="tabpanel"
                         aria-labelledby="settings-app-images-tab">
                        small_icon
                        <FileUploaderPreviewer
                            :imageUploader="settingsAppImageSmallIconUploader"
                            :image_url="settings_app_image_small_icon_url"
                            :image_info="settings_app_image_small_icon_info"
                            :parent_component_key="'settings_app_image_small_icon'"
                            :show_bottom_info_text="true"
                            :layout="'admin'"

                        ></FileUploaderPreviewer>
                    </div>

                    <div class="tab-pane show active" id="settings-operations" role="tabpanel"
                         aria-labelledby="settings-operations-tab">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title admin_color">
                                    <i :class="getHeaderIcon('cache')" class="action_icon icon_right_text_margin"></i>
                                    Clear Cache
                                </h3>
                            </div> <!-- card-header -->

                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-6">
                                        <jet-button :button_type="'admin_action'"  @click.prevent="makeClearCache()">
                                            <i :class="getHeaderIcon('view')" class="action_icon icon_right_text_margin"></i>Clear Cache
                                        </jet-button>
                                        <div v-show="clear_cache_action_processing" class="form_processing"></div>
                                    </div>
                                </div>
                            </div>
                        </div>  <!-- Clear Cache -->


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title admin_color">
                                    <i :class="getHeaderIcon('log')" class="action_icon icon_right_text_margin"></i>
                                    Laravel log
                                </h3>
                            </div> <!-- card-header -->


                            <div class="card-body">
<!--                                action_processing::{{ action_processing}}-->
                                <div class="form-group row">
                                    <div class="col-6">
                                        <jet-button :button_type="'admin_action'"  @click.prevent="uploadImage()">
                                            <i :class="getHeaderIcon('view')" class="action_icon icon_right_text_margin"></i>View 14
                                        </jet-button>
                                        <div v-show="action_processing" class="form_processing"></div>
                                    </div>
                                    <div class="col-6">
<!--                                        <button type="button" class="btn btn-primary btn-block"-->
<!--                                                @click.prevent="deleteLaravelLog()">-->
<!--                                            <i :class="getHeaderIcon('clear')" class="action_icon icon_right_text_margin"></i> Clear-->
<!--                                        </button>-->
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-check-label admin_editable_label">View
                                        Current Laravel log</label>
                                </div>
                            </div>
                            <div class="card-footer" v-show="sql_tracing_log_text">
                                <div class="admin_editable_label"
                                     style="border:2px dotted red !important;  overflow-y: scroll; max-height: 600px;">
                                    <i :class="getHeaderIcon('results')" class="action_icon icon_right_text_margin"></i>
                                    {{ sanitizeHtml(laravel_log_text) }}
                                </div>
                            </div>
                        </div>      <!-- Laravel log -->





                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title admin_color">
                                    <i :class="getHeaderIcon('log')" class="action_icon icon_right_text_margin"></i>
                                    SQL tracing log
                                </h3>

                            </div> <!-- card-header -->
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary btn-block"
                                                @click.prevent="viewSQLTracingLog()">
                                            <i :class="getHeaderIcon('view')" class="action_icon icon_right_text_margin"></i> View
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary btn-block"
                                                @click.prevent="deleteSQLTracingLog()">
                                            <i :class="getHeaderIcon('clear')" class="action_icon icon_right_text_margin"></i> Clear
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-check-label admin_editable_label">View
                                        Current SQL tracing</label>
                                </div>
                            </div>

                            <div class="card-footer" v-show="sql_tracing_log_text">
                                <div class="admin_editable_label"
                                     style="border:0px dotted red !important;  overflow-y: scroll; max-height: 600px;">
                                    <i :class="getHeaderIcon('results')" class="action_icon icon_right_text_margin"></i>
                                    {{ sanitizeHtml(sql_tracing_log_text) }}
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title admin_color">
                                    <i :class="getHeaderIcon('settings')" class="action_icon icon_right_text_margin"></i>
                                    Currency rates data import
                                </h3>

                            </div> <!-- card-header -->

                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-primary btn-block"
                                                @click.prevent="runCurrencyRatesImport()">
                                            <i :class="getHeaderIcon('action')" class="action_icon icon_right_text_margin"></i> Run
                                        </button>
                                    </div>
                                    <div class="col-sm-8">
                                        <label class="form-check-label admin_editable_label">Manually
                                            run currency rates import for all currencies in the system
                                            on today date</label>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer"
                                 v-show="currency_rates_import_base_currency_code && currency_rates_import_operation_date">
                                <div class="admin_editable_label">
                                    <i :class="getHeaderIcon('results')" class="action_icon icon_right_text_margin"></i>
                                    <a href="javascript:void(0)" class="product-title">
                                        for {{ currency_rates_import_base_currency_code }} /
                                        {{ currency_rates_import_operation_date }}
                                    </a>
                                    <span class="product-description admin_editable_label">
                                                                <span class="badge badge-warning m-1">{{
                                                                        currency_rates_import_new_currency_rates_added_count
                                                                    }}</span>
                                                               currency rates were added
                                                            </span>
                                </div>
                            </div>
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
    momentDatetime,
    getErrorMessage,
    showFlashMessage,
    getDictionaryLabel,
    getFileSizeAsString,
} from '@/commonFuncs'
import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'
import * as sanitizeHtml from 'sanitize-html'

import formEditor from '@/Pages/Admins/Settings/Form'
import {onMounted, ref} from "vue";
import axios from "axios";
import ListingHeader from '@/components/ListingHeader.vue'
import {useForm, usePage} from '@inertiajs/inertia-vue3';
import FileUploaderPreviewer from '@/components/FileUploaderPreviewer.vue'
import {Inertia} from "@inertiajs/inertia";
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetLabel from '@/Jetstream/Label.vue'


// import VueUploadComponent from 'vue-upload-component'
// app.component('file-upload', VueUploadComponent)

export default {
    props: {

        settingsData: {
            type: Object,
            required: true,
        },
        settingsSmallIconImage: {
            type: Object,
            required: true,
        },

        currenciesSelectionArray: {
            type: Object,
            required: true,
        },
    },

    // props: ['settingsData', 'currenciesSelectionArray'],

    name: 'SettingsEdit',
    components: {
        AdminLayout,
        ListingHeader,
        FileUploaderPreviewer,
        // FileUpload: VueUploadComponent,
        formEditor,
        JetSectionBorder,
        JetButton,
        JetLabel,
    },
    setup(props) {
        let settingsData = ref([props.settingsData])
        let settingsSmallIconImage = ref([props.settingsSmallIconImage])
        let currency_rates_import_new_currency_rates_added_count = ref(0)
        let currency_rates_import_base_currency_code = ref('')
        let currency_rates_import_operation_date = ref('')

        // settings_app_image_small_icon
        // let settings_app_image_small_icon_url = ref('')
        // let settings_app_image_small_icon_info = ref('')
        /* settingsSmallIconImage::[ { "url": "http://local-bi-currencies.com/storage/currency_app/30/me128r128.png", "width": 128, "height": 128, "size": 25209, "file_name": "me128r128.png" } ] */
        let settings_app_image_small_icon_url = ref(props.settingsSmallIconImage.url)
        let settings_app_image_small_icon_info= ref(props.settingsSmallIconImage.file_name + ', ' + getFileSizeAsString(props.settingsSmallIconImage.size) + ', ' + props.settingsSmallIconImage.width + '*' + props.settingsSmallIconImage.height)
        let settingsAppImageSmallIconUploader = ref(useForm({
            image: '',
            image_filename: '',
            image_type: '',
        }))

        let laravel_log_text = ref('')
        let sql_tracing_log_text = ref('')
        let action_processing = ref(false)
        let clear_cache_action_processing = ref(false)

        //                     fetchSettingsAppImageSmallIcon(params.uploadedImageFile, 'small_icon')
        function fetchSettingsAppImageSmallIcon(settingsAppImageSmallIcon, image_type) {
            console.log('fetchSettingsAppImageSmallIcon settingsAppImageSmallIcon::')
            console.log(settingsAppImageSmallIcon)
            console.log('fetchSettingsAppImageSmallIcon image_type::')
            console.log(image_type)
            fetch(settingsAppImageSmallIcon.blob).then(function (response) {
                if (response.ok) {
                    return response.blob().then(function (imageBlob) {
                        console.log('settingsAppImageSmallIconUploader::')
                        console.log(settingsAppImageSmallIconUploader)


                        settingsAppImageSmallIconUploader.value.image = imageBlob
                        settingsAppImageSmallIconUploader.value.image_filename = settingsAppImageSmallIcon.name
                        settingsAppImageSmallIconUploader.value.image_type = image_type

                        //    Route::post('settings/image/upload', [SettingsController::class, 'upload_image'])->name('settings.upload_image');
                        settingsAppImageSmallIconUploader.value.post(route('admin.settings.upload_image'), {
                            preserveScroll: true,
                            onSuccess: (resp) => {
                                console.log(' resp::')
                                console.log(resp)
                                Toast.fire({
                                    icon: 'success',
                                    title: 'You have uploaded image successfully'
                                })
                                window.emitter.emit('imageBlobFetchedEvent', {
                                    parent_component_key: 'settings_app_image_' + image_type,
                                    resp: resp,
                                })
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
                console.log('There has been a problem with your fetch operation: ', e.message)
            }) // fetch(settingsAppImageSmallIcon.blob).then(function (response) {

        }

        function makeClearCache() {
            clear_cache_action_processing.value = true
            axios.get(route('admin.settings.clear_cache'))
                .then(({data}) => {
                    // laravel_log_text.value = data.text
                    clear_cache_action_processing.value = false
                    Swal.fire(
                        'COMPLETED!',
                        'Laravel cache was successfully cleared !',
                        'success'
                    )
                })
                .catch(e => {
                    clear_cache_action_processing.value = false
                    console.error(e)
                })
        } // makeClearCache

        function viewLaravelLog() {
            action_processing.value = true
            axios.get(route('admin.settings.view_laravel_log'))
                .then(({data}) => {
                    laravel_log_text.value = data.text
                    action_processing.value = false
                    Swal.fire(
                        'COMPLETED!',
                        'Laravel log was successfully opened !',
                        'success'
                    )
                })
                .catch(e => {
                    action_processing.value = false
                    console.error(e)
                })
        } // viewLaravelLog

        function deleteLaravelLog() {
            action_processing.value = true
            axios.get(route('admin.settings.delete_laravel_log'))
                .then(({data}) => {
                    action_processing.value = false
                    laravel_log_text.value = data.text
                    Swal.fire(
                        'COMPLETED!',
                        'Laravel log was successfully cleared !',
                        'success'
                    )
                })
                .catch(e => {
                    action_processing.value = false
                    console.error(e)
                })
        } // deleteLaravelLog


        function viewSQLTracingLog() {
            action_processing.value = true
            axios.get(route('admin.settings.view_sql_tracing_log'))
                .then(({data}) => {
                    action_processing.value = false
                    sql_tracing_log_text.value = data.text
                    Swal.fire(
                        'COMPLETED!',
                        'SQL Tracing log was successfully opened !',
                        'success'
                    )
                })
                .catch(e => {
                    action_processing.value = false
                    console.error(e)
                })
        } // viewSQLTracingLog

        function deleteSQLTracingLog() {
            action_processing.value = true
            axios.get(route('admin.settings.delete_sql_tracing_log'))
                .then(({data}) => {
                    sql_tracing_log_text.value = data.text
                    action_processing.value = false
                    Swal.fire(
                        'COMPLETED!',
                        'SQLTracing log was successfully cleared !',
                        'success'
                    )
                })
                .catch(e => {
                    action_processing.value = false
                    console.error(e)
                })
        } // deleteSQLTracingLog

        function runCurrencyRatesImport() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to run currency rates import !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, run!'
            }).then((result) => {
                if (result.isConfirmed) {
                    action_processing.value = true
                    axios.post(route('admin.settings.run_currency_rates_import'))
                        .then(({data}) => {
                            currency_rates_import_new_currency_rates_added_count.value = data.retArray.new_currency_rate_added
                            currency_rates_import_base_currency_code.value = data.retArray.base_currency_code
                            currency_rates_import_operation_date.value = data.retArray.operation_date
                            action_processing.value = false
                            Swal.fire(
                                'COMPLETED!',
                                'Currency rates import was successfully run !',
                                'success'
                            )
                        })
                        .catch(e => {
                            action_processing.value = false
                            console.error(e)
                        })
                }
            })

        }

        function adminSettingsEditOnMounted() {
            // console.log('Edit.vue  usePage().props.value.flash::')
            // console.log( usePage().props.value.flash)
            showFlashMessage()
            window.emitter.on('FileUploaderPreviewerUploadImageEvent', params => {
                console.log('TARGET FileUploaderPreviewerUploadImageEvent params::')
                console.log(params)
                if (params.parent_component_key === 'settings_app_image_small_icon') {
                    fetchSettingsAppImageSmallIcon(params.uploadedImageFile, 'small_icon')
                }
            })

        }

        onMounted(adminSettingsEditOnMounted)


        return { // setup return
            // Listing Page state
            settingsData,
            settingsSmallIconImage,
            runCurrencyRatesImport,
            currency_rates_import_new_currency_rates_added_count,
            currency_rates_import_base_currency_code,
            currency_rates_import_operation_date,
            viewLaravelLog,
            deleteLaravelLog,
            laravel_log_text,
            sql_tracing_log_text,
            action_processing,
            clear_cache_action_processing,
            makeClearCache,
            viewSQLTracingLog,
            deleteSQLTracingLog,

            settings_app_image_small_icon_url,
            settings_app_image_small_icon_info,
            settingsAppImageSmallIconUploader,

            // Common methods
            getHeaderIcon,
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            showFlashMessage,
            getDictionaryLabel,
            sanitizeHtml,
            getFileSizeAsString
        }
    }, // setup() {

}
</script>
