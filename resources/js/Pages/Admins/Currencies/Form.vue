<template>
    <div v-if="!formEditor.processing">
        <!--        is_insert::{{ is_insert }}<br>-->
        <!--        formEditor.errors::{{ formEditor.errors }}<br>-->
        <!--        formEditor::{{ formEditor }}<br>-->

        <div class="card-header">
            <h3 class="card-title">{{ getFormEditorTitle }}</h3>
        </div> <!-- card-title -->

<!--        show_color_picker_modal::{{ show_color_picker_modal }}<br>-->
<!--        modal_picker_color_selected_value::{{ modal_picker_color_selected_value }}<br>-->
        <form @submit.prevent="saveCurrency">

            <div class="card-body p-0">


                <div class="block_2columns_md p-2" v-if="!is_insert"> <!-- id -->
                    <div class="horiz_divider_left_13">
                        <label for="id">Id:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="id" disabled
                               v-model="formEditor.id">
                    </div>
                </div> <!-- class="block_2columns_md" id -->


                <div class="block_2columns_md p-2"> <!-- name -->
                    <div class="horiz_divider_left_13">
                        <label for="name">Currency Name:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="name"
                               placeholder="Currency descriptive name" v-model="formEditor.name"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.name }"
                               autofocus="autofocus" autocomplete="off">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.name}">
                            {{ formEditor.errors.name }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" name -->


                <div class="block_2columns_md p-2"> <!-- num_code -->
                    <div class="horiz_divider_left_13">
                        <label for="num_code">Number code:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="num_code"
                               placeholder="Valid integer value " v-model="formEditor.num_code"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.num_code }"
                               autofocus="autofocus" autocomplete="off" maxlength="3">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.num_code}">
                            {{ formEditor.errors.num_code }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" num_code -->


                <div class="block_2columns_md p-2"> <!-- char_code -->
                    <div class="horiz_divider_left_13">
                        <label for="char_code">Char code:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="char_code"
                               placeholder="Uppercase 3 chars code" v-model="formEditor.char_code"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.char_code }"
                               autofocus="autofocus" autocomplete="off" maxlength="3">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.char_code}">
                            {{ formEditor.errors.char_code }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" char_code -->

                <div class="block_2columns_md p-2"> <!-- color -->
                    <div class="horiz_divider_left_13">
                        <label for="btn_color">Color:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <button type="button" class="btn btn-secondary btn-xs mt-1"
                                @click="showColorPickerModal('color')" id="btn_color">
                            <i :class="getHeaderIcon('color')" class="mr-1"></i>Select Color
                        </button>
                        <p class="text-sm p-0" :style="{color: formEditor.color}">
                            <i :class="getHeaderIcon('info')" class="mr-1"></i>
                            Current color : {{ formEditor.color }}
                        </p>
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.color}">
                            {{ formEditor.errors.color }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" color -->


                <div class="block_2columns_md p-2"> <!-- bgcolor -->
                    <div class="horiz_divider_left_13">
                        <label for="btn_bgcolor">Background color:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <!--                        <div :style="{background: bgcolor_picker}">-->
                        <button type="button" class="btn btn-secondary btn-xs mt-1"
                                @click="showColorPickerModal('bgcolor')" id="btn_bgcolor">
                            <i :class="getHeaderIcon('color')" class="mr-1"></i>Select Color
                        </button>
                        <p class="text-sm p-0" :style="{background: formEditor.bgcolor}">
                            <i :class="getHeaderIcon('info')" class="mr-1"></i>
                            Current color : {{ formEditor.bgcolor }}
                        </p>
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.bgcolor}">
                            {{ formEditor.errors.bgcolor }}
                        </div>
                        <!--                        </div>-->
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.bgcolor}">
                            {{ formEditor.errors.bgcolor }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" bgcolor -->


                <div class="block_2columns_md p-2"> <!-- is_top -->
                    <div class="horiz_divider_left_13">
                        <label for="name">Is top:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="checkbox" id="is_top" v-model="formEditor.is_top" :checked="formEditor.is_top"
                               class="ml-1">
                    </div>
                </div> <!-- class="block_2columns_md" is_top -->

                <div class="block_2columns_md p-2"> <!-- active -->
                    <div class="horiz_divider_left_13">
                        <label for="name">Active:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="checkbox" id="active" v-model="formEditor.active" :checked="formEditor.active"
                               value="1" class="ml-1">
                    </div>
                </div> <!-- class="block_2columns_md" active -->

                <div class="block_2columns_md p-2"> <!-- ordering -->
                    <div class="horiz_divider_left_13">
                        <label for="ordering">Ordering:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="ordering"
                               placeholder="Valid integer value" v-model="formEditor.ordering"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.ordering }"
                               autofocus="autofocus" autocomplete="off">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.ordering}">
                            {{ formEditor.errors.ordering }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" ordering -->

                <div class="block_2columns_md p-2" v-if="!is_insert"> <!-- created_at -->
                    <div class="horiz_divider_left_13">
                        <label for="created_at">Created:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="created_at" disabled v-model="createdAtLabel">
                    </div>
                </div> <!-- class="block_2columns_md" created_at -->

                <div class="block_2columns_md p-2" v-if="!is_insert && formEditor.updated_at">
                    <!-- created_at -->
                    <div class="horiz_divider_left_13">
                        <label for="updated_at">Updated:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="updated_at" disabled v-model="updatedAtLabel">
                    </div>
                </div> <!-- class="block_2columns_md" updated_at -->
            </div>

            <div class="card-footer clearfix flex">
                <button type="button" class="btn btn-secondary btn-xs mt-1"
                        @click="cancelCurrencyEditor">
                    <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
                </button>
                <button type="submit" class="btn btn-success btn-sm text-uppercase ml-4">
                    <i :class="getHeaderIcon('save')" class="mr-1"></i>{{ getSubmitBtnTitle }}
                </button>
                <button type="button" class="btn btn-sm btn_remove_right_aligned  mt-1" @click="deleteCurrency()"
                        v-if="!is_insert">
                    <i :class="getHeaderIcon('remove')" class="mr-1" title="Delete currency"></i>Delete
                </button>
            </div>

        </form>
    </div>

    <vue-final-modal
        v-model="show_color_picker_modal"
        classes="currencies_modal_container"
        content-class="currencies_modal_content"
    >
        <h5 class="currencies_modal_header m-0 m-0">
            <i :class="getHeaderIcon('color')" class="mr-2"></i>Select color
        </h5>

        <div class="content currencies_modal_content_editor_form ">
            <div :style="{background: modal_picker_color_selected_value}">

<!--                modal_picker_color_selected_value::{{ modal_picker_color_selected_value }}<br>-->
<!--                modal_picker_color_selected_type::{{ modal_picker_color_selected_type }}<br>-->
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
        <button class="currencies_modal_close m-0 mt-3 mr-2" @click="hideColorPickerModal">
            x
        </button>

        <div class="currencies_modal_footer">
            <button type="button" class="btn btn-secondary btn-xs mt-1"
                    @click="hideColorPickerModal">
                <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
            </button>
            <button type="button" class="btn btn-success btn-sm text-uppercase ml-4" @click="applyColorPickerModal">
                <i :class="getHeaderIcon('save')" class="mr-1"></i>Apply
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
import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'
import {ref, onMounted, computed} from "vue";
import {useForm} from '@inertiajs/inertia-vue3';


import {Inertia} from '@inertiajs/inertia'

export default {
    props: ['currency', 'is_insert'],

    name: 'CurrencyForm',
    components: {
        AdminLayout,
        VueFinalModal,
        ModalsContainer,
        ColorPicker
    },
    setup(props) {
        // let currency = ref(props.currency)
        // console.log('CurrencyForm Inertia::')
        // console.log(Inertia) // I got "ReferenceError: $inertia is not defined error" here

        // const formEditor = ref( form )
        const show_color_picker_modal = ref(false)
        const modal_picker_color_selected_value = ref('')
        const modal_picker_color_selected_type = ref('')

        const is_insert = ref(props.is_insert)

        const bgcolor_picker = ref(props.currency.bgcolor)
        const suckerCanvas = ref(null)
        const suckerArea = ref([])
        // let formEditor = null

        const formEditor = ref(useForm({
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

        // const pureColor = ref<ColorInputWithoutInstance>("red");
        // const gradientColor = ref("linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 1) 100%)");

        // console.log("END SETUP formEditor::")
        // console.log(formEditor)

        const getFormEditorTitle = computed(() => {
            return is_insert.value ? 'Create new currency' : 'Edit currency'
        });
        const getSubmitBtnTitle = computed(() => {
            return is_insert.value ? 'Create' : 'Update'
        });

        const createdAtLabel = computed(() => {
            return momentDatetime(formEditor.value.created_at, settingsJsMomentDatetimeFormat)
        });
        const updatedAtLabel = computed(() => {
            return momentDatetime(formEditor.value.updated_at, settingsJsMomentDatetimeFormat)
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
            // console.log('hideColorPickerModal::')
            modal_picker_color_selected_value.value = ''
            modal_picker_color_selected_type.value = ''
            show_color_picker_modal.value = false
        }

        function applyColorPickerModal() {
            // console.log('applyColorPickerModal modal_picker_color_selected_type.value::')
            // console.log(modal_picker_color_selected_type.value)
            if (modal_picker_color_selected_type.value === 'color') {
                formEditor.value.color = modal_picker_color_selected_value.value
            } else {
                formEditor.value.bgcolor = modal_picker_color_selected_value.value
            }
            show_color_picker_modal.value = false
        }

        function changeBgColor(color) {
            // console.log('changeBgColor color::')
            // console.log(color)
            formEditor.value.bgcolor = color.hex
        }

        function changeColor(color) {
            // console.log('changeColor color::')
            // console.log(color)
            modal_picker_color_selected_value.value = color.hex
        }

        function openSucker(isOpen) {
            // console.log('openSucker  isOpen::')
            // console.log(isOpen)
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
            console.log('saveCurrency is_insert.value::')
            console.log(is_insert.value)

            console.log('formEditor::')
            console.log(formEditor)

            if (is_insert.value) {
                formEditor.value.post(route('admin.currencies.store'), {
                    preserveScroll: true,
                    // onSuccess: (resp) => {
                    //     console.log('POSTED resp::')
                    //     console.log(resp)
                    // },
                    onError: (e) => {
                        console.log(e)
                        Toast.fire({
                            icon: 'error',
                            title: 'Adding currency error!'
                        })
                    }
                })
            } else {
                console.log('formEditor::')
                console.log(formEditor)

                formEditor.value.patch(route('admin.currencies.update', formEditor.value.id/*, formEditor*/), {
                    preserveScroll: true,
                    // onSuccess: (resp) => {
                    //     console.log('UPDATED resp::')
                    //     console.log(resp)
                    // },
                    onError: (e) => {
                        Toast.fire({
                            icon: 'error',
                            // title: 'Currency updating error : ' + getErrorMessage(e)
                            title: 'Updating currency error!'
                        })
                    }

                })
            }
        } // saveCurrency() {

        const adminCurrencyFormOnMounted = async () => {
            console.log('Form.vue adminCurrencyFormOnMounted 1 is_insert.value')
            console.log(is_insert.value)
        }
        onMounted(adminCurrencyFormOnMounted)

        return { // setup return
            // Listing Page state
            is_insert,
            formEditor,
            cancelCurrencyEditor,
            saveCurrency,
            // pureColor, gradientColor,

            // Color Picker
            bgcolor_picker,
            suckerCanvas,
            suckerArea,
            changeColor,
            changeBgColor,
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

<style>
.hu-color-picker {
    padding: 10px;
    background: #1d2024;
    border-radius: 4px;
    box-shadow: 0 0 16px 0 rgba(0, 0, 0, .16);
    z-index: 1
}

.hu-color-picker.light {
    background: #f7f8f9
}

.hu-color-picker.light .color-show .sucker {
    background: #eceef0
}

.hu-color-picker.light .color-type .name {
    background: #e7e8e9
}

.hu-color-picker.light .color-type .value {
    color: #666;
    background: #eceef0
}

.hu-color-picker.light .colors.history {
    border-top: 1px solid #eee
}

.hu-color-picker canvas {
    vertical-align: top
}

.hu-color-picker .color-set {
    display: flex
}

.hu-color-picker .color-show {
    margin-top: 8px;
    display: flex
}

.saturation {
    position: relative;
    cursor: pointer
}

.saturation .slide {
    position: absolute;
    left: 100px;
    top: 0;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 1px solid #fff;
    box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    pointer-events: none
}

.color-alpha {
    position: relative;
    margin-left: 8px;
    cursor: pointer
}

.color-alpha .slide {
    position: absolute;
    left: 0;
    top: 100px;
    width: 100%;
    height: 4px;
    background: #fff;
    box-shadow: 0 0 1px 0 rgba(0, 0, 0, .3);
    pointer-events: none
}

.sucker {
    width: 30px;
    fill: #9099a4;
    background: #2e333a;
    cursor: pointer;
    transition: all .3s
}

.sucker.active, .sucker:hover {
    fill: #1593ff
}

.hue {
    position: relative;
    margin-left: 8px;
    cursor: pointer
}

.hue .slide {
    position: absolute;
    left: 0;
    top: 100px;
    width: 100%;
    height: 4px;
    background: #fff;
    box-shadow: 0 0 1px 0 rgba(0, 0, 0, .3);
    pointer-events: none
}

.colors {
    padding: 0;
    margin: 0
}

.colors.history {
    margin-top: 10px;
    border-top: 1px solid #2e333a
}

.colors .item {
    position: relative;
    width: 16px;
    height: 16px;
    margin: 10px 0 0 10px;
    border-radius: 3px;
    box-sizing: border-box;
    vertical-align: top;
    display: inline-block;
    transition: all .1s;
    cursor: pointer
}

.colors .item:nth-child(8n+1) {
    margin-left: 0
}

.colors .item:hover {
    transform: scale(1.4)
}

.colors .item .alpha {
    height: 100%;
    border-radius: 4px
}

.colors .item .color {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    border-radius: 3px
}

.color-type {
    display: flex;
    margin-top: 8px;
    font-size: 12px
}

.color-type .name {
    width: 60px;
    height: 30px;
    float: left;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #999;
    background: #252930
}

.color-type .value {
    flex: 1;
    height: 30px;
    min-width: 100px;
    padding: 0 12px;
    border: 0;
    color: #fff;
    background: #2e333a;
    box-sizing: border-box
}

.currencies_modal_container {
    display: flex;
    justify-content: center;
    align-items: center;
    /*background-color: #343A40;*/
    /*background-color: olive !important;*/
}

.currencies_modal_header {
    background-color: #0f6d7c;
    color: $ text-color;
    /*border-bottom: 2px solid rgba(123,123,123);*/
    border-bottom: 1px solid $ text-color;
    /*padding: 0;*/
    padding: 0.5rem 0.5rem;
    margin: 0;
    position: relative;
    /*border-top-left-radius: 0.5rem;*/
    /*border-top-right-radius: 0.5rem;*/
}

.currencies_modal_footer {
    /*border-top: 1px solid white;*/
    padding: 0.8rem;
    /*background-color: yellow;*/
}

.currencies_modal_content {
    position: relative;
    width: 50%;

    margin-left: 4px;
    min-height: 360px;
    /*max-height: 360px;*/
    padding: 0;
    overflow: auto;
    /*background-color: red !important;*/
    background-color: #343A40 !important;
    /*border-radius: 4px;*/

    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
    box-shadow: inset 0 0 0 transparent !important;
    /*border: 2px dotted yellow !important;*/


    /*height: 100%;*/
    /*//////////*/
    display: flex;
    flex-direction: column;

    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */

    background: rgba(255, 255, 255, .1);

}

/* Medium ≥768px  ipad or ipad mini */
@media only screen and (min-width: 768px) and (max-width: 991px) {
    /* Ipad Pro md */
    .currencies_modal_content {
        min-height: 500px;
        /*background-color: yellow !important;*/
    }
}

.currencies_modal_close {
    background-color: #0f6d7c;
    color: $ text-color !important;
    position: absolute;
    top: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 24px;
    height: 24px;
    /*margin: 4px 4px 0 0;*/
    cursor: pointer;
}

.currencies_modal_close::hover {
    color: $ text-color !important;
    background-color: #0f6d7c;
}


.currencies_modal_content_editor_form {
    margin-top: 0.7rem;
    flex: 1; /* same as flex: 1 1 auto; */
    background-color: #343A40;
}

</style>
