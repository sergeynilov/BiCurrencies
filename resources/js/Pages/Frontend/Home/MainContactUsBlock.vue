<template>

    <section v-show="main_page_contact_us_title && main_page_contact_us_title">
        <div class="container" v-if="!formEditor.processing">
            <div class="bg-holder rounded-2 z-index--1"
                 style="background-image:url(/images/cta-bg.png);background-position:center;background-size:cover;">
            </div>
            <!--/.bg-holder-->

            <div class="row justify-content-center p-6 p-xxl-7">
                <div class="col-12 col-lg-6 text-lg-start">
                    <h1 class="fw-bold mb-3 fs-4">{{ sanitizeHtml(main_page_contact_us_title) }}</h1>
                    <p class="pe-xxl-9">{{ sanitizeHtml(main_page_contact_us_text) }}</p>
                </div>
                <div class="col-12 col-lg-6 text-lg-end">
                    <a class="btn btn-primary" @click="showContactUsModal()"> Contact us</a>
                </div>
            </div>
        </div>
    </section>

    <vue-final-modal
        v-model="show_contact_us_modal"
        classes="frontend_modal_container"
        content-class="frontend_modal_content"
    >
        <div class="row flex-center frontend_modal_header">
            <div class="col-md-6 order-0">
                <div class="p-1 m-0 text-start">
                    <h5>
                        <i :class="getHeaderIcon('contact_us')" class="m-1 p-0 "
                           style="margin-bottom: -2px !important; "></i>Fill the form and Contact us
                    </h5>
                </div>
            </div>
            <div class="col-md-6 order-1">
                <p class=" p-1 m-0 text-end">
                    <button class="frontend_modal_close p-0" @click="hideContactUsModal">
                        x
                    </button>
                </p>
            </div>
        </div>

        <div class="content frontend_modal_content_editor_form frontend_modal_content_editor_form">
            <div class="block_2columns_md p-2"> <!-- modal_contact_us_title -->
                <div class="horiz_divider_left_13">
                    <jet-label for="title" value="Title:"/>
                </div>
                <div class="horiz_divider_right_23">
                    <jet-input id="title" type="text" class="form-control"
                               v-model="formEditor.title" placeholder="Enter title"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.title }"
                               autocomplete="off"/>
                    <div class="fs-error mb-3" v-if="formEditor.errors"
                         :class="{ 'd-block' : formEditor.errors && formEditor.errors.title}">
                        {{ formEditor.errors.title }}
                    </div>

                </div>
            </div> <!-- class="block_2columns_md" modal_contact_us_title -->
        </div>

        <div class="content frontend_modal_content_editor_form frontend_modal_content_editor_form">
            <div class="block_2columns_md p-2"> <!-- modal_contact_us_content_message -->
                <div class="horiz_divider_left_13">
                    <label for="modal_contact_us_content_message">Message content:</label>
                </div>
                <div class="horiz_divider_right_23">
                    <textarea rows="8" class="form-control" id="modal_contact_us_content_message"
                              v-model="formEditor.content_message"></textarea>
                    <div class="fs-error mb-3" v-if="formEditor.errors"
                         :class="{ 'd-block' : formEditor.errors && formEditor.errors.content_message}">
                        {{ formEditor.errors.content_message }}
                    </div>
                </div>
            </div> <!-- class="block_2columns_md" modal_contact_us_content_message -->
        </div>


        <div class="frontend_modal_footer d-flex flex-nowrap">
            <jet-button button_type="frontend_cancel" @click="hideContactUsModal" :disabled="formEditor.processing">
                <i :class="getHeaderIcon('cancel')" class="action_icon icon_right_text_margin"></i>Cancel
            </jet-button>

            <jet-button button_type="frontend_save" @click="sendContactUsModal"
                        :disabled="formEditor.processing">
                <i :class="getHeaderIcon('save')" class="action_icon icon_right_text_margin"></i>Send
            </jet-button>
            <div v-show="formEditor.processing" class="form_processing"></div>
        </div>

    </vue-final-modal>


</template>


<script>
import axios from 'axios'

import {getHeaderIcon, getErrorMessage, isEmpty, showRTE} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'

import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import {useForm} from "@inertiajs/inertia-vue3"
import {usePage} from '@inertiajs/inertia-vue3'
import * as sanitizeHtml from 'sanitize-html'

import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'

export default {
    name: 'MainContactUsBlock',
    components: {
        VueFinalModal,
        ModalsContainer,
        JetButton,
        JetInput,
        JetLabel,
    },
    setup(props) {

        let main_page_contact_us_title = ref('')
        let main_page_contact_us_text = ref('')

        let show_contact_us_modal = ref(false)
        let formEditor = ref(useForm({
            title: '',
            content_message: '',
        }))

        function loadMainContactUsData() {
            axios.get(route('frontend.get_block_cms_item', 'main_page_contact_us_block'))
                .then(({data}) => {
                    main_page_contact_us_title.value = data.cMSItem.title
                    main_page_contact_us_text.value = data.cMSItem.text
                })
                .catch(e => {
                    showRTE(e)
                    console.error(e)
                })
        } // loadMainContactUsData() {


        function showContactUsModal() {
            if (isEmpty(usePage().props.value.user)) {
                Toast.fire({
                    icon: "warning",
                    title: "You need to login at first !"
                })
                return
            }
            formEditor.value.errors = {}
            show_contact_us_modal.value = true
            formEditor.value.title = ''
            formEditor.value.content_message = ''
        }

        function hideContactUsModal() {
            show_contact_us_modal.value = false
            formEditor.value.title = ''
            formEditor.value.content_message = ''
        }

        function sendContactUsModal() {
            formEditor.value.post(route('frontend.store_contact_us'), {
                preserveScroll: true,
                onSuccess: (resp) => {
                    show_contact_us_modal.value = false
                    Toast.fire({
                        icon: 'success',
                        title: 'Your message was successfully sent. You will get feedback within next 24 hours !!'
                    })
                },
                onError: (e) => {
                    showRTE(e)
                    console.log(e)
                }
            })
        }

        function MainContactUsBlockOnMounted() {
            loadMainContactUsData()
            // showContactUsModal() // DEBUGGING
        } // MainContactUsBlockOnMounted() {

        onMounted(MainContactUsBlockOnMounted)

        return { // setup return
            //  Page state
            main_page_contact_us_title,
            main_page_contact_us_text,
            showContactUsModal,

            hideContactUsModal,
            sendContactUsModal,

            show_contact_us_modal,
            formEditor,


            // Page actions
            loadMainContactUsData,


            // Common methods
            getErrorMessage,
            getHeaderIcon,
            isEmpty,
            sanitizeHtml,
            showRTE
        }
    }, // setup() {

}
</script>

