<template>
    <admin-layout>
        <section class="content">

            <!--
                            <div v-if="$page.props.jetstream.flash">
                                {{ $page.props.jetstream.flash}}
                            </div>

                            <div v-if="$page.props">
                                {{ $page.props}}
                            </div>
            -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary" >
                            <form-editor :is_insert="false" :user="user"></form-editor>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'
// resources/js/Pages/Admins/Users/Form.vue
import formEditor from '@/Pages/Admins/Users/Form'


export default {
    props: ['user'],

    components: {
        AdminLayout,
        formEditor
    },
    data() {
        return {
            editMode: false,
            /* CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `status` enum('C','N','A','I') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT ' C => Waiting confirmation code,  N => New(Waiting activation), A=>Active, I=>Inactive',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `confirmation_code` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL, */
            form: this.$inertia.form({
                id: '',
                name: '',
                email: '',
                status: ''
            }),
            jsMomentDatetimeFormat: settingsJsMomentDatetimeFormat,
        }
    },
    async mounted() {
        console.log('Edit.vue mounted 1 this.user')
        console.log(this.user)
        console.log(this.form)
        this.showFlashMessage()
    },


    computed: {
    },
    methods: {
    }
}
</script>
