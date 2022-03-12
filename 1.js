In laravel 9 with Inertiajs 3 I use $inertia.form for data saving, like :
<template>
    <div v-if="!formEditor.processing">
        <input type="text" class="form-control" v-model="formEditor.name"
        :class="{ 'is-invalid' : formEditor.errors && formEditor.errors.name }"
    >
        <div class="invalid-feedback mb-3" v-if="formEditor.errors"
        :class="{ 'd-block' : formEditor.errors && formEditor.errors.name}">
        {{ formEditor.errors.name }}
    </div>
</div>
...

</template>



<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
    props: ['currency', 'is_insert'], // I got these data from controller

    components: {
    AdminLayout,
},
    data() {
        return {
            formEditor: this.$inertia.form({
                id: '',
                name: '',
            }),
        }
    },
    methods: {
        saveCurrency() {
            this.formEditor.post(this.route('admin.currencies.store'), {
                onError: (e) => {
                    console.log(e)
                }
            })
        }, // saveCurrency() {
    }
}
</script>

where formEditor is valid  inertia form and it worked ok for me, but I failed to remake this code with Composition API, like :



