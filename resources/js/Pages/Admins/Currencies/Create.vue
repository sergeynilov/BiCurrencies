<template>
        <admin-layout>
            <section class="content">

                <div v-if="$page.props.jetstream.flash">
                    {{ $page.props.jetstream.flash}}
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary" >
                                <form-editor :is_insert="true" :currency="currency"></form-editor>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

// import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'
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

export default {
    props: ['currency'],

    components: {
        AdminLayout,
        formEditor
    },
    data() {
        return {

            // Common methods
            getHeaderIcon,
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            showFlashMessage,
            getDictionaryLabel,

            // editMode: false,
            // form: this.$inertia.form({
            //     id: '',
            //     name: '',
            //     num_code: '',
            //     char_code: '',
            //     is_top: false,
            //     active: false,
            //     ordering: null,
            // }),
            // jsMomentDatetimeFormat: settingsJsMomentDatetimeFormat,
        }
    },
    async mounted() {
        console.log('Edit.vue mounted 1 this.currency')
        console.log(this.currency)

        if ( this.$page.props.jetstream && this.$page.props.jetstream.flash && this.$page.props.jetstream.flash.length > 0 ) {
            Toast.fire({
                icon: 'success',
                title: this.$page.props.jetstream.flash
            })
        }
        this.showFlashMessage()
    },


    computed: {
    },
    methods: {
    }
}
</script>
