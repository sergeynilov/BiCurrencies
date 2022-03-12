<template>
    <div v-if="!formEditor.processing">
        <!--        is_insert::{{ is_insert }}<br>-->
        <!--        formEditor.errors::{{ formEditor.errors }}<br>-->
        <!--        formEditor::{{ formEditor }}<br>-->

        <div class="card-header">
            <h3 class="card-title">{{ getFormEditorTitle }}</h3>
        </div> <!-- card-title -->

        <form @submit.prevent="saveUser">

            <div class="card-body p-0">


                <div class="block_2columns_md p-2" v-if="!is_insert"> <!-- id -->
                    <div class="horiz_divider_left_13">
                        <label for="id">Id:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="id" disabled
                               v-model="formEditor.id">
                    </div>
                </div> <!-- class="block_2columns_md" id -->


                <div class="block_2columns_md p-2"> <!-- name -->
                    <div class="horiz_divider_left_13">
                        <label for="name">User Name:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="name"
                               placeholder="User descriptive name" v-model="formEditor.name"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.name }"
                               autofocus="autofocus" autocomplete="off">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.name}">
                            {{ formEditor.errors.name }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" name -->


                <div class="block_2columns_md p-2"> <!-- num_code -->
                    <div class="horiz_divider_left_13">
                        <label for="num_code">Number code:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="num_code"
                               placeholder="Valid integer value " v-model="formEditor.num_code"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.num_code }"
                               autofocus="autofocus" autocomplete="off">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.num_code}">
                            {{ formEditor.errors.num_code }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" num_code -->


<!--                CREATE TABLE `users` (-->
<!--                `id` bigint unsigned NOT NULL AUTO_INCREMENT,-->
<!--                `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,-->
<!--                `is_admin` tinyint(1) NOT NULL DEFAULT '0',-->
<!--                `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,-->
<!--                `status` enum('N','A','I') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT ' N => New(Waiting activation), A=>Active, I=>Inactive',-->
<!--                `email_verified_at` timestamp NULL DEFAULT NULL,-->
<!--                `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,-->
<!--                `two_factor_secret` text COLLATE utf8mb4_unicode_ci,-->
<!--                `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,-->
<!--                `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,-->
<!--                `current_team_id` bigint unsigned DEFAULT NULL,-->
<!--                `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,-->
<!--                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,-->
<!--                `updated_at` timestamp NULL DEFAULT NULL,-->

                <div class="block_2columns_md p-2"> <!-- char_code -->
                    <div class="horiz_divider_left_13">
                        <label for="char_code">Char code:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="char_code"
                               placeholder="Uppercase 3 chars code" v-model="formEditor.char_code"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.char_code }"
                               autofocus="autofocus" autocomplete="off" maxlength="3">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.char_code}">
                            {{ formEditor.errors.char_code }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" char_code -->


                <div class="block_2columns_md p-2"> <!-- is_top -->
                    <div class="horiz_divider_left_13">
                        <label for="name">Is top:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="checkbox" id="is_top" v-model="formEditor.is_top" :checked="formEditor.is_top" class="ml-1">
                    </div>
                </div> <!-- class="block_2columns_md" is_top -->

                <div class="block_2columns_md p-2"> <!-- active -->
                    <div class="horiz_divider_left_13">
                        <label for="name">Active:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="checkbox" id="active" v-model="formEditor.active" :checked="formEditor.active" class="ml-1">
                    </div>
                </div> <!-- class="block_2columns_md" active -->

                <div class="block_2columns_md p-2"> <!-- ordering -->
                    <div class="horiz_divider_left_13">
                        <label for="ordering">Ordering:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="ordering"
                               placeholder="Valid integer value" v-model="formEditor.ordering"
                               :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.ordering }"
                               autofocus="autofocus" autocomplete="off">
                        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
                             :class="{ 'd-block' : formEditor.errors && formEditor.errors.ordering}">
                            {{ formEditor.errors.ordering }}
                        </div>
                    </div>
                </div> <!-- class="block_2columns_md" ordering -->

                <div class="block_2columns_md p-2" v-if="!is_insert"> <!-- created_at -->
                    <div class="horiz_divider_left_13">
                        <label for="created_at">Created:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="created_at" disabled
                               v-model="createdAtLabel">
                    </div>
                </div> <!-- class="block_2columns_md" created_at -->

                <div class="block_2columns_md p-2" v-if="!is_insert && formEditor.updated_at">
                    <!-- created_at -->
                    <div class="horiz_divider_left_13">
                        <label for="updated_at">Updated:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="updated_at" disabled v-model="createdAtLabel">
                    </div>
                </div> <!-- class="block_2columns_md" updated_at -->
            </div>

            <div class="card-footer clearfix flex">
                <button type="button" class="btn btn-secondary btn-xs mt-1"
                        @click="cancelUserEditor">
                    <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
                </button>
                <button type="submit" class="btn btn-success btn-sm text-uppercase ml-4">
                    <i :class="getHeaderIcon('save')" class="mr-1"></i>{{ getSubmitBtnTitle }}
                </button>
                <button type="button" class="btn btn-sm btn_remove_right_aligned  mt-1" @click="deleteUser()" v-if="!is_insert">
                    <i :class="getHeaderIcon('remove')" class="mr-1" title="Delete user"></i>Delete
                </button>
            </div>

        </form>
    </div>

