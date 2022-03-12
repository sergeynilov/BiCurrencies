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
                            <form-editor :is_insert="true" :user="user"></form-editor>
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
import formEditor from '@/Pages/Admins/Users/Form'


export default {
    props: ['user'],

    components: {
        AdminLayout,
        formEditor
    },
    data() {
        return {
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
        console.log('Edit.vue mounted 1 this.user')
        console.log(this.user)

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
