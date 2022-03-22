<template>
    <admin-layout>
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!--                        settingsData::{{ settingsData }}-->

                            <div class="card card-primary card-tabs">
                                <div class="card-header p-2">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item">
                                            <!--                                                    active-->
                                            <a class="nav-link " id="settings-details-tab" data-toggle="pill"
                                               href="#custom-tabs-one-home" role="tab"
                                               aria-controls="custom-tabs-one-home" aria-selected="true">Settings</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="settings-history-tab" data-toggle="pill"
                                               href="#custom-tabs-one-profile" role="tab"
                                               aria-controls="custom-tabs-one-profile" aria-selected="false">History</a>
                                        </li>
                                        <li class="nav-item">
                                            <!--                                            active-->
                                            <a class="nav-link " id="settings-images-tab" data-toggle="pill"
                                               href="#settings" role="tab"
                                               aria-controls="settings"
                                               aria-selected="false">Image</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="settings-operations-tab" data-toggle="pill"
                                               href="#custom-tabs-one-settings" role="tab"
                                               aria-controls="custom-tabs-one-settings"
                                               aria-selected="false">Operations</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <!--                                                show active-->
                                        <div class="tab-pane  " id="custom-tabs-one-home" role="tabpanel"
                                             aria-labelledby="settings-details-tab">
                                            <!--                                            01settingsData::{{ settingsData}}-->
                                            <form-editor :is_insert="false" :settingsData="settingsData[0]"
                                                         :currenciesSelectionArray="currenciesSelectionArray"></form-editor>
                                        </div>

                                        <div class="tab-pane fade " id="custom-tabs-one-profile"
                                             role="tabpanel" aria-labelledby="settings-history-tab">
                                            settings-history-tab
                                        </div>
                                        <!--                                        show active-->
                                        <div class="tab-pane " id="settings" role="tabpanel"
                                             aria-labelledby="settings-images-tab">
                                            settings-images-tab
                                        </div>


                                        <div class="tab-pane show active" id="custom-tabs-one-settings" role="tabpanel"
                                             aria-labelledby="settings-operations-tab">

                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        <i :class="getHeaderIcon('settings')" class="mr-1"></i>
                                                        Currency rates data import
                                                    </h3>

                                                </div> <!-- card-title -->

                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4">
                                                            <button type="button" class="btn btn-primary btn-block"
                                                                    @click.prevent="runCurrencyRatesImport()">
                                                                <i :class="getHeaderIcon('action')"></i>
                                                                Run
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label class="form-check-label">Manually run currency rates import for all currencies in the system on today date</label>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer" v-show="currency_rates_import_base_currency_code && currency_rates_import_operation_date">
                                                        <div class="product-info">
                                                            <i :class="getHeaderIcon('results')" class="mr-1"></i>
                                                            <a href="javascript:void(0)" class="product-title">
                                                                for {{ currency_rates_import_base_currency_code}} / {{ currency_rates_import_operation_date }}
                                                            </a>
                                                            <span class="product-description">
                                                                <span class="badge badge-warning m-1">{{ currency_rates_import_new_currency_rates_added_count }}</span>
                                                               currency rates were added
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    momentDatetime,
    getErrorMessage,
    showFlashMessage,
    getDictionaryLabel,
} from '@/commonFuncs'
import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'

import formEditor from '@/Pages/Admins/Settings/Form'
import {onMounted, ref} from "vue";
import axios from "axios";
import ListingPagination from '@/components/ListingPagination.vue'
import ListingHeader from '@/components/ListingHeader.vue'
import {usePage} from '@inertiajs/inertia-vue3';

// import VueUploadComponent from 'vue-upload-component'
// app.component('file-upload', VueUploadComponent)

export default {
    props: ['settingsData', 'currenciesSelectionArray'],

    name: 'SettingsEdit',
    components: {
        AdminLayout,
        ListingPagination,
        ListingHeader,
        // FileUpload: VueUploadComponent,
        formEditor
    },
    setup(props) {
        console.log('resources/js/Pages/Admins/Currencies/Edit.vue setup props::')
        console.log(props)
        let settingsData = ref([props.settingsData])
        const currency_rates_import_new_currency_rates_added_count= ref(0)
        const currency_rates_import_base_currency_code= ref('')
        const currency_rates_import_operation_date= ref('')

        function runCurrencyRatesImport() {
            console.log('runCurrencyRatesImport::')

            Swal.fire({
                title: 'Are you sure?',
                text: "You what to run currency rates import !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, run!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(route('admin.settings.run_currency_rates_import'))
                        .then(({data}) => {
                           // console.log('runCurrencyRatesImport data.retArray::')
                           //  console.log(data.retArray)
                            currency_rates_import_new_currency_rates_added_count.value = data.retArray.new_currency_rate_added
                            currency_rates_import_base_currency_code.value = data.retArray.base_currency_code
                            currency_rates_import_operation_date.value = data.retArray.operation_date
                            Swal.fire(
                                'COMPLETED!',
                                'Currency rates import was successfully run !',
                                'success'
                            )
                        })
                        .catch(error => {
                            console.error(error)
                        })
                }
            })

        }

        const adminSettingsEditOnMounted = async () => {
            console.log('adminSettingsEditOnMounted settingsData::')
            console.log(settingsData)
            // console.log('Edit.vue  usePage().props.value.flash::')
            // console.log( usePage().props.value.flash)
            showFlashMessage()
        }
        // console.log('BEFORE onMounted::')

        onMounted(adminSettingsEditOnMounted)


        return { // setup return
            // Listing Page state
            settingsData,
            runCurrencyRatesImport,
            currency_rates_import_new_currency_rates_added_count,
            currency_rates_import_base_currency_code,
            currency_rates_import_operation_date,

            // Common methods
            getHeaderIcon,
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            showFlashMessage,
            getDictionaryLabel,
        }
    }, // setup() {

}
</script>
