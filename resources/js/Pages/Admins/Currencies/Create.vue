<template>
    <admin-layout>

        <div class="card card-primary">
            <form-editor :is_insert="true" :currency="currency"></form-editor>
        </div>

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

import formEditor from '@/Pages/Admins/Currencies/Form'
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
        currency: {
            type: Object,
            required: false,
        }
    },
    name: 'adminCurrenciesCreate',

    components: {
        AdminLayout,
        formEditor
    },

    setup(props) {
        console.log('resources/js/Pages/Admins/Currencies/Create.vue setup props::')
        console.log(props)

        let currency= ref(props.currency)


        function adminCurrencyCreateOnMounted() {
            console.log('adminCurrencyCreateOnMounted::')
            showFlashMessage()

        }
        onMounted(adminCurrencyCreateOnMounted)

        return { // setup return

            // Listing Page state
            showFlashMessage
        }
    }  // setup() {


}
</script>
