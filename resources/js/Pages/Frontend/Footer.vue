<template>

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-0 pt-7 bg-1000" id="help">

        <div class="container">
            <div class="row">
                <jet-application-logo :icon_type="'small'" :layout="'frontend'" additive_class="mr-1 ml-1 mb-1"/>

                <p class="text-light mt-4">
                        {{ settings_site_name }}
                    </p>
                </div>
                <div class="col-6 col-md-4 col-xl-2 mb-3">
                    <h5 class="lh-lg fw-bold text-white">COMPANY</h5>
                    <ul class="list-unstyled mb-md-4 mb-lg-0">
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">About Us</a></li>
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Team</a></li>
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Careers</a></li>
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">blog</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-4 col-xl-2 mb-3">
                    <h5 class="lh-lg fw-bold text-white">Resources</h5>
                    <ul class="list-unstyled mb-md-4 mb-lg-0">
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Terms</a></li>
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Help</a></li>
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-4 col-xl-2 mb-3">
                    <h5 class="lh-lg fw-bold text-white">Blog</h5>
                    <ul class="list-unstyled mb-md-4 mb-lg-0">
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Lifestyle</a></li>
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Article</a></li>
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Tech</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-4 col-xl-2 mb-3">
                    <h5 class="lh-lg fw-bold text-white">CONTACT</h5>
                    <ul class="list-unstyled mb-md-4 mb-lg-0">
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Help &amp; Support</a></li>
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Partner with us </a></li>
                        <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Ride with us</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border border-800" />
            <div class="row flex-center pb-3">
                <div class="col-md-6 order-0">
                    <p class="text-200 text-center text-md-start">All rights Reserved &copy; Your Company, 2021</p>
                </div>
                <div class="col-md-6 order-1">
                    <p class="text-200 text-center text-md-end"> Made with&nbsp;
                        <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#0E6FFF" viewBox="0 0 16 16">
                            <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                        </svg>&nbsp;by&nbsp;<a class="text-200 fw-bold" href="https://themewagon.com/" target="_blank">ThemeWagon </a>
                    </p>
                </div>
            </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- Content BLOCK END -->

</template>


<script>

import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import {onMounted, ref} from "vue";
import axios from "axios";

export default {
    name: 'frontendFooter',
    components: {
        JetApplicationLogo
    },

    setup(props) {
        let currentDate = ref(new Date)
        let copyright_text = ref('')
        let settings_site_name = ref('')

        function frontendFooterOnMounted() {
            axios.get(route('get_settings_value', {key: 'site_name'}))
                .then(({data}) => {
                    settings_site_name.value = data.value
                })
                .catch(e => {
                    console.error(e)
                })
            axios.get(route('get_settings_value', {key: 'copyright_text'}))
                .then(({data}) => {
                    copyright_text.value = data.value
                    console.log('copyright_text.value::')
                    console.log(copyright_text.value)

                })
                .catch(e => {
                    console.error(e)
                })
        }

        onMounted(frontendFooterOnMounted)

        return { // setup return
            currentDate,
            copyright_text,
            settings_site_name
        }
    } // setup(props) {

}
</script>
