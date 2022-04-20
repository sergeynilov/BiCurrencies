require('./bootstrap');

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

require('@fortawesome/fontawesome-free/js/all.min.js');

// Import modules...
import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import mitt from 'mitt';
window.emitter = mitt();


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

import Multiselect from '@vueform/multiselect'

import VueUploadComponent from 'vue-upload-component'
import Paginate from "vuejs-paginate-next";


const app =  createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component('inertia-link', Link)
            .component('Paginate', Paginate)
            .component('file-upload', VueUploadComponent)

            .mixin({ methods: { route } })
            .component('multiselect', Multiselect)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
