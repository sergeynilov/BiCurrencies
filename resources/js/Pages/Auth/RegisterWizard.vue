<template>

    <frontend-layout>

        <section id="designIdeas">

            <div class="container">
                <div class="bg-holder  z-index--1" style="background-image:url(/images/design-concept-bg.png);background-position:center;background-size:cover;"></div>
                <!--/.bg-holder-->
                <div class="row" v-show="register_information_title && register_information_title">
                    <div class="col-md-6 p-7 px-lg-7">
                        <div class="col-12 py-3">
                            <h5 class="fw-bold fs-3 fs-lg-4 lh-sm mb-5">
                                Register at {{ settings_site_name }}<br>
                                <small>{{ settings_site_heading}}</small>
                            </h5>
                        </div>
                        <h5 class="fw-bold fs-3 fs-xxl-7">{{ sanitizeHtml(register_information_title) }}</h5>
                        <p class="pe-xl-9" >
                            {{ sanitizeHtml(register_information_text) }}
                        </p>
                    </div>

                    <div class="col-md-6 p-7 text-end">
                        <jet-application-logo :icon_type="'big'" layout="frontend" />
                    </div>

                </div>

                <div class="row" >

                    <label class="checkbox_container">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>

                    <label class="checkbox_container">Two
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                    <label class="checkbox_container">Three
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                    <label class="checkbox_container">Four
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                    <div class="col-md-12 px-7 px-lg-7">
                        <div class="col-12 py-3">
                            <h5 class="fw-bold fs-3 fs-lg-4 lh-sm mb-5">
                                <i :class="getHeaderIcon('register')" class="action_icon icon_right_text_margin" title="Open register user form"></i>
                                Fill your personal data
                            </h5>
                        </div>
                    </div>


                    <form @submit.prevent="SubmitRegisterForm">

                    <div class="content"
                         v-show="user_register_wizard_step === 1">
                        <!--            user_register_wizard_step::{{ user_register_wizard_step }}-->
                        <div class="block_2columns_md p-2"> <!-- user_register_name -->
                            <div class="horiz_divider_left_13">
                                <jet-label for="name" class="frontend_editable_label" value="Name:"/>
                            </div>
                            <div class="horiz_divider_right_23">
                                <jet-input id="name" type="text" class="form-control"
                                           v-model="formUserRegisterEditorStep1.name" placeholder="Currency descriptive name"
                                           :class="{ 'is-invalid' : formUserRegisterEditorStep1.errors && formUserRegisterEditorStep1.errors.name }"
                                           autocomplete="off"/>
                                <div class="fs-error mb-3" v-if="formUserRegisterEditorStep1.errors"
                                     :class="{ 'd-block' : formUserRegisterEditorStep1.errors && formUserRegisterEditorStep1.errors.name}">
                                    {{ formUserRegisterEditorStep1.errors.name }}
                                </div>
                            </div>
                        </div> <!-- class="block_2columns_md" user_register_name -->

                        <div class="block_2columns_md p-2"> <!-- user_register_email -->
                            <div class="horiz_divider_left_13">
