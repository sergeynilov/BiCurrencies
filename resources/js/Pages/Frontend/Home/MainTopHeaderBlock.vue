<template>

    <!-- Content BLOCK START -->
    <section class="py-5 overflow-hidden" id="home" v-if="main_page_top_header_title && main_page_top_header_text">
        <div class="bg-holder w-50 bg-right d-none d-md-block"
             :style="'background-image:url( ' + main_page_top_header_image_url + ');' ">
<!--            width:540px !important; height:auto !important;-->
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row">

                <div class="col-md-7 col-lg-6 pt-8 text-md-start text-center">
                    <h4 class="fw-normal text-400">{{ sanitizeHtml(main_page_top_header_title) }}</h4>
                    <h1 class="mb-5 display-1 fs-md-5 fs-lg-6 fs-xl-7 fs-xxl-8">{{ sanitizeHtml(main_page_top_header_text) }}</h1>
                    <a class="btn btn-primary" href="#" role="button">Get In Touch</a>
                    <div class="mt-8">
                        <div class="carousel slide" id="carouselPopularItems" data-bs-touch="false">
                            <div class="carousel-inner">

                                <div :class="'carousel-item ' + ( index === 0 ? 'active' : '' ) "  v-for="(nextQuote, index) in quotes" :key="index">
                                    <div class="row gx-3 h-100 align-items-center">
                                        <h1 class="fs-4 fs-md-3 fs-lg-4">
                                            {{ nextQuote.text}}
                                        </h1>
                                        <div class="d-flex align-items-md-center">
                                            <img class="img-fluid me-4 me-md-3 me-lg-4"
                                                 :src="nextQuote.media_image_url" width="100" alt=""/>
                                            <div class="w-lg-50 my-3">
                                                <h5 class="mb-0 fw-bold">{{ nextQuote.author_name }}</h5>
                                                <p class="fw-normal mb-0">{{ nextQuote.occupation }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="position-relative col-2 col-md-3 col-xl-2 ms-auto">
                                <button class="carousel-control-prev carousel-icon" type="button"
                                        data-bs-target="#carouselPopularItems" data-bs-slide="prev"><span
                                    class="carousel-control-prev-icon" aria-hidden="true"></span><span
                                    class="visually-hidden">Previous</span></button>
                                <button class="carousel-control-next carousel-icon" type="button"
                                        data-bs-target="#carouselPopularItems" data-bs-slide="next"><span
                                    class="carousel-control-next-icon" aria-hidden="true"></span><span
                                    class="visually-hidden">Next   </span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</template>

<script>
import axios from 'axios'

import {
    getHeaderIcon,
    pluralize,
    pluralize3,
    momentDatetime,
    getErrorMessage,
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'
import * as sanitizeHtml from 'sanitize-html';

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels
} from '@/app.settings.js'

export default {
    name: 'MainTopHeaderBlock',
    components: {},
    setup(props) {
        console.log('MainTopHeaderBlock props::')
        console.log(props)

        let main_page_top_header_title = ref('')
        let main_page_top_header_text = ref('')
        let main_page_top_header_image_url = ref('')

        let quotes = ref([])

        function loadMainTopHeaderData() {
            axios.get(route('frontend.get_block_cms_item', 'main_page_top_header_block'))
                .then(({data}) => {
                    main_page_top_header_title.value = data.cMSItem.title
                    main_page_top_header_text.value = data.cMSItem.text
                    main_page_top_header_image_url.value = data.image.url
                })
                .catch(e => {
                    console.error(e)
                })

            axios.post(route('frontend.get_block_quote', { keys : [ 'antony_linken_credibility_quote', 'mark_rutte_quote', 'ross_perot_a_weak_currency_quote' ] } ))
                .then(({data}) => {
                    // console.log('get_block_quote data::')
                    // console.log(data)
                    quotes.value = data.quotes
                })
                .catch(e => {
                    console.error(e)
                })
        } // loadMainTopHeaderData() {


        function currencyRowsPaginationPageClicked(page) {
            current_page.value = page
            loadMainTopHeaderData()
        }


        function MainTopHeaderBlockOnMounted() {
            console.log('MainTopHeaderBlockOnMounted::')
            loadMainTopHeaderData()
        } // function MainTopHeaderBlockOnMounted() {

        onMounted(MainTopHeaderBlockOnMounted)

        return { // setup return
            //  Page state
            main_page_top_header_title,
            main_page_top_header_text,
            main_page_top_header_image_url,
            quotes,

            // Page actions
            loadMainTopHeaderData,

            // Settings vars
            settingsJsMomentDatetimeFormat,


            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            getHeaderIcon,
            sanitizeHtml,
        }
    }, // setup() {

}
</script>
