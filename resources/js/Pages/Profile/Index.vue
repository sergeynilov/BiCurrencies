<template>

    <frontend-layout>

<!--        <hr>-->
<!--        <hr>-->
<!--        <hr>-->
<!--        <hr>-->
<!--        profile_user_id::{{ profile_user_id}}-->

        <section id="designIdeas" v-if="profileUser">
<!--            profileUser::{{ profileUser}}<br>-->
<!--            authorArticles::{{ authorArticles}}<br>-->

            <div class="container">
                <div class="bg-holder  z-index--1" style="background-image:url(/images/design-concept-bg.png);background-position:center;background-size:cover;"></div>
                <!--/.bg-holder-->
<!--                profile_user_media_image_url::{{ profile_user_media_image_url}}-->
                <div class="row">
                    <div class="col-md-6 p-7 px-lg-7">
                        <div class="col-12 py-3">
                            <h5 class="fw-bold fs-3 fs-lg-4 lh-sm mb-5">{{ profileUser.name }}</h5>
                        </div>

                        <h5 class="fw-bold fs-3 fs-xxl-7">{{ profileUser.email }}</h5>
                        <p class="pe-xl-9" v-for="(nextProfileUserPermission, index) in profileUserPermissions" :key="index">
                            {{ nextProfileUserPermission.name }}
                        </p>
                    </div>

                    <div class="col-md-6 p-7 text-end">
                        <img class="frontend_img_preview_wrapper"  :src="profile_user_media_image_url">
                    </div>

                </div>


                <div class="row" v-if="authorArticles.length > 0">
                    <div class="col-md-12 px-7 px-lg-7">
                        <div class="col-12 py-3">
                            <h5 class="fw-bold fs-3 fs-lg-4 lh-sm mb-5">Published articles</h5>
                        </div>
                    </div>
                    <div class="col-md-6 px-7" v-for="(nextAuthorArticle, index) in authorArticles" :key="index">
                        <div class="d-flex align-items-start">

                            <div class="block_2columns_md p-2">
                                <div>
                                    <div class="float-start">
                                        <img class="currency_image_left_aligned"  :src="nextAuthorArticle.media_image_url">
                                    </div>
                                    <div >
                                        <h5>{{ nextAuthorArticle.title }}</h5>
                                        <div v-html="sanitizeHtml(concatStr(nextAuthorArticle.text,300))" class="pre-formatted"></div>
                                    </div>
                                </div>
                            </div>

                            <!--                            <img class="me-4 frontend_img_preview_wrapper" :src="nextAuthorArticle.media_image_url" :alt="nextAuthorArticle.title">-->
<!--                            <div class="flex-1">-->
<!--                                <h5>{{ nextAuthorArticle.title }}</h5>-->
<!--                                <p class="p-0 m-0">{{ concatStr(nextAuthorArticle.text,30) }}</p>-->
<!--                            </div>-->


                        </div>
                    </div>
                </div>

            </div>
        </section>

    </frontend-layout>


</template>

<script>
import FrontendLayout from '@/Layouts/FrontendLayout'
import axios from 'axios'
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import Multiselect from '@vueform/multiselect'

import {
    getHeaderIcon,
    pluralize,
    pluralize3,
    momentDatetime,
    getErrorMessage,
    getDictionaryLabel,
    concatStr,
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'
import * as sanitizeHtml from 'sanitize-html'

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels
} from '@/app.settings.js'

// file:///mnt/_work_sdb8/wwwroot/lar/BiCurrencies/resources/js/Components/ListingHeader.vue
// import app from '@/main.js'

export default {
    name: 'ProfilePage',
    // props: ['profile_user_id'],
    props: {profile_user_id: {
        type: Number,
        required: true,
    }},

    components: {
        FrontendLayout,
        Multiselect,
        // VueFinalModal,
        // TopCmsBlocks,
        // TopCurrenciesBlock,
        // OurAuthorsBlock,
        // MainTopHeaderBlock,
        // MainContactUsBlock,
        // ModalsContainer
    },
    setup(props, attrs) {
        // console.log('Profile props::')
        // console.log(props)
        // console.log('Profile attrs::')
        // console.log(attrs)
        let profile_user_id = ref(props.profile_user_id)
        let profileUser = ref({})
        let profileUserPermissions = ref([])
        let profile_user_media_image_url = ref(null)
        let authorArticles = ref([])

        function loadProfileUserData() {
            console.log('-2 loadProfileUserData ::')
            axios.get(route('profile.load_user_profile_data', profile_user_id.value))
                .then(({data}) => {
                    console.log('loadProfileUserData data::')
                    console.log(data)
                    profileUser.value = data.profileUser
                    profileUserPermissions.value = data.profileUserPermissions
                    profile_user_media_image_url.value = data.profile_user_media_image_url
                })
                .catch(e => {
                    console.error(e)
                })
        } // loadProfileUserData() {

        function loadAuthorArticles() {
            console.log('-2 loadAuthorArticles ::')
//// get_our_authors // Route::get('/profile/load_author_articles/{user_id}', [ProfileController::class, 'load_author_articles'])->name('profile.load_author_articles');

            axios.get(route('profile.load_author_articles', profile_user_id.value))
                .then(({data}) => {
                    console.log('loadAuthorArticles data::')
                    console.log(data)
                    authorArticles.value = data.authorArticles
                })
                .catch(e => {
                    console.error(e)
                })
        } // loadAuthorArticles() {

        function profilePageOnMounted() {
            console.log('profilePageOnMounted::')
            loadProfileUserData()
            loadAuthorArticles()
        } // function profilePageOnMounted() {

        onMounted(profilePageOnMounted)

        return { // setup return
            // Listing Page state
            profile_user_id,
            profileUser,
            profileUserPermissions,
            profile_user_media_image_url,
            loadProfileUserData,
            loadAuthorArticles,
            authorArticles,

            // Page actions

            // Settings vars
            settingsJsMomentDatetimeFormat,

            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            getHeaderIcon,
            getDictionaryLabel,
            concatStr,
            sanitizeHtml,
        }
    }, // setup() {

}
</script>
