<template>
    <div v-if="!formEditor.processing">
        resources/js/Pages/Admins/Currencies/Form.vue<br>
        is_insert::{{ is_insert }}<br>
        formEditor.errors::{{ formEditor.errors }}<br>
        formEditor::{{ formEditor }}<br>


        <div class="card-header">
            <h3 class="card-title">{{ formTitle }}</h3>
        </div> <!-- card-title -->

        <form @submit.prevent="saveCurrency">

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
                        <label for="name">Currency Name:</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="text" class="form-control" id="name"
                               placeholder="Currency descriptive name" v-model="formEditor.name"
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
                        <label for="name">Is top</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="checkbox" id="is_top" value="1" :checked="formEditor.is_top" class="ml-1">
                    </div>
                </div> <!-- class="block_2columns_md" is_top -->

                <div class="block_2columns_md p-2"> <!-- active -->
                    <div class="horiz_divider_left_13">
                        <label for="name">Active</label>
                    </div>
                    <div class="horiz_divider_right_23">
                        <input type="checkbox" id="active" value="1" :checked="formEditor.active" class="ml-1">
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
                        <input type="text" class="form-control" id="updated_at" disabled
                               v-model="createdAtLabel">
                    </div>
                </div> <!-- class="block_2columns_md" updated_at -->

            </div>

            <div class="card-footer clearfix">
                <button type="button" class="btn btn-secondary btn-xs mt-1"
                        @click="cancelCurrencyEditor">
                    <i :class="getHeaderIcon('cancel')" class="mr-1"></i>Cancel
                </button>
                <button type="submit" class="btn btn-success btn-sm text-uppercase ml-4">
                    <i :class="getHeaderIcon('save')" class="mr-1"></i>{{ btnUpdateLabel }}
                </button>
                <!--                                    :disabled="!formEditor.name || formEditor.processing"-->
            </div>
        </form>
    </div>

</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'

// import appMixin from '@/appMixin'
import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'
// resources/js/Pages/Admins/Currencies/Form.vue


export default {
    props: ['currency', 'is_insert'],

    // mixins: [appMixin],

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
        }
    },
    mounted() {
        console.log('Form.vue mounted 1 this.currency')
        console.log(this.currency)
        console.log('Form.vue mounted 1 this.is_insert')
        console.log(this.is_insert)
        if (this.is_insert) {
            this.formEditor.name = "currency 9"
            this.formEditor.num_code = "987"
            this.formEditor.char_code = "uyt"
            this.formEditor.ordering = "ZZ"
        } else {
            this.formEditor.id = this.currency.id
            this.formEditor.name = this.currency.name
            this.formEditor.num_code = this.currency.num_code
            this.formEditor.char_code = this.currency.char_code
            this.formEditor.is_top = this.currency.is_top
            this.formEditor.active = this.currency.active
            this.formEditor.ordering = this.currency.ordering

            this.formEditor.created_at = this.currency.created_at
            this.formEditor.updated_at = this.currency.updated_at
        }
        console.log(this.formEditor)
    },


    computed: {
        formTitle() {
            return this.is_insert ? 'Create new currency' : 'Edit currency';
        },
        btnUpdateLabel() {
            return this.is_insert ? 'Create' : 'Update';
        },
        createdAtLabel() {
            return this.momentDatetime(this.formEditor.created_at, this.jsMomentDatetimeFormat);
        },
    },
    methods: {
        cancelCurrencyEditor() {
            this.$inertia.visit(route('admin.currencies.index'), {method: 'get'});

            // this.$router.push({path: '/admin/currencies'})
        },


        saveCurrency() {
            console.log('saveCurrency this.is_insert::')
            console.log(this.is_insert)

            console.log('this.formEditor::')
            console.log(this.formEditor)

            if (this.is_insert) {
                this.formEditor.post(this.route('admin.currencies.store'), {
                    preserveScroll: true,
                    onSuccess: (resp) => {
                        console.log('POSTED resp::')
                        console.log(resp)
                        // Toast.fire({
                        //     icon: 'success',
                        //     title: 'New currency created!'
                        // })
                        // this.$router.push({path: '/admin/currencies'})
                        // this.is_insert= false
                    },
                    onError: (e) => {
                        console.log('onError e::')
                        console.log(e)

                        Toast.fire({
                            icon: 'error',
                            title: 'Currency adding error : ' + this.getErrorMessage(e)
                        })
                    }
                })
            } else {
                console.log('this.formEditor::')
                console.log(this.formEditor)

                this.formEditor.patch(this.route('admin.currencies.update', this.formEditor.id/*, this.formEditor*/), {
                    preserveScroll: true,
                    onSuccess: (resp) => {
                        console.log('UPDATED resp::')
                        console.log(resp)
                        // Toast.fire({
                        //     icon: 'success',
                        //     title: 'Currency has been updated!'
                        // })
                    },
                    onError: (e) => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Currency updating error : ' + this.getErrorMessage(e)
                        })
                    }

                })
            }
        }
        ,
    }
}
</script>
