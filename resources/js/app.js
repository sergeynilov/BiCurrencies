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

// Import modules...
import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import mitt from 'mitt';
window.emitter = mitt();

// import Vue3ColorPicker from "vue3-colorpicker";
// import "vue3-colorpicker/style.css";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// Import components...
// import Multiselect from '@suadelabs/vue3-multiselect'

import Multiselect from '@vueform/multiselect'


import CKEditor from '@ckeditor/ckeditor5-vue' // https://stackoverflow.com/questions/55129721/ckeditor5-integration-with-vue-js-and-laravel

// Vue.component('ck-editor', require('./components/ckeditor.vue').default);

import VueUploadComponent from 'vue-upload-component'
// app.component('file-upload', VueUploadComponent)


const app =  createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use( CKEditor )
            .component('inertia-link', Link)
            .component('file-upload', VueUploadComponent)
            .mixin({ methods: { route } })
            // .use(Vue3ColorPicker)

            // resources/js/appMixin.js
            // .mixin( '@/appMixin' )
            // import appMixin from '@/appMixin'


            .component('multiselect', Multiselect)
            .component('ck-editor', require('./components/ckeditor.vue').default)
            .mount(el);
    },
});

// app.component('file-upload', VueUploadComponent)

// https://stackoverflow.com/questions/69112278/how-to-create-and-use-common-mixin-in-laravel-8-inertia-js-vuejs3-application
// app.mixin(
//     '@/appMixin'
// )

InertiaProgress.init({ color: '#4B5563' });
