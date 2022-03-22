<template>
    <div v-if="!formEditor.processing">
<!--        formEditor.errors::{{ formEditor.errors }}<br>-->
<!--        formEditor::{{ formEditor }}<br>-->

        <div class="card-header">
            <h3 class="card-title">
                <i :class="getHeaderIcon('settings')" class="mr-1"></i>
                Edit Settings
            </h3>
        </div> <!-- card-title -->

        <form @submit.prevent="saveSettings">

            <div class="card-body p-0">

                <div class="block_2columns_md p-2"> <!-- site_name -->
                    <div class="horiz_divider_left_13">
                        <label for="site_name">Site Name:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="site_name"
                               placeholder="Site descriptive name" v-model="formEditor.site_name"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.site_name }"
                               autofocus="autofocus" autocomplete="off" maxlength="255">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.site_name}">
                            {{ formEditor.errors.site_name }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" site_name -->

                <div class="block_2columns_md p-2"> <!-- site_heading -->
                    <div class="horiz_divider_left_13">
                        <label for="site_heading">Site heading:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="site_heading"
                               placeholder="Site descriptive name" v-model="formEditor.site_heading"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.site_heading }"
                               autofocus="autofocus" autocomplete="off" maxlength="255">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.site_heading}">
                            {{ formEditor.errors.site_heading }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" site_heading -->

                <div class="block_2columns_md p-2"> <!-- copyright_text -->
                    <div class="horiz_divider_left_13">
                        <label for="copyright_text">Copyright text:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="copyright_text"
                               placeholder="Site descriptive name" v-model="formEditor.copyright_text"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.copyright_text }"
                               autofocus="autofocus" autocomplete="off" maxlength="255">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.copyright_text}">
                            {{ formEditor.errors.copyright_text }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" copyright_text -->

                <div class="block_2columns_md p-2"> <!-- base_currency -->
                    <div class="horiz_divider_left_13">
                        <label for="base_currency">Base currency:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <Multiselect
                            v-model="formEditor.base_currency"
                            id="base_currency"
                            mode="single"
                            :options="currenciesSelectionArray"
                            valueProp="char_code"
                            :searchable="true"
                            :max="-1"
                            ref="multiselect"
                            label="name"
                            track-by="name"
                            placeholder="Select currency"
                            class="multiselect-admin-lte"
                        />
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.base_currency}">
                            {{ formEditor.errors.base_currency }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" base_currency -->


                <div class="block_2columns_md p-2"> <!-- backend_items_per_page -->
                    <div class="horiz_divider_left_13">
                        <label for="backend_items_per_page">Backend items per page:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="backend_items_per_page"
                               placeholder="Site descriptive name" v-model="formEditor.backend_items_per_page"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.backend_items_per_page }"
                               autofocus="autofocus" autocomplete="off" maxlength="4">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.backend_items_per_page}">
                            {{ formEditor.errors.backend_items_per_page }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" backend_items_per_page -->

                <div class="block_2columns_md p-2"> <!-- rate_decimal_numbers -->
                    <div class="horiz_divider_left_13">
                        <label for="rate_decimal_numbers">Rate decimal numbers:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="rate_decimal_numbers"
                               placeholder="Site descriptive name" v-model="formEditor.rate_decimal_numbers"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.rate_decimal_numbers }"
                               autofocus="autofocus" autocomplete="off" maxlength="4">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.rate_decimal_numbers}">
                            {{ formEditor.errors.rate_decimal_numbers }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" rate_decimal_numbers -->

                <div class="block_2columns_md p-2"> <!-- items_per_page -->
                    <div class="horiz_divider_left_13">
                        <label for="items_per_page">Items per page:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="items_per_page"
                               placeholder="Site descriptive name" v-model="formEditor.items_per_page"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.items_per_page }"
                               autofocus="autofocus" autocomplete="off" maxlength="4">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.items_per_page}">
                            {{ formEditor.errors.items_per_page }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" items_per_page -->

            </div>

            <div class="card-footer clearfix flex">
                <button type="button" class="btn btn-secondary btn-xs mt-1"
                        @click="cancelSettingsEdit">
                    <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
                </button>
                <button type="submit" class="btn btn-success btn-sm text-uppercase ml-4">
                    <i :class="getHeaderIcon('save')" class="mr-1"></i>Update
                </button>
            </div>

        </form>
    </div>

</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'
import Multiselect from '@vueform/multiselect'

import {
    getHeaderIcon,
    momentDatetime,
    pluralize,
    pluralize3,
    getErrorMessage,
    showFlashMessage,
    getDictionaryLabel,

} from '@/commonFuncs'
import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'
import {ref, onMounted, computed} from "vue";
import {useForm} from '@inertiajs/inertia-vue3';

import {Inertia} from '@inertiajs/inertia'

export default {
    props: ['settingsData', 'currenciesSelectionArray'],

    name: 'SettingsForm',
    components: {
        AdminLayout,
        Multiselect
    },
    setup(props) {
        const formEditor = ref(useForm({
            site_name: props.settingsData.site_name,
            site_heading: props.settingsData.site_heading,
            copyright_text: props.settingsData.copyright_text,
            base_currency: props.settingsData.base_currency,
            backend_items_per_page: props.settingsData.backend_items_per_page,
            rate_decimal_numbers: props.settingsData.rate_decimal_numbers,
            items_per_page: props.settingsData.items_per_page,
        }))

        function cancelSettingsEdit() {
            Inertia.visit(route('dashboard.index'), {method: 'get'});
        }

        function isProxy(proxy) {
            return proxy == null ? false : !!proxy[Symbol.for("__isProxy")];
        }


        function saveSettings() {
            // console.log('formEditor::')
            // console.log(formEditor)
            formEditor.value.put(route('admin.settings.update'), {
                preserveScroll: true,
                onSuccess: (resp) => {
                    console.log('UPDATED resp::')
                    console.log(resp)
                },
                onError: (e) => {
                    console.error(e)
                    Toast.fire({
                        icon: 'error',
                        // title: 'setting error : ' + getErrorMessage(e)
                        title: 'Updating setting error!'
                    })
                }

            })
        } // saveSettings() {

        const adminSettingsFormOnMounted = async () => {
            console.log('Form.vue adminSettingsFormOnMounted 1 settingsData')
        }
        onMounted(adminSettingsFormOnMounted)

        return { // setup return
            // Listing Page state
            formEditor,
            cancelSettingsEdit,
            saveSettings,

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
