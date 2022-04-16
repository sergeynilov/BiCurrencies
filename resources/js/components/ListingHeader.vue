<template>


    <h3 class="card-title flex-nowrap admin_content_text">
<!--        show_filters_button::{{ show_filters_button }}<br>-->
<!--        page_rows_count::{{ page_rows_count }}<br>-->
<!--        right_icon::{{ right_icon }}<br>-->
<!--        right_icon_title::{{ right_icon_title }}<br>-->
<!--&lt;!&ndash;        headerTitle::{{ headerTitle}}<br>&ndash;&gt;-->
<!--        left_header_icon::{{ left_header_icon}}<br>-->
<!--        filtered_rows_count::{{ filtered_rows_count}}<br>-->
        <button type="button" class="btn btn-info mb-1 mr-1" @click="triggerShowFiltersModal" v-if="show_filters_button">
            <i :class="getHeaderIcon('filter')" class="m-0" :title="filters_count_text"
               v-if="filters_count_text"></i>
            Filters
        </button>

        <span v-if="filtered_rows_count > 0">
            <i :class="left_header_icon+' m-0 p-0 ml-2 mt-2'" :title="headerTitle" v-if="left_header_icon"></i>
        </span>

        <span v-html="( !isEmpty(filtered_rows_count) ?  page_rows_count + ' of '+filtered_rows_count : '' )+ ' ' + itemTitle"  v-if="filtered_rows_count > 0 && itemTitle" class="m-0 mt-2 ml-1 p-0">
        </span>

<!--        <button type="button" class="" @click.prevent="triggerListingHeaderRightButtonClickedEvent">-->
<!--            <i :class="getHeaderIcon('refresh')" class="ml-2 mt-2 i_action" :title="'Refresh page'"></i>-->
<!--        </button>-->

    </h3>

    <div class="card-tools" v-if="rightAddButtonLinkTitle || right_icon" style="display: flex; flex-wrap: nowrap;" >
        <inertia-link :href="route(rightAddButtonLink)" class="nav-link btn btn-sm btn-success" v-if="rightAddButtonLink">
            {{ rightAddButtonLinkTitle }}
        </inertia-link>

        <div v-if="right_icon">
<!--            ml-4 mb-2 mr-2 p-1-->
            <button type="button" class="btn btn-sm btn-secondary ml-2" @click.prevent="triggerListingHeaderRightButtonClickedEvent">
                <i :class="' action_icon icon_right_text_margin ' + getHeaderIcon(right_icon)" :title="right_icon_title"
               ></i>
            </button>
        </div>

    </div>


</template>

<script>
import {isEmpty, capitalize, getHeaderIcon} from '@/commonFuncs'
import {computed, onMounted, ref} from 'vue'

export default {
    props: {
        parent_component_key: {
            type: String,
            default: () => {
            }
        },
        headerTitle: {
            type: String,
            default: () => {
            }
        },
        left_header_icon: {
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
        right_icon: {
            type: String,
            default: () => {
            }
        },
        itemTitle: {
            type: String,
            default: () => {
            }
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


        right_icon_title: {
            type: String,
            default: 'Refresh'
        },
    }, // props: {

    setup(props) {
        let parent_component_key = computed({
            get: () => props.parent_component_key
        })


        let left_header_icon = computed({
            get: () => props.left_header_icon
        })
        let page_rows_count = computed({
            get: () => props.page_rows_count
        })
        let filtered_rows_count = computed({
            get: () => props.filtered_rows_count
        })
        let right_icon = computed({
            get: () => props.right_icon
        })
        let itemTitle = computed({
            get: () => props.itemTitle
        })
        let noDataFoundLabel = computed({
            get: () => props.noDataFoundLabel
        })
        let show_filters_button = computed({
            get: () => props.show_filters_button
        })
        let rightAddButtonLink = computed({
            get: () => props.rightAddButtonLink
        })
        let rightAddButtonLinkTitle = computed({
            get: () => props.rightAddButtonLinkTitle
        })
        let right_icon_title = computed({
            get: () => props.right_icon_title
        })
        let filters_count_text = ref('')

        function triggerListingHeaderRightButtonClickedEvent() {
            // console.log('SOURCE triggerListingHeaderRightButtonClickedEvent parent_component_key::')
            // console.log(parent_component_key)
            window.emitter.emit('listingHeaderRightButtonClickedEvent', {parent_component_key: parent_component_key.value})
        }

        function triggerShowFiltersModal() {
            console.log('SOURCE triggerShowFiltersModal parent_component_key::')
            console.log(parent_component_key)
            console.log(parent_component_key.value)
            window.emitter.emit('showFiltersModalEvent', {parent_component_key: parent_component_key.value})
        }


        function listingHeaderOnMounted() {
            // triggerShowFiltersModal() // DEBUGGING
            window.emitter.on('listingFilterModifiedEvent', params => {
                // console.log('TARGET listingFilterModifiedEvent params::')
                // console.log(params)
                if (params.parent_component_key === parent_component_key.value ) {
                    filters_count_text.value = params.filters_count_text
                }
            })
        } // function listingHeaderOnMounted() {

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
