<template>

    <section class="py-0">
        <div class="bg-holder  rounded-3" style="background-image:url(/images/review-bg.png);background-position:center;background-size:contain;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row flex-center">
                <div class="col-xl-8">
                    <div class="mb-7"  v-for="(nextQuote, index) in quotes" :key="index">
                        <h1 class="fs-4">{{ nextQuote.text}}</h1>
                        <div class="d-flex align-items-md-center mt-5"><img class="img-fluid me-4 me-md-3 me-lg-4" :src="nextQuote.media_image_url" width="100" alt="" />
                            <div class="w-lg-100 my-2">
                                <h5 class="mb-0 fw-bold">{{ nextQuote.author_name }}</h5>
                                <p class="fw-normal mb-0">{{ nextQuote.occupation }}</p>
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
    name: 'MainQuotesBlockBlock',
    components: {},
    setup(props) {
        let quotes = ref([])
        // let main_page_top_quote_author_name = ref('')
        // let main_page_top_quote_text = ref('')
        // let     main_page_top_quote_image_url = ref('')

        function loadMainQuotesBlockData() {

            axios.post(route('frontend.get_block_quote', { keys: [ 'ernest_hemingway_panacea_quote', 'kevin_o_leary_quote' ]}))
                .then(({data}) => {
                    quotes.value = data.quotes
                })
                .catch(e => {
                    console.error(e)
                })
        } // loadMainQuotesBlockData() {


        function currencyRowsPaginationPageClicked(page) {
            current_page.value = page
            loadMainQuotesBlockData()
        }


        function MainQuotesBlockBlockOnMounted() {
            console.log('MainQuotesBlockBlockOnMounted::')
            loadMainQuotesBlockData()
        } // function MainQuotesBlockBlockOnMounted() {

        onMounted(MainQuotesBlockBlockOnMounted)

        return { // setup return
            //  Page state
            quotes,
            // main_page_top_quote_author_name,
            // main_page_top_quote_text,
            // main_page_top_quote_image_url,

            // Page actions
            loadMainQuotesBlockData,

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
