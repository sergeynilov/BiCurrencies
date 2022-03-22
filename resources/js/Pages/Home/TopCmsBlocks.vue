<template>

<!--    resources/js/Pages/Home/TopCmsBlocks.vue-->
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="z-index-2" style="margin-bottom:-545px;">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 order-1 order-md-0"><img class="img-fluid" :src="trusted_sources_block_header_image_url" alt="..." /></div>
                <div class="col-md-8">
                    <div class="ps-lg-8">
                        <h1 class="fs-lg-6 my-4">{{ trusted_sources_block_header_title }}</h1>
                        <p class="fs-1">{{ trusted_sources_block_header_text }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->


    <section class="pt-9 bg-soft-info">
        <div class="container" style="padding-top:400px;">
            <div class="row flex-center">
                <div class="col-md-6 order-1 order-md-0"><img class="w-100" :src="currency_rates_service_image_url" alt="..." /></div>
                <div class="col-md-6 gx-xl-9">
                    <h1 class="fs-lg-6 my-4">{{ currency_rates_service_title }}</h1>
                    <p class="fs-1">{{ currency_rates_service_text }}</p>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-soft-info pt-0">

<!--        currency_rates_service_title,-->
<!--        currency_rates_service_text,-->
<!--        currency_rates_service_image_url,-->


        <div class="container">
            <div class="row flex-center">
                <div class="col-md-6 order-0 order-md-1"><img class="w-100" :src="what_people_says_about_us_image_url" alt="..." /></div>
                <div class="col-md-6 gx-xl-9">
                    <h1 class="fs-lg-6 my-4">{{ what_people_says_about_us_title }}</h1>
                    <p class="fs-1">{{ what_people_says_about_us_text}}</p>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->

<!--    <section class="py-4 overflow-hidden">

        <div class="container">
            <div class="row h-100">
                <div class="col-lg-7 mx-auto text-center py-5">
                    <h5>DESIGN CONCEPT</h5>
                    <h5 class="fw-bold fs-3 fs-lg-5 fs-xxl-7">The best design team for your<br />studio website</h5>
                </div>
                <div class="col-12">
                    <div class="carousel slide" id="carouselDesignConcepts" data-bs-touch="false" data-bs-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <div class="row gx-3 px-3 pt-3 h-100">
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Safira Petterson</h3>
                                                <p>It would be only imprudent if you dont grab this app now and use it at its best, with all the great facilities it got.</p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Nazip Terasi</h3>
                                                <p>Myriad options and brillant outlook: what more I can ask for? I trust this app for it well furnished features and reliable modeling. The best of all is it got the option of scalability which opens up a big window of opportunity. It is the tool of future. </p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Manion Potter</h3>
                                                <p>From the production to deployment, this one is an absolute marvel to be work with. Give it your shot so that you don’t regret</p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Frankistain Belio</h3>
                                                <p>The app totally surprised me with its well planned designs and fine structured build-up. For a brilliant team-work, this one is a perfect choice. </p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="5000">
                                <div class="row gx-3 px-3 pt-3 h-100">
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Safira Petterson</h3>
                                                <p>It would be only imprudent if you dont grab this app now and use it at its best, with all the great facilities it got.</p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Nazip Terasi</h3>
                                                <p>Myriad options and brillant outlook: what more I can ask for? I trust this app for it well furnished features and reliable modeling. The best of all is it got the option of scalability which opens up a big window of opportunity. It is the tool of future. </p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Manion Potter</h3>
                                                <p>From the production to deployment, this one is an absolute marvel to be work with. Give it your shot so that you don’t regret</p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Frankistain Belio</h3>
                                                <p>The app totally surprised me with its well planned designs and fine structured build-up. For a brilliant team-work, this one is a perfect choice. </p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <div class="row gx-3 px-3 pt-3 h-100">
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Safira Petterson</h3>
                                                <p>It would be only imprudent if you dont grab this app now and use it at its best, with all the great facilities it got.</p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Nazip Terasi</h3>
                                                <p>Myriad options and brillant outlook: what more I can ask for? I trust this app for it well furnished features and reliable modeling. The best of all is it got the option of scalability which opens up a big window of opportunity. It is the tool of future. </p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Manion Potter</h3>
                                                <p>From the production to deployment, this one is an absolute marvel to be work with. Give it your shot so that you don’t regret</p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-5">
                                        <div class="card card-span shadow h-100 px-3 py-5">
                                            <div class="card-body">
                                                <h3>Frankistain Belio</h3>
                                                <p>The app totally surprised me with its well planned designs and fine structured build-up. For a brilliant team-work, this one is a perfect choice. </p><a href="#!">Experienced team</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 col-sm-2 col-lg-1 position-relative">
                                <button class="carousel-control-prev carousel-icon" type="button" data-bs-target="#carouselDesignConcepts" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                <button class="carousel-control-next carousel-icon" type="button" data-bs-target="#carouselDesignConcepts" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        &lt;!&ndash; end of .container&ndash;&gt;

    </section>
    &lt;!&ndash; <section> close ============================&ndash;&gt;-->
    <!-- ============================================-->

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

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels
} from '@/app.settings.js'

