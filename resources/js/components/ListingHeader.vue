<template>


    <h3 class="card-title flex-nowrap">
<!--        show_filters_button::{{ show_filters_button }}<br>-->
<!--        page_rows_count::{{ page_rows_count }}<br>-->
<!--        rightIconTitle::{{ rightIconTitle }}<br>-->
        <button type="button" class="btn btn-info mb-1 mr-1" @click="triggerShowFiltersModal" v-show="show_filters_button">
            <i :class="getHeaderIcon('filter')" class="m-0" :title="filters_count_text"
               v-show="filters_count_text"></i>
            Filters
        </button>

        <i :class="headerIcon+' m-0 p-0 ml-2 mt-2'" :title="headerTitle" v-if="headerIcon && filtered_rows_count > 0"></i>

        <span v-html="( !isEmpty(filtered_rows_count) ?  page_rows_count + ' of '+filtered_rows_count : '' )+ ' ' + itemTitle"  v-if="filtered_rows_count > 0 && itemTitle && !showLoadingImage" class="m-0 mt-2 ml-1 p-0">
        </span>

        <i :class="getHeaderIcon('refresh')" class="ml-2 mt-2 i_action" :title="'Refresh page'"
           @click.prevent="triggerListingHeaderRightButtonClickedEvent"></i>

    </h3>

    <div class="card-tools" v-if="!showLoadingImage && (rightAddButtonLinkTitle || rightIcon) ">
        <inertia-link :href="route(rightAddButtonLink)" class="nav-link btn btn-sm btn-success" v-show="rightAddButtonLink">
            {{ rightAddButtonLinkTitle }}
        </inertia-link>

        <div v-if="rightIcon">
            <i :class="'ml-4 mb-2 mr-2 p-1 a_link_reversed ' + rightIcon" :title="rightIconTitle"
               @click.prevent="triggerListingHeaderRightButtonClickedEvent"></i>
        </div>

    </div>


</template>

<script>
import {isEmpty, capitalize, getHeaderIcon} from '@/commonFuncs'
import {computed, onMounted, ref} from 'vue'

export default {
    props: {
        parentComponentKey: {
            type: String,
            default: () => {
            }
        },
        headerTitle: {
            type: String,
            default: () => {
            }
        },
        headerIcon: {
            type: String,
            default: () => {
            }
        },
        page_rows_count: {
            type: Number,
            default: () => {
            }
        },
        filtered_rows_count: {
            type: Number,
            default: () => {
            }
        },
        rightIcon: {
            type: String,
            default: () => {
            }
        },
        itemTitle: {
            type: String,
            default: () => {
            }
        },
        showLoadingImage: {
            type: Boolean,
            default: false,
            required: true
        },
        show_filters_button: {
            type: Boolean,
            default: false,
            required: false
        },
        rightAddButtonLink: {
            type: String,
        },
        rightAddButtonLinkTitle: {
            type: String,
            default: 'Add'
        },


        rightIconTitle: {
            type: String,
            default: 'Refresh'
        },
    }, // props: {

    setup(props) {
        const parentComponentKey = computed({
            get: () => props.parentComponentKey
        })


        const headerIcon = computed({
            get: () => props.headerIcon
        })
        const page_rows_count = computed({
            get: () => props.page_rows_count
        })
        const filtered_rows_count = computed({
            get: () => props.filtered_rows_count
        })
        const rightIcon = computed({
            get: () => props.rightIcon
        })
        const itemTitle = computed({
            get: () => props.itemTitle
        })
        const noDataFoundLabel = computed({
            get: () => props.noDataFoundLabel
        })
        const showLoadingImage = computed({
            get: () => props.showLoadingImage
        })
        const show_filters_button = computed({
            get: () => props.show_filters_button
        })
        const rightAddButtonLink = computed({
            get: () => props.rightAddButtonLink
        })
        const rightAddButtonLinkTitle = computed({
            get: () => props.rightAddButtonLinkTitle
        })
        const rightIconTitle = computed({
            get: () => props.rightIconTitle
        })
        const filters_count_text = ref('')

        function triggerListingHeaderRightButtonClickedEvent() {
            console.log('SOURCE triggerListingHeaderRightButtonClickedEvent parentComponentKey::')
            console.log(parentComponentKey)
            window.emitter.emit('listingHeaderRightButtonClickedEvent', {parentComponentKey: parentComponentKey.value})
        }

        function triggerShowFiltersModal() {
            console.log('SOURCE triggerShowFiltersModal parentComponentKey::')
            console.log(parentComponentKey)
            console.log(parentComponentKey.value)
            window.emitter.emit('showFiltersModalEvent', {parentComponentKey: parentComponentKey.value})
        }


        const listingHeaderOnMounted = async () => {
            // triggerShowFiltersModal() // DEBUGGING
            window.emitter.on('listingFilterModifiedEvent', params => {
                // console.log('TARGET listingFilterModifiedEvent params::')
                // console.log(params)
                if (params.parentComponentKey === parentComponentKey.value ) {
                    filters_count_text.value = params.filters_count_text
                }
            })
        } // const listingHeaderOnMounted = async () => {

        onMounted(listingHeaderOnMounted)

        return {
            // Common methods
            isEmpty,
            capitalize,
            getHeaderIcon,
            filters_count_text,

            // Component actions
            triggerListingHeaderRightButtonClickedEvent,
            triggerShowFiltersModal
        }
    }, // setup(props) {

}
</script>