<!--                                <label for="user_register_email">Email:</label>-->
                                <jet-label for="email" class="frontend_editable_label" value="Email:"/>
                            </div>
                            <div class="horiz_divider_right_23">
                                <jet-input id="email" type="text" class="form-control"
                                           v-model="formUserRegisterEditorStep1.email" placeholder="Valid email"
                                           :class="{ 'is-invalid' : formUserRegisterEditorStep1.errors && formUserRegisterEditorStep1.errors.email }"
                                           autocomplete="off"/>
                                <div class="fs-error mb-3" v-if="formUserRegisterEditorStep1.errors"
                                     :class="{ 'd-block' : formUserRegisterEditorStep1.errors && formUserRegisterEditorStep1.errors.email}">
                                    {{ formUserRegisterEditorStep1.errors.email }}
                                </div>
                            </div>
                        </div> <!-- class="block_2columns_md" user_register_email -->

                        <div class="block_2columns_md p-2"> <!-- user_register_password -->
                            <div class="horiz_divider_left_13">
                                <label for="user_register_password">Password:</label>
                            </div>
                            <div class="horiz_divider_right_23">
                                <jet-input id="user_register_password" type="text" class="form-control"
                                           v-model="formUserRegisterEditorStep1.password" placeholder="Must be at least 6 chars"
                                           :class="{ 'is-invalid' : formUserRegisterEditorStep1.errors && formUserRegisterEditorStep1.errors.password }"
                                           autocomplete="off"/>
                                <div class="fs-error mb-3" v-if="formUserRegisterEditorStep1.errors"
                                     :class="{ 'd-block' : formUserRegisterEditorStep1.errors && formUserRegisterEditorStep1.errors.password}">
                                    {{ formUserRegisterEditorStep1.errors.password }}
                                </div>
                            </div>
                        </div> <!-- class="block_2columns_md" user_register_password -->

                        <div class="block_2columns_md p-2"> <!-- user_register_password_2 -->
                            <div class="horiz_divider_left_13">
                                <label for="user_register_password_2">Confirm Password:</label>
                            </div>
                            <div class="horiz_divider_right_23">
                                <jet-input id="user_register_password_2" type="text" class="form-control"
                                           v-model="formUserRegisterEditorStep1.password_2" placeholder="Must be equal password"
                                           :class="{ 'is-invalid' : formUserRegisterEditorStep1.errors && formUserRegisterEditorStep1.errors.password_2 }"
                                           autocomplete="off"/>
                                <div class="fs-error mb-3" v-if="formUserRegisterEditorStep1.errors"
                                     :class="{ 'd-block' : formUserRegisterEditorStep1.errors && formUserRegisterEditorStep1.errors.password_2}">
                                    {{ formUserRegisterEditorStep1.errors.password_2 }}
                                </div>
                            </div>
                        </div> <!-- class="block_2columns_md" user_register_password_2 -->

                    </div>

                    <div class="content"
                         v-show="user_register_wizard_step === 2">
                        <div class="block_2columns_md p-2"> <!-- user_register_confirmation_code -->
                            <div class="horiz_divider_left_13">
                                <label for="confirmation_code">Confirmation code:</label>
                            </div>
                            <div class="horiz_divider_right_23">
                                <jet-input id="confirmation_code" type="text" class="form-control"
                                           v-model="formUserRegisterEditorStep2.confirmation_code" placeholder="Get confirmation code from email"
                                           :class="{ 'is-invalid' : formUserRegisterEditorStep2.errors && formUserRegisterEditorStep2.errors.confirmation_code }"
                                           autocomplete="off"/>
                                <div class="fs-error mb-3" v-if="formUserRegisterEditorStep2.errors"
                                     :class="{ 'd-block' : formUserRegisterEditorStep2.errors && formUserRegisterEditorStep2.errors.confirmation_code}">
                                    {{ formUserRegisterEditorStep2.errors.confirmation_code }}
                                </div>
                            </div>
                        </div> <!-- class="block_2columns_md" user_register_confirmation_code -->

                    </div>

                    <div class="content p-2"
                         v-show="user_register_wizard_step === 3">
                        <!--            user_register_wizard_step::{{ user_register_wizard_step }}-->

                        <h5>
                            Select avatar
                            <small>&nbsp;&nbsp;You can skip this step</small>
                        </h5>

                        <FileUploaderPreviewer
                            :imageUploader="userRegisterAvatarUploader"
                            :image_url="''"
                            :image_info="''"
                            :parent_component_key="'register'"
                            :layout="'frontend'"
                            :show_bottom_info_text="true"
                        ></FileUploaderPreviewer>

                    </div>
                    <!-- v-show="user_register_wizard_step === 3" -->

                    <div class="content"
                         v-show="user_register_wizard_step === 4">
                        <ul class="frontend_ul">
                            <li v-for="(nextCurrencyForSubscription, index) in currenciesForSubscription" :key="index">
                                <div class="row flex-center p-0 m-0 w-100 ">
                                    <div class="col-md-12">
                                        <div class="p-1 m-0 text-start">
                                            <jet-checkbox :id="'currency_for_subscription_'+ nextCurrencyForSubscription.id " v-model:checked="nextCurrencyForSubscription.is_selected" class="ml-4 custom-control-input"/>
                                            <label class="admin_editable_label custom-control-label mx-2" :for="'currency_for_subscription_'+ nextCurrencyForSubscription.id">
                                                {{ nextCurrencyForSubscription.name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="row_content_right_aligned" v-show="1">
                            <jet-button button_type="frontend_cancel" @click="hideUserRegister">
                                <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
                            </jet-button>
                            <jet-button  button_type="frontend_save"  @click.prevent="saveCurrenciesForSubscription()">
                                <i :class="getHeaderIcon('save')" class="action_icon icon_right_text_margin"></i>Save
                            </jet-button>
                            <div v-show="currencies_for_subscription_is_saving" class="form_processing"></div>
                        </div>
                        <p class="text-sm text-info p-2">
                            <i :class="getHeaderIcon('info')" class="icon_right_text_margin"></i>
                            You will get daily rate emails for selected currency(ies)
                        </p>
                        <jet-section-border></jet-section-border>


                    </div>

                    <div class="frontend_footer d-flex flex-nowrap">
                            <jet-button button_type="frontend_cancel" @click="hideUserRegister" :disabled="formUserRegisterEditorStep1.processing" v-show="user_register_wizard_step === 1">
                                <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
                            </jet-button>

                            <jet-button  button_type="frontend_save"  @click.prevent="submitRegisterForm()"  :disabled="formUserRegisterEditorStep1.processing" v-show="user_register_wizard_step === 1">
                                <i :class="getHeaderIcon('save')" class="action_icon icon_right_text_margin"></i>Register
                            </jet-button>
                            <div v-show="formUserRegisterEditorStep1.processing" class="form_processing"></div>

                        <jet-button button_type="frontend_cancel" @click="hideUserRegister" :disabled="formUserRegisterEditorStep2.processing" v-show="user_register_wizard_step === 2">
                            <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
                        </jet-button>

                        <jet-button  button_type="frontend_save" @click.prevent="sendUserRegisterStep2ConfirmationCode()"  :disabled="formUserRegisterEditorStep2.processing" v-show="user_register_wizard_step === 2">
                            <i :class="getHeaderIcon('save')" class="action_icon icon_right_text_margin"></i>Confirm
                        </jet-button>
                        <div v-show="formUserRegisterEditorStep2.processing" class="form_processing"></div>


                        <jet-button button_type="frontend_cancel" @click="hideUserRegister" :disabled="userRegisterAvatarUploader.processing" v-show="user_register_wizard_step === 3">
                            <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
                        </jet-button>

                        <jet-button  button_type="frontend_save" @click.prevent="nextUserRegisterStep(4)"  :disabled="userRegisterAvatarUploader.processing" v-show="user_register_wizard_step === 3">
                            <i :class="getHeaderIcon('save')" class="action_icon icon_right_text_margin"></i>Next
                        </jet-button>
                        <div v-show="userRegisterAvatarUploader.processing" class="form_processing"></div>

                        <jet-button  button_type="frontend_save" @click.prevent="readyUserRegister()"  :disabled="currenciesForSubscription.processing" v-show="user_register_wizard_step === 4">
                            <i :class="getHeaderIcon('save')" class="action_icon icon_right_text_margin"></i>Ready
                        </jet-button>
                        <div v-show="currenciesForSubscription.processing" class="form_processing"></div>

                    </div>
                    </form>
                </div>

            </div>
        </section>

    </frontend-layout>


</template>

<script>
import FrontendLayout from '@/Layouts/FrontendLayout'
import axios from 'axios'

import {
    getHeaderIcon,
    pluralize,
    pluralize3,
    momentDatetime,
    getErrorMessage,
    getDictionaryLabel,
    concatStr,
    showRTE
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'
import * as sanitizeHtml from 'sanitize-html'

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels, settingsAppColors
} from '@/app.settings.js'
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import FileUploaderPreviewer from '@/components/FileUploaderPreviewer.vue'

import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from '@/Jetstream/Label.vue'
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'

import {Inertia} from "@inertiajs/inertia";

export default {
    props: {
        user_register_wizard_step: {
            type: Number,
            required: true,
        },
        new_registered_user_id: {
            type: Number,
            required: false,
            default:null
        },
        new_registered_user_email: {
            type: String,
            required: false,
            default:null
        },
    },

    name: 'RegisterWizard',

    components: {
        FrontendLayout,
        FileUploaderPreviewer,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetSectionBorder,
        JetApplicationLogo
    },

    setup(props, attrs) {
        console.log('RegisterWizard props::')
        console.log(props)
        console.log('RegisterWizard attrs::')
        console.log(attrs)
        // debugger
        let settings_site_name = ref('')
        let settings_site_heading = ref('')
        /*                                 Register at {{ settings_site_name }}<br>
                                <small>{{ settings_site_heading}}</small>
 */
        let register_information_title = ref('')
        let register_information_text = ref('')

        let user_register_wizard_step = ref(props.user_register_wizard_step)
        let formUserRegisterEditorStep1 = ref(useForm({
            id: null,
            name: 'demo_user',
            email: 'demo_user@site.com',
            password: 'de1mo_u2se3r',
            password_2: 'de1mo_u2se3r',
        }))
        let new_registered_user_id = ref(props.new_registered_user_id)
        let new_registered_user_email = ref(props.new_registered_user_email)

        let formUserRegisterEditorStep2 = ref(useForm({
            confirmation_code: '',
            user_email: '',
            user_id: '',
        }))

        let userRegisterAvatarUploader = ref(useForm({
            image: '',
            user_id: null,
            user_email: null,
            image_filename: '',
        }))


        let currenciesForSubscription = ref([])
        let currencies_for_subscription_is_saving = ref(false)

        function hideUserRegister() {
            console.log('hideUserRegisterModal::')
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to reset you registration!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    user_register_wizard_step.value = 1
                    Inertia.visit(route('reset_user_register', new_registered_user_id.value), {method: 'get'});
                }
            })

        }

        function submitRegisterForm() {
            console.log('SubmitRegisterForm value::')

            console.log('formUserRegisterEditorStep1::')
            console.log(formUserRegisterEditorStep1)

            formUserRegisterEditorStep1.value.post(route('user_register_step_1'), {
                preserveScroll: true,
                onSuccess: (resp) => {
                    console.log('submitRegisterForm resp::')
                    console.log(resp)
                    user_register_wizard_step.value = 2 // Open next step form

                    formUserRegisterEditorStep1.value.id = resp.props.new_user_id // Pass parameter next steps form
                    formUserRegisterEditorStep2.value.user_email = formUserRegisterEditorStep1.value.email
                    formUserRegisterEditorStep2.value.user_id = resp.props.new_user_id
                    userRegisterAvatarUploader.value.user_id = resp.props.new_user_id
                    userRegisterAvatarUploader.value.user_email = resp.props.new_user_email

                    new_registered_user_id.value = resp.props.new_registered_user_id
                    console.log('new_registered_user_id.value::')
                    console.log(new_registered_user_id.value)

                    new_registered_user_email.value = resp.props.new_registered_user_email
                },
                onError: (e) => {
                    console.error(e)
                    showRTE(e)
                }
            })
        } // SubmitRegisterForm() {

        function sendUserRegisterStep2ConfirmationCode() {
            console.log('sendUserRegisterStep2ConfirmationCode route(\'user_register_step_confirmation_code\')::')
            console.log(route('user_register_step_confirmation_code'))
            console.log('formUserRegisterEditorStep2::')
            console.log(formUserRegisterEditorStep2)

            console.log('formUserRegisterEditorStep2.value.user_id::')
            console.log(formUserRegisterEditorStep2.value.user_id)
            formUserRegisterEditorStep2.value.user_id = new_registered_user_id.value
            formUserRegisterEditorStep2.value.user_email = new_registered_user_email.value

            formUserRegisterEditorStep2.value.post(route('user_register_step_confirmation_code'), {
                preserveScroll: false,
                onSuccess: (resp) => {
                    console.log('sendUserRegisterStep2ConfirmationCode resp::')
                    console.log(resp)

                    // hideUserRegister()
                    user_register_wizard_step.value = 3
                    loadCurrencySubscriptionSelection()
                    Toast.fire({
                        icon: 'success',
                        title: 'Your account was activated successfully. On next step you can fill more detailed information.'
                    })
                },
                onError: (e) => {
                    console.log(e)
                    showRTE(e)
                }
            })
        } // sendUserRegisterStep2ConfirmationCode

        function readyRegisteredUserStepSubscriptions() {
            console.log('readyRegisteredUserStepSubscriptions::')

            user_register_wizard_step.value = 1
            Inertia.visit(route('home'), {method: 'get'});

            Toast.fire({
                icon: 'success',
                title: 'You registered successfully! Now you can login into personal area of your account of our site'
            })
        }


        function fetchUserRegisterAvatarImage(userRegisterAvatarFile) {
            console.log('fetchUserRegisterAvatarImage userRegisterAvatarFile::')
            console.log(userRegisterAvatarFile)

            fetch(userRegisterAvatarFile.blob).then(function (response) {
                if (response.ok) {
                    return response.blob().then(function (imageBlob) {
                        console.log('userRegisterAvatarUploader::')
                        console.log(userRegisterAvatarUploader)

                        userRegisterAvatarUploader.value.user_id = new_registered_user_id.value
                        userRegisterAvatarUploader.value.user_email = new_registered_user_email.value

                        userRegisterAvatarUploader.value.image = imageBlob
                        userRegisterAvatarUploader.value.image_filename = userRegisterAvatarFile.name

                        userRegisterAvatarUploader.value.post(route('register_step_upload_avatar'), {
                            preserveScroll: false,
                            onSuccess: (resp) => {
                                console.log('fetchUserRegisterAvatarImage resp::')
                                console.log(resp)
                                Toast.fire({
                                    icon: 'success',
                                    title: 'You have uploaded your avatar successfully'
                                })
                                window.emitter.emit('imageBlobFetchedEvent', {
                                    parent_component_key: 'register',
                                    resp: resp,
                                })
                                user_register_wizard_step.value = 4
                            },
                            onError: (e) => {
                                console.log(e)
                                showRTE(e)
                            }
                        })
                    })
                } else {
                    return response.json().then(function (jsonError) {
                        showRTE(jsonError)
                        console.error(jsonError)
                    })
                }
            }).catch(function (e) {
                console.error(e)
                showRTE(e)
            }) // fetch(userRegisterAvatarFile.blob).then(function (response) {

        }

        function loadCurrencySubscriptionSelection() {
            axios.get(route('frontend.load_currency_subscription_selection'))
                .then(({data}) => {
                    console.log('loadCurrencySubscriptionSelection data::')
                    console.log(data)
                    currenciesForSubscription.value = data.currencies
                })
                .catch(e => {
                    console.error(e)
                    showRTE(e)
                })
        } // loadCurrencySubscriptionSelection() {


        function saveCurrenciesForSubscription() {
            console.log('saveCurrenciesForSubscription currenciesForSubscription::')
            console.log(currenciesForSubscription.value)
            let selectedCurrencies= []
            let l= currenciesForSubscription.value.length
            for (let i=0; i< l; i++) {
                if (currenciesForSubscription.value[i].is_selected) {
                    selectedCurrencies.push(currenciesForSubscription.value[i].id)
                }
            }
            console.log('selectedCurrencies::')
            console.log(selectedCurrencies)

            if (selectedCurrencies.length === 0) {
                Toast.fire({
                    icon: "warning",
                    title: "You need to select at least 1 currency !"
                })
                return
            }

            currencies_for_subscription_is_saving.value =  true
            axios.post(route('save_user_register_currency_subscriptions'), { user_id: new_registered_user_id.value, selectedCurrencies:selectedCurrencies})
                .then(({data}) => {
                    console.log('+data::')
                    console.log(data)
                    Toast.fire({
                        icon: 'success',
                        title: 'You successfully saved your currency subscriptions !'
                    })
                    for (let i=0; i< l; i++) {
                        currenciesForSubscription.value[i].is_selected= false
                    }
                    currencies_for_subscription_is_saving.value =  false
                })
                .catch(e => {
                    console.error(e)
                    showRTE(e)
                })
        } // function saveCurrenciesForSubscription() {

        function nextUserRegisterStep(step) {
            console.log('nextUserRegisterStep step::')
            console.log(step)
            user_register_wizard_step.value = step
        }

        function readyUserRegister() {
            console.log('readyUserRegister::')
            user_register_wizard_step.value = 1

            Toast.fire({
                icon: 'success',
                title: 'Your account was activated successfully. You can enter your personal area.'
            })

        }

        function loadMainRegisterInformationData() {
            axios.get(route('frontend.get_block_cms_item', 'register_information_block'))
                .then(({data}) => {
                    register_information_title.value = data.cMSItem.title
                    register_information_text.value = data.cMSItem.text
                })
                .catch(e => {
                    console.error(e)
                    showRTE(e)
                })
        } // loadMainRegisterInformationData() {


        function registerWizardPageOnMounted() {
            console.log('registerWizardPageOnMounted::')

            axios.get(route('get_settings_value', {key: 'site_name'}))
                .then(({data}) => {
                    settings_site_name.value = data.value
                })
                .catch(e => {
                    console.error(e)
                })
            axios.get(route('get_settings_value', {key: 'site_heading'}))
                .then(({data}) => {
                    settings_site_heading.value = data.value
                })
                .catch(e => {
                    console.error(e)
                })

            loadMainRegisterInformationData()
            window.emitter.on('FileUploaderPreviewerUploadImageEvent', params => {
                console.log('TARGET FileUploaderPreviewerUploadImageEvent params::')
                console.log(params)
                if (params.parent_component_key === 'register') {
                    fetchUserRegisterAvatarImage(params.uploadedImageFile)
                }
            })


        }
        onMounted(registerWizardPageOnMounted)

        return { // setup return
            // Listing Page state
            register_information_title,
            register_information_text,

            user_register_wizard_step,
            loadMainRegisterInformationData,
            formUserRegisterEditorStep1,
            submitRegisterForm,
            sendUserRegisterStep2ConfirmationCode,
            hideUserRegister,
            readyRegisteredUserStepSubscriptions,

            new_registered_user_id,
            new_registered_user_email,
            formUserRegisterEditorStep2,
            userRegisterAvatarUploader,
            nextUserRegisterStep,
            readyUserRegister,
            settings_site_name,
            settings_site_heading,
            currencies_for_subscription_is_saving,
            currenciesForSubscription,
            loadCurrencySubscriptionSelection,
            saveCurrenciesForSubscription,

            // Page actions

            // Settings vars
            settingsJsMomentDatetimeFormat,

            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            getHeaderIcon,
            getDictionaryLabel,
            concatStr,
            sanitizeHtml,
            showRTE
        }
    }, // setup() {

}
</script>

<style>

/* Hide the browser's default checkbox */
.checkbox_container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.checkbox_container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.checkbox_container input:checked ~ .checkmark {
    background-color: #2196F3;
}
</style>
