<template>
    <admin-layout>

        <div class="card card-primary card-tabs">
            <div class="card-header p-2">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="CMSItem-details-tab" data-toggle="pill"
                           href="#custom-tabs-one-home" role="tab"
                           aria-controls="custom-tabs-one-home" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item">
                        <!--                                            active-->
                        <a class="nav-link" id="CMSItem-tab" data-toggle="pill"
                           href="#CMSItem" role="tab"
                           aria-controls="CMSItem"
                           aria-selected="false">Image</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="custom-tabs-one-text-tab"
                           data-toggle="pill"
                           href="#custom-tabs-one-text" role="tab"
                           aria-controls="custom-tabs-one-text"
                           aria-selected="false">Text</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content h-100" id="custom-tabs-one-tabContent">
                    <!--                                                show active-->
                    <div class="tab-pane show active" id="custom-tabs-one-home" role="tabpanel"
                         aria-labelledby="CMSItem-details-tab">
                        <CMSItem-form-editor :is_insert="false" :CMSItem="CMSItem"></CMSItem-form-editor>
                    </div>

                    <div class="tab-pane fade" id="CMSItem" role="tabpanel"
                         aria-labelledby="CMSItem-tab">
                        <FileUploaderPreviewer
                            :imageUploader="CMSItemImageUploader"
                            :image_url="cms_item_image_url"
                            :image_info="cms_item_image_info"
                            :parent_component_key="'CMSItem_editor'"
                            :layout="'admin'"
                        ></FileUploaderPreviewer>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-one-text" role="tabpanel"
                         aria-labelledby="custom-tabs-one-text-tab">
                        <quill-editor
                            :options="editorOptions"
                            theme="snow"
                            v-model:content="textFormEditor.text"
                            text-change="textChangeText"
                            editorChange="editorChangeText"
                            contentType="html"
                        >{{ textFormEditor.text }}
                        </quill-editor>
                        <div class="invalid-feedback mb-3" v-if="textFormEditor.errors"
                             :class="{ 'd-block' : textFormEditor.errors && textFormEditor.errors.text}">
                        </div>

                        <div class="admin_listing_modal_footer">
                            <button type="button"
                                    class="btn btn-success btn-sm text-uppercase right_btn_from_left_margin"
                                    @click="saveTextFormEditor">
                                <i :class="getHeaderIcon('save')"
                                   class="action_icon icon_right_text_margin"></i>Save
                            </button>
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
    isEmpty,
    formatValue,
    momentDatetime,
    getErrorMessage,
    showFlashMessage,
    getDictionaryLabel,
    dateIntoDbFormat,
    getFileSizeAsString
} from '@/commonFuncs'
import {settingsJsMomentDatetimeFormat, settingsAppColors} from '@/app.settings.js'

// import CKEditor from '@ckeditor/ckeditor5-vue';
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

//                                            <CMSItem-form-editor :is_insert="false" :CMSItem="CMSItem"></CMSItem-form-editor>

import CMSItemFormEditor from '@/Pages/Admins/CMSItems/Form'
import {onMounted, ref, watchEffect} from "vue";
import axios from "axios";
import ListingHeader from '@/components/ListingHeader.vue'
import FileUploaderPreviewer from '@/components/FileUploaderPreviewer.vue'


// Vue.component('QuillEditor', VueQuill.QuillEditor);
import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import QuillBetterTable from 'quill-better-table' // https://github.com/soccerloway/quill-better-table

// import Datepicker from 'vue3-date-time-picker';
// import 'vue3-date-time-picker/dist/main.css';
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from '@inertiajs/inertia'

export default {

    props: {
        CMSItem: {
            type: Object,
            required: true,
        },
        CMSItemImage: {
            type: Object,
            required: true,
        }
    },

    name: 'adminCMSItemsEdit',
    components: {
        AdminLayout,
        ListingHeader,
        FileUploaderPreviewer,
        // Datepicker,
        // CKEditor,
        CMSItemFormEditor,
        QuillEditor,
    },
    setup(props) {
        let CMSItem = ref(props.CMSItem)

        let cms_item_image_url = ref(props.CMSItemImage.url)
        let cms_item_image_info = ref(props.CMSItemImage.file_name + ', ' + getFileSizeAsString(props.CMSItemImage.size) + ', ' + props.CMSItemImage.width + '*' + props.CMSItemImage.height)
        let CMSItemImageUploader = ref(useForm({
            image: '',
            cms_item_id: props.CMSItem.id,
            image_filename: '',
        }))

        let textFormEditor = ref(useForm({
            id: props.CMSItem.id,
            text: props.CMSItem.text,
        }))

        let editorOptions = ref(
            [['better-table', 'bold', 'italic'], ['link', 'image']]
        )

        function saveTextFormEditor() {
            textFormEditor.value.put(route('admin.cms_items.text_save', textFormEditor.value.id), {
                preserveScroll: false,
                onSuccess: (resp) => {
                    Swal.fire(
                        'Saved!',
                        'Text successfully saved !',
                        'success'
                    )
                },
                onError: (e) => {
                    console.log(e)
                    Toast.fire({
                        icon: 'error',
                        title: 'Text saving error!'
                    })
                }

            })
        }

        function fetchCMSItemImage(CMSItemImageFile) {
            fetch(CMSItemImageFile.blob).then(function (response) {
                if (response.ok) {
                    return response.blob().then(function (imageBlob) {
                        CMSItemImageUploader.value.image = imageBlob
                        CMSItemImageUploader.value.image_filename = CMSItemImageFile.name
                        CMSItemImageUploader.value.post(route('admin.cms_items.upload_image'), {
                            preserveScroll: true,
                            onSuccess: (resp) => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'You have uploaded image successfully'
                                })
                                window.emitter.emit('imageBlobFetchedEvent', {
                                    parent_component_key: 'CMSItem_editor',
                                    resp: resp,
                                })
                                Inertia.visit(route('admin.cms_items.edit', CMSItemImageUploader.value.cms_item_id), {only: ['CMSItemImage'],})
                                // loadCMSItemImage()
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
            }) // fetch(CMSItemImageFile.blob).then(function (response) {

        }


        function adminCMSItemEditOnMounted() {
            showFlashMessage()
            window.emitter.on('FileUploaderPreviewerUploadImageEvent', params => {
                if (params.parent_component_key === 'CMSItem_editor') {
                    fetchCMSItemImage(params.uploadedImageFile)
                }
            })

        }
        onMounted(adminCMSItemEditOnMounted)

        return { // setup return

            // Listing Page state
            CMSItem,
            cms_item_image_url,
            cms_item_image_info,
            textFormEditor,
            saveTextFormEditor,
            editorOptions,

            // Listing filtering
            CMSItemImageUploader,

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
            formatValue,
            getFileSizeAsString
        }
    }, // setup() {

}
</script>
