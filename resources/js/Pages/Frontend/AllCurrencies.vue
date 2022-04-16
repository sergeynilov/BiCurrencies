<template>
    <frontend-layout>
        <TopCurrenciesBlock :show_only_top_currencies="false"></TopCurrenciesBlock>
    </frontend-layout>
</template>


<script>
import FrontendLayout from '@/Layouts/FrontendLayout'
import TopCurrenciesBlock from '@/Pages/Frontend/Home/TopCurrenciesBlock.vue'

export default {
    name: 'HomePage',
    components: {
        FrontendLayout,
        TopCurrenciesBlock,
    },
    setup(props) {
        // console.log('resources/js/Pages/Frontend/AllCurrencies.vue props::')

        return { // setup return
        }
    }, // setup() {

}
</script>
