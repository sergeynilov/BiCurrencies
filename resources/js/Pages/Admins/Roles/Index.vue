<template>
    <div>
        <admin-layout>

            <vue-final-modal
                v-model="show_filters_modal"
                classes="modal-container"
                content-class="modal-content card d1"
            >
                <h3 class="card-title">
                    <i :class="getHeaderIcon('filter')" class="mr-1"></i>Set    Filters
                </h3>

                <div class="card-body">

                    <div class="block_2columns_md p-2"> <!-- name -->
                        filter_name::{{ filter_name}}
                        <div class="horiz_divider_left_13">
                            <label for="name">By Role Name:</label>
                        </div>
                        <div class="horiz_divider_right_23">
                            <input type="text" class="form-control" id="filter_name"
                                   placeholder="By Role Name" v-model="filter_name"
                                   autofocus="autofocus" autocomplete="off">
                        </div>
                    </div> <!-- class="block_2columns_md" id -->

                </div>
                <button class="modal-close" @click="hideFiltersModal">
                    x
                </button>

                <div class="card-footer clearfix">
                    <button type="button" class="btn btn-secondary btn-xs"
                            @click="hideFiltersModal">
                        <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-success btn-xs ml-4">
                        <i :class="getHeaderIcon('save')" @click="applyFilters" class="mr-1"></i>Apply
                    </button>
                </div>

            </vue-final-modal>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <h3 class="card-title">
                                        <button type="button" class="btn btn-info" @click="showFiltersModal">
                                            <i :class="getHeaderIcon('filter')" class="mr-1"></i>
                                            Filters
                                        </button>

                                        Roles & Permissions
                                        show_filters_modal::{{show_filters_modal}}
                                    </h3>

                                    <div class="card-tools">
                                        <inertia-link :href="route('admin.roles.create')" class="nav-link btn btn-sm btn-success">
                                            <i :class="getHeaderIcon('add')" class="mr-1"></i>Create
                                        </inertia-link>
                                    </div>

                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th class="text-capitalize">Role Name</th>
                                            <th class="text-capitalize">Permissions</th>
                                            <th class="text-capitalize">Created</th>
                                            <th class="text-capitalize text-right" >Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(role, index) in roles.data" :key="index">
                                            <td>{{ role.name }}</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                        <span v-for="(permission, index) in role.permissions" :key="index">
                                                            {{ permission.name }}
                                                        </span>
                                                </div>
                                            </td>
                                            <td>{{ momentDatetime(role.created_at, jsMomentDatetimeFormat) }}</td>
                                            <td class="text-right d-flex flex-nowrap">
                                                <inertia-link :href="route('admin.roles.edit', role)" class="nav-link" :class="route().current('admin.roles.*') ? 'active' : ' '">
                                                    <i :class="getHeaderIcon('edit')" class="mr-1" title="Edit"></i>
                                                </inertia-link>

                                                <button class="btn btn-danger ml-1" @click="deleteRole(role)">
                                                    <i :class="getHeaderIcon('remove')" class="mr-1" title="Delete"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <pagination :links="roles.links"></pagination>
                                </div>
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
// import appMixin from '@/appMixin'
import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'

import { $vfm, VueFinalModal, ModalsContainer } from 'vue-final-modal'


import Pagination from '@/components/Pagination'
export default {
    props: ['roles', 'permissions'],
    // mixins: [appMixin],
    components: {
        AdminLayout,
        // Multiselect
        Pagination,
        VueFinalModal,
        ModalsContainer
    },
    data() {
        return {
            show_filters_modal: false,
            filter_name: '',
            // editedIndex: -1,
            // editMode: false,
            // form: this.$inertia.form({
            //     id: '',
            //     name: '',
            //     permissions: []
            // }),
            // permissionOptions: this.permissions,
            jsMomentDatetimeFormat: settingsJsMomentDatetimeFormat,
        }
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'Create New Role' : 'Edit Current Role';
        },
        buttonTxt() {
            return this.editedIndex === -1 ? 'Create' : 'Edit';
        },
        checkMode() {
            return this.editMode === false ? this.createRole : this.editRole;
        }
    },
    methods: {
        showFiltersModal() {
            console.log('showFiltersModal::')
            this.show_filters_modal= true
            this.filter_name= ''
        },
        hideFiltersModal() {
            console.log('hideFiltersModal::')
            this.show_filters_modal= false
            this.filter_name= ''
        },
        applyFilters() {
            console.log('applyFilters::')

            this.show_filters_modal= false
            this.filter_name= ''

        },
/*
        addPermissions(newPermission) {
            let permission = {
                name: newPermission,
            }
            this.permissionOptions.push(permission)
            this.form.permissions.push(permission)
        },


        createRole() {
            this.form.post(this.route('admin.roles.store'), {
                preserveScroll: true,
                onSuccess:() => {
                    this.closeModal()
                    Toast.fire({
                        icon: 'success',
                        title: 'New role created!'
                    })
                }
            })
        },
        editRole() {
            this.form.patch(this.route('admin.roles.update', this.form.id, this.form), {
                preserveScroll: true,
                onSuccess:() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Role has been updated!'
                    })
                    this.closeModal()
                }
            })
        },
*/
        deleteRole(role) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to delete this role with all related data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.form.delete(this.route('admin.roles.destroy', role), {
                        preserveScroll: true,
                        onSuccess: ()=> {
                            Swal.fire(
                                'Deleted!',
                                'Role has been deleted.',
                                'success'
                            )
                        }
                    })
                }
            })
        }
    }
}
</script>



<style>
.modal-container {
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal-content {
    position: relative;
    width: 50%;
    max-height: 300px;
    padding: 16px;
    overflow: auto;
    background-color: #fff;
    border-radius: 4px;
}
.modal-close {
    position: absolute;
    top: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 32px;
    height: 32px;
    margin: 8px 8px 0 0;
    cursor: pointer;
}
.modal-close::hover {
    color: gray;
}
</style>