</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'

import {settingsJsMomentDatetimeFormat, settingsAppColors} from '@/app.settings.js'

export default {
    props: ['user', 'is_insert'],

    components: {
        AdminLayout,
    },
    data() {
        return {
            editMode: false,
            formEditor: this.$inertia.form({
                id: '',
                name: '',
                num_code: '',
                char_code: '',
                is_top: false,
                active: false,
                ordering: null,
            }),
            jsMomentDatetimeFormat: settingsJsMomentDatetimeFormat,
            appColors: settingsAppColors,
        }
    },
    mounted() {
        console.log('Form.vue mounted 1 this.user')
        console.log(this.user)
        console.log('Form.vue mounted 1 this.is_insert')
        console.log(this.is_insert)
        if (this.is_insert) {
            this.formEditor.name = ""
            this.formEditor.num_code = ""
            this.formEditor.char_code = ""
            this.formEditor.ordering = ""
        } else {
            this.formEditor.id = this.user.id
            this.formEditor.name = this.user.name
            this.formEditor.num_code = this.user.num_code
            this.formEditor.char_code = this.user.char_code
            this.formEditor.is_top = this.user.is_top
            this.formEditor.active = this.user.active
            this.formEditor.ordering = this.user.ordering

            this.formEditor.created_at = this.user.created_at
            this.formEditor.updated_at = this.user.updated_at
        }
        console.log(this.formEditor)
    },


    computed: {
        getFormEditorTitle() {
            return this.is_insert ? 'Create new user' : 'Edit user';
        },
        getSubmitBtnTitle() {
            return this.is_insert ? 'Create' : 'Update';
        },
        createdAtLabel() {
            return this.momentDatetime(this.formEditor.created_at, this.jsMomentDatetimeFormat);
        },
    },
    methods: {
        cancelUserEditor() {
            this.$inertia.visit(route('admin.users.index'), {method: 'get'});
        },


        saveUser() {
            console.log('saveUser this.is_insert::')
            console.log(this.is_insert)

            console.log('this.formEditor::')
            console.log(this.formEditor)

            if (this.is_insert) {
                this.formEditor.post(this.route('admin.users.store'), {
                    preserveScroll: true,
                    // onSuccess: (resp) => {
                    //     console.log('POSTED resp::')
                    //     console.log(resp)
                    // },
                    onError: (e) => {
                        console.log(e)
                        Toast.fire({
                            icon: 'error',
                            title: 'Adding user error!'
                        })
                    }
                })
            } else {
                console.log('this.formEditor::')
                console.log(this.formEditor)

                this.formEditor.patch(this.route('admin.users.update', this.formEditor.id/*, this.formEditor*/), {
                    preserveScroll: true,
                    // onSuccess: (resp) => {
                    //     console.log('UPDATED resp::')
                    //     console.log(resp)
                    // },
                    onError: (e) => {
                        Toast.fire({
                            icon: 'error',
                            // title: 'User updating error : ' + this.getErrorMessage(e)
                            title: 'Updating user error!'
                        })
                    }

                })
            }
        }, // saveUser() {


        deleteUser() {
            console.log('deleteUser ::')

            Swal.fire({
                title: 'Are you sure?',
                text: "You what to delete this user with all related data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: this.appColors.confirmButtonColor,
                cancelButtonColor: this.appColors.cancelButtonColor,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('deleteUser result.isConfirmed::')
                    console.log(result.isConfirmed)

                    this.formEditor.delete(this.route('admin.users.destroy', this.formEditor.id), {
                        preserveScroll: true,
                        onSuccess: ()=> {
                            Swal.fire(
                                'Deleted!',
                                'User has been successfully deleted.',
                                'success'
                            )
                        },
                        onError: (e) => {
                            console.log(e)
                            Toast.fire({
                                icon: 'error',
                                title: 'Deleting user error : ' + this.getErrorMessage(e)
                            })
                        }

                    })
                }
            })
        } // deleteUser() {

    }
}
</script>
