<template>
    <button :type="type" :class="getClassesByButtonType()">
        <slot></slot>
    </button>
</template>

<script>
import {defineComponent, ref} from 'vue'

export default defineComponent({
    props: {
        type: {
            type: String,
            default: 'button',
        },
        button_type: {
            type: String,
            require:true
        },
    },

    setup(props) {
        let button_type = ref(props.button_type)
        function getClassesByButtonType() {
            if (button_type.value === 'admin_cancel') {
                return 'btn btn-secondary btn-sm p-1';
            }
            if (button_type.value === 'admin_save') {
                return 'btn btn-success btn-sm p-2 text-uppercase right_btn_from_left_margin';
            }
            if (button_type.value === 'admin_action') {
                return 'btn btn-primary btn-block right_btn_from_left_margin';
            }
            if (button_type.value === 'frontend_cancel') {
                return 'btn btn-secondary btn-xs p-1';
            }
            if (button_type.value === 'frontend_save') {
                return 'btn btn-success btn-sm text-uppercase p-2 mx-4';
            }
            return 'btn btn-dark text-uppercase';
        }

        return { // setup return
            getClassesByButtonType
        }
    } // setup(props) {

})

</script>
