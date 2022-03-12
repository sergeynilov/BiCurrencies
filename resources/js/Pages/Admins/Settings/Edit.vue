<template>
    <admin-layout>
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
<!--                        settingsData::{{ settingsData }}-->
                        <div class="card card-primary">

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
                                            <form-editor :is_insert="false" :settingsData="settingsData[0]" :currenciesSelectionArray="currenciesSelectionArray"></form-editor>
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
                                            <h1>settings-operations-tab</h1>

                                            <p class="text-sm text-warning p-2 pl-4">
                                                <i :class="getHeaderIcon('info')"></i>
                                                No data found. Try to change filter options.
                                            </p>
                                            file:///mnt/_work_sdb8/wwwroot/lar/BiCurrencies/__TEMPLATES/AdminLTE-3.2.0/pages/UI/buttons.html
                                            use : Application Buttons with Custom Colors

                                            clear_rates_history
                                            run_currency_rates_import_manually

                                            file:///_work/NSN/Me/Passport/IMG_20180201_082106.jpg

                                            Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna,
                                            iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor.
                                            Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique.
                                            Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat
                                            urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                                            consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse
                                            platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                        </div>
                                    </div>
                                </div>

                                <!-- /.card -->

                            </div>

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
import { usePage } from '@inertiajs/inertia-vue3';

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
        // console.log('props.settingsData::')
        // console.log(props.settingsData)
        let settingsData = ref([props.settingsData])


        const adminSettingsEditOnMounted = async () => {
            console.log('adminSettingsEditOnMounted settingsData::')
            console.log(settingsData)
            // console.log(formEditor)
            // window.emitter.on('paginationPageChangedEvent', params => {
            //     console.log('TARGET paginationPageChangedEvent params::')
            //     console.log(params)
            //     if (params.parentComponentKey === 'currency_history') {
            //         currencyHistoryPaginationPageClicked(params.page)
            //     }
            // })
            // window.emitter.on('listingHeaderRightButtonClickedEvent', params => {
            //     console.log('TARGET listingHeaderRightButtonClickedEvent params::')
            //     console.log(params)
            //     if (params.parentComponentKey === 'currencies_history') {
            //         console.log('!!!!!loadCurrencyHistory::')
            //         loadCurrencyHistory()
            //     }
            // })

            //
            console.log('Edit.vue  usePage().props.value.flash::')
            console.log( usePage().props.value.flash)
            showFlashMessage()
        }
        // console.log('BEFORE onMounted::')

        onMounted(adminSettingsEditOnMounted)


        return { // setup return
            // Listing Page state
            settingsData,

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
