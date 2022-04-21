<template>

    <frontend-layout>

        <MainTopHeaderBlock></MainTopHeaderBlock>

        <TopCmsBlocks ></TopCmsBlocks>

        <OurAuthorsBlock></OurAuthorsBlock>

        <TopCurrenciesBlock :show_only_top_currencies="true"></TopCurrenciesBlock>

        <MainQuotesBlock></MainQuotesBlock>

        <MainContactUsBlock></MainContactUsBlock>

    </frontend-layout>


</template>

<script>
import FrontendLayout from '@/Layouts/FrontendLayout'
import TopCmsBlocks from '@/Pages/Frontend/Home/TopCmsBlocks.vue'
import TopCurrenciesBlock from '@/Pages/Frontend/Home/TopCurrenciesBlock.vue'
import OurAuthorsBlock from '@/Pages/Frontend/Home/OurAuthorsBlock.vue'
import MainTopHeaderBlock from '@/Pages/Frontend/Home/MainTopHeaderBlock.vue'
import MainContactUsBlock from '@/Pages/Frontend/Home/MainContactUsBlock.vue'
import MainQuotesBlock from '@/Pages/Frontend/Home/MainQuotesBlock.vue'

import {ref, computed, onMounted} from 'vue'

export default {
    name: 'HomePage',
    components: {
        FrontendLayout,
        TopCmsBlocks,
        TopCurrenciesBlock,
        OurAuthorsBlock,
        MainTopHeaderBlock,
        MainContactUsBlock,
        MainQuotesBlock,
    },
    setup() {
        function HomeOnMounted() {
        } // function HomeOnMounted() {

        onMounted(HomeOnMounted)

        return { // setup return
            // Listing Page state
        }
    }, // setup() {

}
</script>
