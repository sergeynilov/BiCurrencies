<template>
    <section class="pt-4">
        <div class="container">

            <div class="row justify-content-center mb-6">
                <div class="col-lg-6 col-xxl-5 text-center mx-auto mb-7">
                    <h5 class="fw-bold fs-3 fs-lg-5 fs-xxl-7 lh-sm mb-3">{{ sanitizeHtml(main_page_our_authors_block_title) }}</h5>
                    <p class="mb-0">{{ sanitizeHtml(main_page_our_authors_block_text)}}</p>
                </div>
                <div class="col-xxl-11">

                    <div class="row flex-center gx-3">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0 text-center" v-for="(nextOurAuthor, index) in ourAuthors" :key="index">
                            <inertia-link :href="route('profile.view', nextOurAuthor.author.id)">
                                <img class="author_avatar_big_image" :src="nextOurAuthor.media_image_url" alt="...">
                            </inertia-link>
                            <h5 class="fw-bold mt-2 mb-1">
                                <inertia-link :href="route('profile.view', nextOurAuthor.author.id)">
                                    {{ nextOurAuthor.author.id }}=>{{ nextOurAuthor.author.name }}
                                </inertia-link>

                                <inertia-link :href="route('profile.view', nextOurAuthor.author.id)"
                                              class="btn btn-info m-1 p-1  pb-0 pt-0">
                                    <i :class="getHeaderIcon('profile')" title="Open Profile"></i>
                                </inertia-link>
                            </h5>
                            <h5 class="mt-2 mb-1 small fa-w-4">
                                {{ nextOurAuthor.cms_items_count }} {{ pluralize(nextOurAuthor.cms_items_count, 'Publication', 'Publications') }}
                            </h5>
<!--                            <p>Ceo</p>-->
<!--                            Route::get('/profile/{user_id}', [ProfileController::class, 'index'])->name('profile.view');-->

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
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
import * as sanitizeHtml from 'sanitize-html'

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels
} from '@/app.settings.js'

export default {
    name: 'FrontendOurAuthorBlock',
    components: {},
    setup(props) {
        // console.log('FrontendOurAuthorBlock props::')
        // console.log(props)

        let ourAuthors = ref([])
        let main_page_our_authors_block_title = ref('')
        let main_page_our_authors_block_text = ref('')
        let main_page_our_authors_block_image_url = ref('')
        function loadOurAuthorsData() {
            // console.log('-2 loadOurAuthorsData ::')
            axios.get(route('frontend.get_block_cms_item', 'main_page_our_authors_block'))
                .then(({data}) => {
                    // console.log('get_block_cms_item data::')
                    // console.log(data)
                    main_page_our_authors_block_title.value = data.cMSItem.title
                    main_page_our_authors_block_text.value = data.cMSItem.text
                    main_page_our_authors_block_image_url.value = data.image.url
                })
                .catch(e => {
                    console.error(e)
                })

            // Route::get('/get_our_authors', [HomeController::class, 'get_our_authors'])->name('frontend.get_our_authors');
            axios.get(route('frontend.get_our_authors'))
                .then(({data}) => {
                    // console.log('loadOurAuthorsData data::')
                    // console.log(data)
                    ourAuthors.value= data.authors
                })
                .catch(e => {
                    console.error(e)
                })



        } // loadOurAuthorsData() {


        function currencyRowsPaginationPageClicked(page) {
            current_page.value = page
            loadOurAuthorsData()
        }


        function frontendOurAuthorBlockOnMounted() {
            console.log('frontendOurAuthorBlockOnMounted::')
            loadOurAuthorsData()
        } // function frontendOurAuthorBlockOnMounted() {

        onMounted(frontendOurAuthorBlockOnMounted)

        return {
            //  Page state
            ourAuthors,
            main_page_our_authors_block_title,
            main_page_our_authors_block_text,
            main_page_our_authors_block_image_url,

            // Page actions
            loadOurAuthorsData,

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
