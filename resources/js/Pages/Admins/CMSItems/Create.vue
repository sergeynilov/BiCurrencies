<template>
    <admin-layout>

        <div class="card card-primary">
            <form-editor :is_insert="true" :CMSItem="CMSItem"></form-editor>
        </div>

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

import formEditor from '@/Pages/Admins/CMSItems/Form'
import {
    getHeaderIcon,
    getErrorMessage,
    pluralize,
    pluralize3,
    momentDatetime,
    showFlashMessage,
    getDictionaryLabel,
} from '@/commonFuncs'
import axios from "axios";
import {onMounted, ref} from "vue";

export default {
    props: {
        CMSItem: {
            type: Object,
            required: false,
        }
    },
    name: 'adminCMSItemsCreate',

    components: {
        AdminLayout,
        formEditor
    },

    setup(props) {
        let CMSItem= ref(props.CMSItem)

        function adminCMSItemCreateOnMounted() {
            console.log('adminCMSItemCreateOnMounted::')
            showFlashMessage()
        }
        onMounted(adminCMSItemCreateOnMounted)

        return { // setup return

            // Listing Page state
            showFlashMessage
        }
    }  // setup() {


}
</script>
