<template>
    <div>
        <admin-layout>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <div class="card card-primary" v-if="!form.processing">

                                is_insert::{{ is_insert }}<br>
                                form::{{ form }}<br>


                                <div class="card-header">
                                    <h3 class="card-title">{{ formTitle }}</h3>
                                </div> <!-- card-title -->

                                <form @submit.prevent="saveRole">
                                    <div class="card-body p-0">


                                        <div class="block_2columns_md p-2" v-if="!is_insert"> <!-- id -->
                                            <div class="horiz_divider_left_13">
                                                <label for="id">Id:</label>
                                            </div>
                                            <div class="horiz_divider_right_23">
                                                <input type="text" class="form-control" id="id" disabled
                                                       v-model="form.id">
                                            </div>
                                        </div> <!-- class="block_2columns_md" id -->


                                        <div class="block_2columns_md p-2"> <!-- name -->
                                            <div class="horiz_divider_left_13">
                                                <label for="name">Role Name:</label>
                                            </div>
                                            <div class="horiz_divider_right_23">
                                                <input type="text" class="form-control" id="name"
                                                       placeholder="Role descriptive name" v-model="form.name"
                                                       :class="{ 'is-invalid' : form.errors && form.errors.name }"
                                                       autofocus="autofocus" autocomplete="off">
                                                <div class="invalid-feedback mb-3" v-if="form.errors"
                                                     :class="{ 'd-block' : form.errors && form.errors.name}">
                                                    {{ form.errors.name }}
                                                </div>

                                            </div>
                                        </div> <!-- class="block_2columns_md" name -->

<!--                                        permissionSelectionArray::{{permissionSelectionArray}}<br>-->
                                        form.rolePermissions::{{form.rolePermissions}}<br>

                                        <div class="block_2columns_md p-2"> <!-- rolePermissions -->

                                            <div class="horiz_divider_left_13">
                                                <label for="rolePermissions">Permissions:</label>
                                            </div>
                                            <div class="horiz_divider_right_23">
                                                <Multiselect
                                                    v-model="form.rolePermissions"
                                                    mode="tags"
                                                    :options="permissionSelectionArray"
                                                    valueProp="id"
                                                    multiplelabel="multiple label text"
                                                    :searchable="true"
                                                    :max="-1"
                                                    ref="multiselect"
                                                    label="name"
                                                    track-by="name"
                                                    placeholder="Select permission(s) assigned to this role"
                                                    class="multiselect-admin-lte"
                                                />

                                                <div class="invalid-feedback" v-if="form.errors"
                                                     :class="{ 'd-block' : form.errors && form.errors.rolePermissions}">
                                                    {{ form.errors.rolePermissions }}
                                                </div>


                                            </div>
                                        </div> <!-- class="block_2columns_md" permissions -->

                                        <div class="block_2columns_md p-2" v-if="!is_insert">
                                            <!-- created_at -->
                                            <div class="horiz_divider_left_13">
                                                <label for="created_at">Created:</label>
                                            </div>
                                            <div class="horiz_divider_right_23">
                                                <input type="text" class="form-control" id="created_at" disabled
                                                       v-model="createdAtLabel">
                                            </div>
                                        </div> <!-- class="block_2columns_md" created_at -->

                                        <div class="block_2columns_md p-2" v-if="!is_insert && form.updated_at">
                                            <!-- created_at -->
                                            <div class="horiz_divider_left_13">
                                                <label for="updated_at">Updated:</label>
                                            </div>
                                            <div class="horiz_divider_right_23">
                                                <input type="text" class="form-control" id="updated_at" disabled
                                                       v-model="createdAtLabel">
                                            </div>
                                        </div> <!-- class="block_2columns_md" updated_at -->

                                    </div>

                                    <div class="card-footer clearfix">
                                        <button type="button" class="btn btn-secondary btn-xs mt-1"
                                                @click="cancelRoleEditor">
                                            <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
                                        </button>
                                        <button type="submit" class="btn btn-success btn-sm text-uppercase ml-4">
                                            <i :class="getHeaderIcon('save')" class="mr-1"></i>{{ btnUpdateLabel }}
                                        </button>
                                        <!--                                    :disabled="!form.name || form.processing"-->
                                    </div>
                                </form>

                            </div>


                        </div>
                    </div>
                </div>
            </section>

        </admin-layout>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import Multiselect from '@vueform/multiselect'

// import appMixin from '@/appMixin'
import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'

export default {
    props: ['role', 'rolePermissions', 'permissionSelectionArray', 'is_insert'],

    // mixins: [appMixin],

    components: {
        AdminLayout,
        Multiselect
    },
    data() {
        return {
            editMode: false,
            form: this.$inertia.form({
                id: '',
                name: '',
                rolePermissions: []
            }),
            jsMomentDatetimeFormat: settingsJsMomentDatetimeFormat,
        }
    },
    async mounted() {
        console.log('async mounted 1 this.role')
        console.log(this.role)
        this.form.name = this.role.name
        this.form.id = this.role.id
        console.log('this.rolePermissions::')
        console.log(this.rolePermissions)

        this.form.rolePermissions = this.rolePermissions
        this.form.created_at = this.role.created_at
        this.form.updated_at = this.role.updated_at
        console.log(this.form)
        this.$refs.multiselect.open()
        this.$refs.multiselect.$el.focus()

    },


    computed: {
        formTitle() {
            return this.is_insert ? 'Create New Role' : 'Edit Role';
        },
        btnUpdateLabel() {
            return this.is_insert ? 'Create' : 'Update';
        },
        createdAtLabel() {
            return this.momentDatetime(this.form.created_at, this.jsMomentDatetimeFormat);
        },
    },
    methods: {
        cancelRoleEditor() {
            this.$inertia.visit(route('admin.roles.index'), {method: 'get'});

            // this.$router.push({path: '/admin/roles'})
        },

        saveRole() {
            console.log('saveRole this.is_insert::')
            console.log(this.is_insert)

            console.log('this.form::')
            console.log(this.form)

            if (this.is_insert) {
                this.form.post(this.route('admin.roles.store'), {
                    preserveScroll: true,
                    onSuccess: (resp) => {
                        console.log('resp::')
                        console.log(resp)
                        Toast.fire({
                            icon: 'success',
                            title: 'New role created!'
                        })
                        // this.$router.push({path: '/admin/roles'})
                        // this.is_insert= false
                    },
                    onError: (e) => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Role adding error!'
                        })
                    }
                })
            } else {
                this.form.patch(this.route('admin.roles.update', this.form.id/*, this.form*/), {
                    preserveScroll: true,
                    onSuccess: () => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Role has been updated!'
                        })
                    },
                    onError: (e) => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Role updating error!'
                        })
                    }

                })
            }
        },
    }
}
</script>