export default {
    name: 'FrontendMainTopHeaderBlock',
    components: {},
    setup(props) {
        console.log('FrontendMainTopHeaderBlock props::')
        console.log(props)

        // trusted_sources_block_header
        const trusted_sources_block_header_title = ref('')
        const trusted_sources_block_header_text = ref('')
        const trusted_sources_block_header_image_url = ref('')

        const currency_rates_service_title = ref('')
        const currency_rates_service_text = ref('')
        const currency_rates_service_image_url = ref('')

        const what_people_says_about_us_title = ref('')
        const  what_people_says_about_us_text = ref('')
        const  what_people_says_about_us_image_url = ref('')

        function loadMainPageArticlesData() {
            console.log('-2 loadMainPageArticlesData ::')
            let filters = {key: 'trusted_sources_block_header'}
            axios.post(route('frontend.get_block_cms_item'), filters)
                .then(({data}) => {
                    console.log('loadMainPageArticlesData data::')
                    console.log(data)
                    trusted_sources_block_header_title.value = data.cMSItem.title
                    trusted_sources_block_header_text.value = data.cMSItem.text
                    trusted_sources_block_header_image_url.value = data.image.url
                })
                .catch(error => {
                    console.error(error)
                })

            filters = {key: 'currency_rates_service'}
            axios.post(route('frontend.get_block_cms_item'), filters)
                .then(({data}) => {
                    console.log('loadMainPageArticlesData data::')
                    console.log(data)
                    currency_rates_service_title.value = data.cMSItem.title
                    currency_rates_service_text.value = data.cMSItem.text
                    currency_rates_service_image_url.value = data.image.url
                })
                .catch(error => {
                    console.error(error)
                })

            filters = {key: 'what_people_says_about_us'}
            axios.post(route('frontend.get_block_cms_item'), filters)
                .then(({data}) => {
                    console.log('loadMainPageArticlesData data::')
                    console.log(data)
                    what_people_says_about_us_title.value = data.cMSItem.title
                    what_people_says_about_us_text.value = data.cMSItem.text
                    what_people_says_about_us_image_url.value = data.image.url
                })
                .catch(error => {
                    console.error(error)
                })
        } // loadMainPageArticlesData() {


        function currencyRowsPaginationPageClicked(page) {
            current_page.value = page
            loadMainPageArticlesData()
        }


        const frontendMainTopHeaderBlockOnMounted = async () => {
            console.log('frontendMainTopHeaderBlockOnMounted::')
            loadMainPageArticlesData()
        } // const frontendMainTopHeaderBlockOnMounted = async () => {

        onMounted(frontendMainTopHeaderBlockOnMounted)

        return { // setup return
            //  Page state
            trusted_sources_block_header_title,
            trusted_sources_block_header_text,
            trusted_sources_block_header_image_url,

            currency_rates_service_title,
            currency_rates_service_text,
            currency_rates_service_image_url,

            what_people_says_about_us_title,
            what_people_says_about_us_text,
            what_people_says_about_us_image_url,
            // Page actions
            loadMainPageArticlesData,

            // Settings vars
            settingsJsMomentDatetimeFormat,


            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            getHeaderIcon,
        }
    }, // setup() {

}
</script>
