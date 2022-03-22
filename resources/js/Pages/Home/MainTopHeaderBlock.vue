<template>

    <!-- Content BLOCK START -->
    <section class="py-5 overflow-hidden" id="home">
        <div class="bg-holder w-50 bg-right d-none d-md-block"
             :style="'background-image:url( ' + main_page_top_header_image_url + ');' ">
<!--            width:540px !important; height:auto !important;-->
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row">

                <div class="col-md-7 col-lg-6 pt-8 text-md-start text-center">
                    <h4 class="fw-normal text-400">{{ main_page_top_header_title }}</h4>
                    <h1 class="mb-5 display-1 fs-md-5 fs-lg-6 fs-xl-7 fs-xxl-8">{{ main_page_top_header_text }}</h1>
                    <a class="btn btn-primary" href="#" role="button">Get In Touch</a>
                    <div class="mt-8">
                        <div class="carousel slide" id="carouselPopularItems" data-bs-touch="false"
                             data-bs-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="10000">
                                    <div class="row gx-3 h-100 align-items-center">
                                        <h1 class="fs-4 fs-md-3 fs-lg-4">I feel so much less stressed <i
                                            class="fa fa-heart text-danger fs-2"></i> <br class="d-md-none d-lg-block">as
                                            I now know by the book and hopefully ..."</h1>
                                        <div class="d-flex align-items-md-center">
                                            <img class="img-fluid me-4 me-md-3 me-lg-4"
                                                 src="/images/main_page_top_header__DEL.webp" width="100" alt=""/>
                                            <div class="w-lg-50 my-3">
                                                <h5 class="mb-0 fw-bold">Andry Ford</h5>
                                                <p class="fw-normal mb-0">CEO at Whatever</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="row gx-3 h-100 align-items-center">
                                        <h1 class="fs-4 fs-md-3 fs-lg-4">Amazing theme, excellent support from
                                            ThemeWagon with really fast reaction time!</h1>
                                        <div class="d-flex align-items-md-center"><img
                                            class="img-fluid me-4 me-md-3 me-lg-4" src="/assets/img/gallery/user-2.png"
                                            width="100" alt=""/>
                                            <div class="w-lg-50 my-3">
                                                <h5 class="mb-0 fw-bold">Kosta</h5>
                                                <p class="fw-normal mb-0">Designer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <div class="row gx-3 h-100 align-items-center">
                                        <h1 class="fs-4 fs-md-3 fs-lg-4">Excellent. All my doubts were answered by the
                                            team quickly. I highly recommend it.</h1>
                                        <div class="d-flex align-items-md-center"><img
                                            class="img-fluid me-4 me-md-3 me-lg-4" src="/assets/img/gallery/user-1.png"
                                            width="100" alt=""/>
                                            <div class="w-lg-50 my-3">
                                                <h5 class="mb-0 fw-bold">Vitor</h5>
                                                <p class="fw-normal mb-0">Developer</p>
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

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels
} from '@/app.settings.js'

export default {
    name: 'MainTopHeaderBlock',
    components: {},
    setup(props) {
        console.log('MainTopHeaderBlock props::')
        console.log(props)

        const main_page_top_header_title = ref('')
        const main_page_top_header_text = ref('')
        const main_page_top_header_image_url = ref('')


        function loadMainTopHeaderData() {
            console.log('-2 loadMainTopHeaderData ::')
            let filters = {key: 'main_page_top_header_block'}
            axios.post(route('frontend.get_block_cms_item'), filters)
                .then(({data}) => {
                    console.log('loadMainTopHeaderData data::')
                    console.log(data)
                    main_page_top_header_title.value = data.cMSItem.title
                    main_page_top_header_text.value = data.cMSItem.text
                    main_page_top_header_image_url.value = data.image.url
                })
                .catch(error => {
                    console.error(error)
                })
        } // loadMainTopHeaderData() {


        function currencyRowsPaginationPageClicked(page) {
            current_page.value = page
            loadMainTopHeaderData()
        }


        const MainTopHeaderBlockOnMounted = async () => {
            console.log('MainTopHeaderBlockOnMounted::')
            loadMainTopHeaderData()
        } // const MainTopHeaderBlockOnMounted = async () => {

        onMounted(MainTopHeaderBlockOnMounted)

        return { // setup return
            //  Page state
            main_page_top_header_title,
            main_page_top_header_text,
            main_page_top_header_image_url,


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
        }
    }, // setup() {

}
</script>
