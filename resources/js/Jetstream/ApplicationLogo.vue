<template>
<!--    mb-4-->
    <inertia-link :href="route(getRootUrl())" class="d-flex justify-content-center" :class="additive_class">
        <img :style="'height:' + getLogoHeight()+'px; width :auto;'" src="/images/currency_logo.png"
             :title="site_heading">
    </inertia-link>
</template>

<script>
import {defineComponent, onMounted, ref} from 'vue'
import {Link} from '@inertiajs/inertia-vue3';
import axios from "axios";

export default defineComponent({

    props: {
        icon_type: {
            type: String,
            required: false,
            default: 'big'
        },
        layout: {
            type: String,
            required: false,
            default: 'admin'
        },
        additive_class: {
            type: String,
            required: false,
            default: ''
        },
    },

    name: 'ApplicationLogo',
    components: {
        Link,
    },
    setup(props) {
        let icon_type = ref(props.icon_type)
        let layout = ref(props.layout)
        let additive_class = ref(props.additive_class)
        let site_heading = ref('')

        function getRootUrl() {
            if (layout.value === 'admin') {
                return 'admin.dashboard.index'
            }
            if (layout.value === 'user') {
                return 'user.profile.index'
            }
            return 'home'
        }

        function getLogoHeight() {
            if (icon_type.value === 'small') {
                return 24;
            }
            if (icon_type.value === 'big') {
                return 256;
            }
            if (icon_type.value === 'medium') {
                return 128;
            }
            return 32;
        }


        function applicationLogoOnMounted() {
            axios.get(route('get_settings_value', {key: 'site_heading'}))
                .then(({data}) => {
                    site_heading.value = data.value
                })
                .catch(e => {
                    console.error(e)
                })
        }

        onMounted(applicationLogoOnMounted)

        // site_heading


        return { // setup return
            icon_type,
            layout,
            additive_class,
            site_heading,
            getRootUrl,
            getLogoHeight
        }
    } // setup(props) {

})
</script>
