<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title admin_color">
                <i :class="getHeaderIcon('CMSItem')" class="action_icon icon_right_text_margin"></i>
                {{ getFormEditorTitle }}
            </h3>
        </div> <!-- card-header -->

        <form @submit.prevent="saveCMSItem">

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

                <div class="block_2columns_md p-2"> <!-- title -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="title" value="CMS item title:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="title" type="text" class="form-control admin_editable_input"
                                   v-model="formEditor.title" placeholder="CMS item descriptive title"
                                   :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.title }"
                                   autocomplete="off"/>
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.title}">
                            {{ formEditor.errors.title }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" title -->


                <div class="block_2columns_md p-2"> <!-- key -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="key" value="Key:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="key" type="text" class="form-control admin_editable_input"
                                   v-model="formEditor.key" placeholder="CMS item descriptive key"
                                   :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.key }"
                                   autocomplete="off"/>
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.key}">
                            {{ formEditor.errors.key }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" key -->

                <div class="block_2columns_md p-2" v-if="!is_insert"> <!-- published -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="published" value="Published:" class="admin_editable_label"/>
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="published" type="text" class="form-control"
                                   v-model="publishedLabel" disabled/>
                    </div>
                </div> <!-- class="block_2columns_md" published -->

                <div class="block_2columns_md p-2" v-if="!is_insert"> <!-- author -->
                    <div class="horiz_divider_left_13">
                        <jet-label for="author" value="Author:" class="admin_editable_label"/>
<!--                        formEditor::{{ formEditor}}-->
                    </div>
                    <div class="horiz_divider_right_23">
                        <jet-input id="author" type="text" class="form-control" v-model="author_nameLabel" disabled/>
                    </div>
                </div> <!-- class="block_2columns_md" author -->

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
                        <jet-button button_type="admin_cancel" @click="cancelMSItemEditor"
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
                                <a class="dropdown-item btn btn-sm btn_remove_right_aligned" @click="deleteCMSItem()">
                                    <i :class="getHeaderIcon('remove')" class="action_icon icon_right_text_margin"></i>Delete
                                </a>

                                <a class="dropdown-item btn-success" @click="publishCMSItem()"
                                   v-show="!formEditor.published">
                                    <i :class="getHeaderIcon('status')" class="action_icon icon_right_text_margin"></i>Publish
                                </a>
                                <a class="dropdown-item btn-secondary" @click="unpublishCMSItem()"
                                   v-show="formEditor.published">
                                    <i :class="getHeaderIcon('status')" class="action_icon icon_right_text_margin"></i>Unpublish
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'
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
import {settingsJsMomentDatetimeFormat, settingsCMSItemPublishedLabels, settingsAppColors} from '@/app.settings.js'
import {ref, onMounted, computed} from "vue";
import {useForm} from '@inertiajs/inertia-vue3';


import {Inertia} from '@inertiajs/inertia'
import axios from "axios";
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'


export default {
    props: {
        CMSItem: {
            type: Object,
            required: true,
        },
        is_insert: {
            type: Boolean,
            required: true,
        }
    },


    name: 'CMSItemForm',
    components: {
        AdminLayout,
        VueFinalModal,
        ModalsContainer,
        JetButton,
        JetInput,
        JetLabel,

    },
    setup(props) {

        let is_insert = ref(props.is_insert)


        let formEditor = ref(useForm({
            id: is_insert.value ? '' : props.CMSItem.id,
            title: is_insert.value ? 'title ' + new Date() : props.CMSItem.title,
            key: is_insert.value ? '9' + (new Date().getSeconds()) : props.CMSItem.key,
            published: is_insert.value ? false : (props.CMSItem.published === 1 ? true : false),
            author_name: is_insert.value ? '' : props.CMSItem.author.name+'',
            created_at: is_insert.value ? '' : props.CMSItem.created_at,
            updated_at: is_insert.value ? '' : props.CMSItem.updated_at,
        }))


        let getFormEditorTitle = computed(() => {
            return is_insert.value ? 'Create new CMS item' : 'Edit CMS item'
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
        let author_nameLabel = computed(() => {
            return formEditor.value.author_name
        });

        let publishedLabel = computed(() => {
            return getDictionaryLabel(formEditor.value.published ? 1 : 0, settingsCMSItemPublishedLabels)
        });

        function cancelMSItemEditor() {
            Inertia.visit(route('admin.cms_items.index'), {method: 'get'});
        }

        function isProxy(proxy) {
            return proxy == null ? false : !!proxy[Symbol.for("__isProxy")];
        }


        function saveCMSItem() {
            if (is_insert.value) {
                formEditor.value.post(route('admin.cms_items.store'), {
                    preserveScroll: true,
                    onError: (e) => {
                        console.log(e)
                        Toast.fire({
                            icon: 'error',
                            title: 'Adding CMS item error'
                        })
                    }
                })
            } else {
                formEditor.value.patch(route('admin.cms_items.update', formEditor.value.id/*, formEditor*/), {
                    preserveScroll: true,
                    onError: (e) => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Updating CMS iItem error'
                        })
                    }

                })
            }
        } // saveCMSItem() {

        function deleteCMSItem() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to delete this CMS item with all related data",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, delete it'
            }).then((result) => {
                if (result.isConfirmed) {
                    formEditor.value.delete(route('admin.cms_items.destroy', formEditor.value.id), {
                        preserveScroll: true,
                        onSuccess: () => {
                        }
                    })
                }
            })
        } // deleteCMSItem() {


        function publishCMSItem() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to publish this CMS item",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, publish it'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(route('admin.cms_items.publish', formEditor.value.id))
                        .then(({data}) => {
                            formEditor.value.published = data.CMSItem.published
                            formEditor.value.updated_at = data.CMSItem.updated_at
                            Swal.fire(
                                'CMS ITEM STATUS',
                                'CMS item was successfully published',
                                'success'
                            )
                        })
                        .catch(e => {
                            console.error(e)
                        })
                }
            })

        } // function publishCMSItem() {

        function unpublishCMSItem() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to unpublish this CMS item",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, unpublish it'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(route('admin.cms_items.unpublish', formEditor.value.id))
                        .then(({data}) => {
                            formEditor.value.published = data.CMSItem.published
                            formEditor.value.updated_at = data.CMSItem.updated_at
                            Swal.fire(
                                'CMS ITEM STATUS',
                                'CMS item was successfully unpublished ',
                                'success'
                            )
                        })
                        .catch(e => {
                            console.error(e)
                        })
                }
            })
        } // function unpublishCMSItem() {

        function adminCMSItemFormOnMounted() {
        }

        onMounted(adminCMSItemFormOnMounted)

        return { // setup return
            // Listing Page state
            is_insert,
            formEditor,
            cancelMSItemEditor,
            deleteCMSItem,
            publishCMSItem,
            unpublishCMSItem,
            saveCMSItem,
            publishedLabel,
            author_nameLabel,

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

