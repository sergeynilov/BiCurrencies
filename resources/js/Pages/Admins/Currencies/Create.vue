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
    showFlashMessage,
} from '@/commonFuncs'
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
        let currency= ref(props.currency)

        function adminCurrencyCreateOnMounted() {
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
