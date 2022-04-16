<template>
    <footer class="admin-main-footer">

        <div class="d-flex text-nowrap">
            <jet-application-logo :icon_type="'small'" :layout="'admin'" additive_class="mr-1 ml-1 mb-1"/>
            <strong>
                Copyright &copy; 2020-{{ currentDate.getFullYear() }}
                <inertia-link :href="route('home')">{{ $page.props.site_name }}</inertia-link>
            </strong>
            {{ copyright_text }}.
        </div>

    </footer>
</template>

<script>

import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import {onMounted, ref} from "vue";
import axios from "axios";

export default {
    name: 'adminFooter',
    components: {
        JetApplicationLogo
    },

    setup(props) {
        let currentDate = ref(new Date)
        let copyright_text = ref('')

        function adminFooterOnMounted() {
            axios.get(route('get_settings_value', {key: 'copyright_text'}))
                .then(({data}) => {
                    copyright_text.value = data.value
                })
                .catch(e => {
                    console.error(e)
                })
        }

        onMounted(adminFooterOnMounted)

        return { // setup return
            currentDate,
            copyright_text
        }
    } // setup(props) {

}
</script>
