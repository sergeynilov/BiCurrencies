<template>
    <frontend-layout>
        <section class="pt-4">

            <div class="container">
                <div class="row justify-content-center mb-6">
                    <div class="col-lg-6 col-xxl-5 text-center mx-auto mb-7" v-if="cMSItem.title">
                        <h5 class="fw-bold fs-3 fs-lg-5 fs-xxl-7 lh-sm mb-3">
                            {{ sanitizeHtml(cMSItem.title) }}
                        </h5>
                    </div>

                    <div class="col-xxl-11">
                        <div class="row flex-center gx-3">
                            <div v-if="cMSItem">
                                <div class="float-start">
                                    <img class="page_image_left_aligned" :src="image.url">
                                </div>
                                <div>
                                    <div v-html="sanitizeHtml(cMSItem.text)" class="pre-formatted"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </frontend-layout>
</template>


<script>
import FrontendLayout from '@/Layouts/FrontendLayout'
import {ref} from "vue";
import * as sanitizeHtml from 'sanitize-html';

export default {
    name: 'CMSItemPage',
    props: {
        cMSItem: {
            type: Object,
            required: true,
        },
        image: {
            type: Object,
            required: true,
        }
    },

    components: {
        FrontendLayout,
    },
    setup(props) {
        let cMSItem = ref(props.cMSItem)
        let image = ref(props.image)

        return { // setup return
            cMSItem,
            sanitizeHtml,
            image
        }
    }, // setup() {

}
</script>
