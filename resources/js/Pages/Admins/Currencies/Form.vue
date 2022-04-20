<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title admin_color">
                <i :class="getHeaderIcon('currency')" class="action_icon icon_right_text_margin"></i>
                {{ getFormEditorTitle }}
            </h3>
        </div> <!-- card-header -->

        <form @submit.prevent="saveCurrency">

            <div class="card-body p-0">
                <div class="block_2columns_md p-2" v-if="!is_insert"> <!-- id -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="id" value="Id:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="id" type="text" class="form-control"
                                   v-model="formEditor.id" disabled/>
                    </div>
                </div> <!-- class="block_2columns_md" id -->

                <div class="block_2columns_md p-2"> <!-- name -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="name" value="Currency Name:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="name" type="text" class="form-control admin_editable_input"
                                   v-model="formEditor.name" placeholder="Currency descriptive name"
                                   :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.name }"
                                   autocomplete="off"/>
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.name}">
                            {{ formEditor.errors.name }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" name -->

                <div class="block_2columns_md p-2"> <!-- num_code -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="num_code" value="Number code:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="num_code" type="text" class="form-control admin_editable_input"
                                   v-model="formEditor.num_code" placeholder="Currency descriptive num code"
                                   :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.num_code }"
                                   autocomplete="off"/>
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.num_code}">
                            {{ formEditor.errors.num_code }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" num_code -->

                <div class="block_2columns_md p-2"> <!-- char_code -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="char_code" value="Char code:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="char_code" type="text" class="form-control admin_editable_input"
                                   v-model="formEditor.char_code" placeholder="Currency descriptive char code"
                                   :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.char_code }"
                                   autocomplete="off"/>
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.char_code}">
                            {{ formEditor.errors.char_code }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" char_code -->

                <div class="block_2columns_md p-2"> <!-- color -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="btn_color" value="Color:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23 pull-left clearfix">

                        <button type="button" class="btn btn-secondary btn-sm admin_color"
                                @click="showColorPickerModal('color')" id="btn_color">
                            <i :class="getHeaderIcon('color')" class="action_icon icon_right_text_margin"></i>Select
                            Color
                        </button>
                        <div style="float: right;">
                            <p class="text-sm p-0 pull-left" :style="{color: formEditor.color}"
                               v-show="formEditor.color">
                                <i :class="getHeaderIcon('info')" class="action_icon icon_right_text_margin"></i>
                                Current color : {{ formEditor.color }}
                            </p>
                        </div>

                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.color}">
                            {{ formEditor.errors.color }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" color -->

                <div class="block_2columns_md p-2"> <!-- bgcolor -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="btn_bgcolor" value="Background color:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <button type="button" class="btn btn-secondary btn-sm admin_color"
                                @click="showColorPickerModal('bgcolor')" id="btn_bgcolor ">
                            <i :class="getHeaderIcon('color')" class="action_icon icon_right_text_margin"></i>Select
                            Color
                        </button>
                        <p class="text-sm p-0" :style="{background: formEditor.bgcolor}" style="float: right;"
                           v-show="formEditor.bgcolor">
                            <i :class="getHeaderIcon('info')" class="action_icon icon_right_text_margin"></i>
                            Current color : {{ formEditor.bgcolor }}
                        </p>
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.bgcolor}">
                            {{ formEditor.errors.bgcolor }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" bgcolor -->

                <div class="block_2columns_md p-2"> <!-- is_top -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="is_top" value="Is top:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23 custom-control custom-checkbox">
                        <jet-checkbox name="is_top" id="is_top" v-model:checked="formEditor.is_top" class="ml-4"/>
                        <label class="admin_editable_label custom-control-label ml-4" for="is_top">
                            Selected currency will be visible on frontend
                        </label>
                    </div>
                </div> <!-- class="block_2columns_md" is_top -->

                <div class="block_2columns_md p-2"> <!-- active -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="active" value="Active:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="active" type="text" class="form-control"
                                   v-model="activeLabel" disabled/>
                    </div>
                </div> <!-- class="block_2columns_md" active -->

                <div class="block_2columns_md p-2"> <!-- ordering -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="ordering" value="Ordering:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="ordering" type="text" class="form-control admin_editable_input"
                                   v-model="formEditor.ordering" placeholder="Valid integer value"
                                   :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.ordering }"
                                   autocomplete="off"/>
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.ordering}">
                            {{ formEditor.errors.ordering }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" ordering -->

                <div class="block_2columns_md p-2" v-if="!is_insert"> <!-- created_at -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="created_at" value="Created:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="created_at" type="text" class="form-control"
                                   v-model="createdAtLabel" disabled/>
                    </div>
                </div> <!-- class="block_2columns_md" created_at -->

                <div class="block_2columns_md p-2" v-if="!is_insert && formEditor.updated_at">
                    <!-- created_at -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="updated_at" value="Updated:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="updated_at" type="text" class="form-control"
                                   v-model="updatedAtLabel" disabled/>
                    </div>
                </div> <!-- class="block_2columns_md" updated_at -->
            </div>

            <div class="card-footer admin_color clearfix">

                <div class="row">
                    <div class="col-md-12 col-lg-6 d-flex flex-nowrap mb-3">
                        <jet-button button_type="admin_cancel" @click="cancelCurrencyEditor"
                                    :disabled="formEditor.processing">
                            <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
                        </jet-button>

                        <jet-button type="submit" button_type="admin_save" :disabled="formEditor.processing">
                            <i :class="getHeaderIcon('save')"
                               class="action_icon icon_right_text_margin"></i>{{ getSubmitBtnTitle }}
                        </jet-button>
                        <div v-show="formEditor.processing" class="form_processing"></div>
                    </div>

                    <div class="col-md-12 col-lg-6 mb-3">
                        <div class="btn-group btn_remove_right_aligned" v-if="!is_insert">
                            <button type="button" class="btn btn-info">Action</button>
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown"
                                    aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item btn btn-sm btn_remove_right_aligned" @click="deleteCurrency()">
                                    <i :class="getHeaderIcon('remove')" class="action_icon icon_right_text_margin"></i>Delete
                                </a>

                                <a class="dropdown-item btn-success" @click="activateCurrency()"
                                   v-show="!formEditor.active">
                                    <i :class="getHeaderIcon('status')" class="action_icon icon_right_text_margin"></i>Activate
                                </a>
                                <a class="dropdown-item btn-secondary" @click="deactivateCurrency()"
                                   v-show="formEditor.active">
                                    <i :class="getHeaderIcon('status')" class="action_icon icon_right_text_margin"></i>Deactivate
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>

    <vue-final-modal
        v-model="show_color_picker_modal"
        classes="admin_editor_container"
        content-class="admin_editor_content"
    >
        <h5 class="admin_editor_header m-0 m-0">
            <i :class="getHeaderIcon('color')" class="action_icon icon_right_text_margin"></i>Select color
        </h5>

        <div class="content admin_editor_content_editor_form flex">
            <div :style="{background: modal_picker_color_selected_value}"
                 class="justify-content-center align-content-center">

                <ColorPicker
                    theme="dark"
                    :color="modal_picker_color_selected_value"
                    :sucker-hide="true"
                    :sucker-canvas="suckerCanvas"
                    :sucker-area="suckerArea"
                    @changeColor="changeColor"
                    @openSucker="openSucker"
                />

            </div>
        </div>
        <button class="admin_editor_close m-0 mt-3 mr-2" @click="hideColorPickerModal">
            x
        </button>

        <div class="admin_editor_footer">
            <button type="button" class="btn btn-secondary btn-sm"
                    @click="hideColorPickerModal">
                <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
            </button>
            <button type="button" class="btn btn-success btn-sm text-uppercase right_btn_from_left_margin"
                    @click="applyColorPickerModal">
                <i :class="getHeaderIcon('save')" class="action_icon icon_right_text_margin"></i>Apply
            </button>
        </div>

    </vue-final-modal>

</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'
import {ColorPicker} from 'vue-color-kit'
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'


import {
    getHeaderIcon,
    momentDatetime,
    pluralize,
    pluralize3,
    getErrorMessage,
    showFlashMessage,
    getDictionaryLabel,
} from '@/commonFuncs'
import {settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsAppColors} from '@/app.settings.js'
import {ref, onMounted, computed} from "vue";
import {useForm} from '@inertiajs/inertia-vue3';


import {Inertia} from '@inertiajs/inertia'
import axios from "axios";
import JetDropdown from '@/Jetstream/Dropdown.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from '@/Jetstream/Label.vue'

export default {
    props: {
        currency: {
            type: Object,
            required: true,
        },
        is_insert: {
            type: Boolean,
            required: true,
        }
    },


    name: 'CurrencyForm',
    components: {
        AdminLayout,
        VueFinalModal,
        ModalsContainer,
        ColorPicker,
        JetDropdown,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
    },
    setup(props) {
        let show_color_picker_modal = ref(false)
        let modal_picker_color_selected_value = ref('')
        let modal_picker_color_selected_type = ref('')

        let is_insert = ref(props.is_insert)

        let bgcolor_picker = ref(props.currency.bgcolor)
        let suckerCanvas = ref(null)
        let suckerArea = ref([])

        let formEditor = ref(useForm({
            id: is_insert.value ? '' : props.currency.id,
            name: is_insert.value ? 'name ' + new Date() : props.currency.name,
            num_code: is_insert.value ? '9' + (new Date().getSeconds()) : props.currency.num_code,
            char_code: is_insert.value ? '9' + (new Date().getSeconds()) : props.currency.char_code,
            bgcolor: is_insert.value ? '' : props.currency.bgcolor,
            color: is_insert.value ? '' : props.currency.color,
            is_top: is_insert.value ? false : (props.currency.is_top === 1 ? true : false),
            active: is_insert.value ? false : (props.currency.active === 1 ? true : false),
            ordering: is_insert.value ? '9' + (new Date().getSeconds()) : props.currency.ordering,
            created_at: is_insert.value ? '' : props.currency.created_at,
            updated_at: is_insert.value ? '' : props.currency.updated_at,
        }))

        let getFormEditorTitle = computed(() => {
            return is_insert.value ? 'Create new currency' : 'Edit currency'
        });
        let getSubmitBtnTitle = computed(() => {
            return is_insert.value ? 'Create' : 'Update'
        });

        let createdAtLabel = computed(() => {
            return momentDatetime(formEditor.value.created_at, settingsJsMomentDatetimeFormat)
        });
        let updatedAtLabel = computed(() => {
            return momentDatetime(formEditor.value.updated_at, settingsJsMomentDatetimeFormat)
        });

        let activeLabel = computed(() => {
            return getDictionaryLabel(formEditor.value.active ? 1 : 0, settingsCurrencyActiveLabels)
        });

        function cancelCurrencyEditor() {
            Inertia.visit(route('admin.currencies.index'), {method: 'get'});
        }

        function showColorPickerModal(type) {
            show_color_picker_modal.value = true
            modal_picker_color_selected_type.value = type
            if (type === 'color') {
                modal_picker_color_selected_value.value = formEditor.value.color
            } else {
                modal_picker_color_selected_value.value = formEditor.value.bgcolor
            }
        }

        function hideColorPickerModal() {
            modal_picker_color_selected_value.value = ''
            modal_picker_color_selected_type.value = ''
            show_color_picker_modal.value = false
        }

        function applyColorPickerModal() {
            if (modal_picker_color_selected_type.value === 'color') {
                formEditor.value.color = modal_picker_color_selected_value.value
            } else {
                formEditor.value.bgcolor = modal_picker_color_selected_value.value
            }
            show_color_picker_modal.value = false
        }

        function changeColor(color) {
            modal_picker_color_selected_value.value = color.hex
        }

        function openSucker(isOpen) {
            if (isOpen) {
                // ... canvas be created
                // this.suckerCanvas = canvas
                // this.suckerArea = [x1, y1, x2, y2]
            } else {
                // this.suckerCanvas && this.suckerCanvas.remove
            }
        }

        function isProxy(proxy) {
            return proxy == null ? false : !!proxy[Symbol.for("__isProxy")];
        }


        function saveCurrency() {
            if (is_insert.value) {
                formEditor.value.post(route('admin.currencies.store'), {
                    preserveScroll: true,
                    onError: (e) => {
                        console.log(e)
                        Toast.fire({
                            icon: 'error',
                            title: 'Adding currency error!'
                        })
                    }
                })
            } else {
                formEditor.value.patch(route('admin.currencies.update', formEditor.value.id/*, formEditor*/), {
                    preserveScroll: true,
                    onError: (e) => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Updating currency error!'
                        })
                    }
                })
            }
        } // saveCurrency() {

        function deleteCurrency() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to delete this currency with all related data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    formEditor.value.delete(route('admin.currencies.destroy', formEditor.value.id), {
                        preserveScroll: true,
                        onSuccess: (data) => {
                        }
                    })
                }
            })
        } // deleteCurrency() {


        function activateCurrency() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to activate this currency !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, activate it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(route('admin.currencies.activate', formEditor.value.id))
                        .then(({data}) => {
                            formEditor.value.active = data.currency.active
                            formEditor.value.updated_at = data.currency.updated_at
                            Swal.fire(
                                'CURRENCY STATUS!',
                                'Currency was successfully activated !',
                                'success'
                            )
                        })
                        .catch(e => {
                            console.error(e)
                        })
                }
            })

        } // function activateCurrency() {

        function deactivateCurrency() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to deactivate this currency !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, deactivate it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(route('admin.currencies.deactivate', formEditor.value.id))
                        .then(({data}) => {
                            formEditor.value.active = data.currency.active
                            formEditor.value.updated_at = data.currency.updated_at
                            Swal.fire(
                                'CURRENCY STATUS!',
                                'Currency was successfully deactivated !',
                                'success'
                            )
                        })
                        .catch(error => {
                            console.error(e)
                        })
                }
            })
        } // function deactivateCurrency() {

        function adminCurrencyFormOnMounted() {
        }

        onMounted(adminCurrencyFormOnMounted)

        return { // setup return
            // Listing Page state
            is_insert,
            formEditor,
            cancelCurrencyEditor,
            deleteCurrency,
            activateCurrency,
            deactivateCurrency,
            saveCurrency,
            activeLabel,

            // Color Picker
            bgcolor_picker,
            suckerCanvas,
            suckerArea,
            changeColor,
            openSucker,
            showColorPickerModal,

            hideColorPickerModal,
            applyColorPickerModal,

            show_color_picker_modal,
            modal_picker_color_selected_value,
            modal_picker_color_selected_type,

            getFormEditorTitle,
            getSubmitBtnTitle,
            createdAtLabel,
            updatedAtLabel,

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

