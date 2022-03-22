<template>

    <section>
        <!--                show_contact_us_modal::{{ show_contact_us_modal }}<br>-->
        <div class="container" v-if="!formEditor.processing">
            <div class="bg-holder rounded-2 z-index--1"
                 style="background-image:url(/assets/img/gallery/cta-bg.png);background-position:center;background-size:cover;">
            </div>
            <!--/.bg-holder-->

            <!--            main_page_contact_us_title,-->
            <!--            main_page_contact_us_text,-->

            <div class="row justify-content-center p-6 p-xxl-7">
                <div class="col-12 col-lg-6 text-lg-start">
                    <h1 class="fw-bold mb-3 fs-4">{{ main_page_contact_us_title }}</h1>
                    <p class="pe-xxl-9">{{ main_page_contact_us_text }}</p>
                </div>
                <div class="col-12 col-lg-6 text-lg-end">
                    <a class="btn btn-primary" @click="showContactUsModal()"> Contact us</a>
                </div>
            </div>
        </div>
    </section>

    <vue-final-modal
        v-model="show_contact_us_modal"
        classes="contact_us_modal_container"
        content-class="contact_us_modal_content"
    >
        <div class="row flex-center contact_us_modal_header">
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
                    <button class="contact_us_modal_close p-0" @click="hideContactUsModal">
                        x
                    </button>
                </p>
            </div>
        </div>

        <div class="content contact_us_modal_content_editor_form p-0 m-0">
            <div class="block_2columns_md p-2"> <!-- modal_contact_us_title -->
                <div class="horiz_divider_left_13">
                    <label for="modal_contact_us_title">Title:</label>
                </div>
                <div class="horiz_divider_right_23">
                    <input type="text" class="form-control" id="modal_contact_us_title"
                           v-model="formEditor.title">
                    <div class="fs-error mb-3" v-if="formEditor.errors"
                         :class="{ 'd-block' : formEditor.errors && formEditor.errors.title}">
                        {{ formEditor.errors.title }}
                    </div>

                </div>
            </div> <!-- class="block_2columns_md" modal_contact_us_title -->
        </div>

        <div class="content contact_us_modal_content_editor_form p-0 m-0">
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


        <div class="contact_us_modal_footer">
            <button type="button" class="btn btn-secondary btn-xs m-1 p-1"
                    @click="hideContactUsModal">
                <i :class="getHeaderIcon('cancel')" class="m-0"></i>Cancel
            </button>
            <button type="button" class="btn btn-success btn-sm text-uppercase p-2 m-4" @click="sendContactUsModal">
                <i :class="getHeaderIcon('save')" class="m-0"></i>Send
            </button>
        </div>

    </vue-final-modal>


</template>


<script>
import axios from 'axios'

import {
    getHeaderIcon,
    getErrorMessage,
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'

import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: 'MainContactUsBlock',
    components: {
        VueFinalModal,
        ModalsContainer
    },
    setup(props) {

        const main_page_contact_us_title = ref('')
        const main_page_contact_us_text = ref('')

        const show_contact_us_modal = ref(false)
        const formEditor = ref(useForm({
            title: '',
            content_message: '',
        }))

        function loadMainContactUsData() {
            let filters = {key: 'main_page_contact_us_block'}
            axios.post(route('frontend.get_block_cms_item'), filters)
                .then(({data}) => {
                    main_page_contact_us_title.value = data.cMSItem.title
                    main_page_contact_us_text.value = data.cMSItem.text
                })
                .catch(error => {
                    console.error(error)
                })
        } // loadMainContactUsData() {


        function showContactUsModal() {
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
                    console.log(e)
                }
            })
        }

        const MainContactUsBlockOnMounted = async () => {
            loadMainContactUsData()
            showContactUsModal() // DEBUGGING
        } // const MainContactUsBlockOnMounted = async () => {

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
        }
    }, // setup() {

}
</script>


<style>


.contact_us_modal_container {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color:  $frontend_background_color;
    opacity: 1;
    /*background-color: olive !important;*/
}

.contact_us_modal_header {
    /*background-color: $frontend_text_color;*/
    background: #FFF3D3 !important;
    color:  $frontend_background_color;
    /*border-bottom: 2px solid rgba(123,123,123);*/
    border-bottom: 1px solid #a5bdbb;
    /*border-bottom: 1px solid $frontend_background_color;*/
    /*padding: 0;*/
    padding: 6px 0 6px 0;
    margin: 0;
    position: relative;
}

.contact_us_modal_footer {
    /*padding: 0.5rem;*/
    /*border: 1px dotted red;*/
    height: 60px !important;
    border-top: 1px solid #a5bdbb;
    /*background: olive !important;*/
    /*background: #FFF3D3 !important;*/
    /*height: 40px !important;*/
    /*max-height: 60px ;*/
    margin :0;
    padding: 10px 0 10px 0;
    /*margin-bottom :10px !important;*/
}

.contact_us_modal_content {
    position: relative;
    width: 80%;

    margin-left: 4px;
    /*height: 300px;*/
    min-height: 400px;
    /*max-height: 360px;*/
    padding: 0;
    overflow: none;
    border-radius: 4px;

    border: 1px solid #ced4da !important;
    /*border-radius: 0.25rem !important;*/
    box-shadow: inset 0 0 0 transparent !important;
    display: flex;
    flex-direction: column;
    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */
    background: rgba(222, 255, 252, 1.0);
}

/* Medium ≥768px  ipad or ipad mini */
@media only screen and (min-width: 768px) and (max-width: 991px) {
    /* Ipad Pro md */
    .contact_us_modal_content {
        opacity : 1 !important;
        min-height: 450px;
        background: $frontend_background_color !important;
    }
}

.contact_us_modal_close {
    background-color: $frontend_text_color;
    color:  $frontend_background_color;
    position: absolute;
    top: 0;
    margin-top:18px;
    margin-right:12px;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 24px;
    height: 24px;
    /*margin: 4px 4px 0 0;*/
    cursor: pointer;
}

.contact_us_modal_close::hover {
    /*color: $frontend_text_color !important;*/
    background-color: $frontend_text_color;
    color:  $frontend_background_color;
}


.contact_us_modal_content_editor_form {
    opacity : 1 !important;
    margin-top: 0.7rem;
    flex: 1; /* same as flex: 1 1 auto; */
    background:  $frontend_background_color;
}

</style>
