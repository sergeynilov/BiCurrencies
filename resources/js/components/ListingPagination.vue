<template>
    <section class="m-0 p-2  pagination row_content">

<!--        /mnt/_work_sdb8/wwwroot/lar/photographers/li/resources/views/vendor/pagination/bootstrap-4.blade.php-->

<!--        paginationPages:;{{ paginationPages}}<br>-->
<!--        paginationPages.length:;{{ paginationPages.length}}<br>-->
<!--        filtered_rows_count:;{{ filtered_rows_count}}<br>-->
<!--        page_rows_count:;{{ page_rows_count}}<br>-->
        <ul :class="'pagination pagination-sm m-0 float-right ' + ' listing_pagination_' + parentComponentKey">

            <li class="page-item" v-show="hasPrev() && showNextPriorButtons">
                <a href="#" @click.prevent="changePage(prevPage)" class="">Prior</a>
            </li>

            <li class="page-item" v-show="hasFirst()">
                <a href="#" @click.prevent="changePage(1)" class="">1</a>
            </li>

            <li class="page-item" v-show="hasFirst()">
                ...
            </li>

            <li class="page-item" v-for="page in paginationPages" :key="page">
                <a href="#" @click.prevent="changePage(page)" v-show="currentPage !== page" class="page-link">
                    {{ page }}
                </a>
                <span v-show="currentPage === page" class="currentPage">{{ page }}</span>
            </li>

            <li class="page-item" v-show="hasLast()">
                ...
            </li>

            <li class="page-item" v-show="hasLast()">
                <a href="#" @click.prevent="changePage(totalPages)" class="">
                    {{ totalPages }}
                </a>
            </li>

            <li class="page-item mr-5" v-show="totalPages > 0 && paginationPages.length > 0">
                <span v-show="showPageNumberLabel && paginationPages.length">
                    &nbsp;{{ currentPage }}/{{ paginationPages.length }}
                </span>
                <span v-show="showRowsLabel" class="pl-1">&nbsp;{{ page_rows_count }} of {{ filtered_rows_count }} {{ itemTitle }} found</span>
            </li>

        </ul>

    </section>

</template>

<script>
import {isEmpty, capitalize} from '@/commonFuncs'
import {computed, ref} from 'vue'

import mitt from 'mitt';

const emitter = mitt();

// import app from '@/main.js'
// import mitt from 'mitt'
// const emitter = mitt()

export default {
    props: {
        currentPage: {
            type: Number,
            required: true,
            default: 1
        },
        page_rows_count: {
            type: Number,
            required: true,
            default: 1
        },
        filtered_rows_count: {
            type: Number,
            required: true,
            default: 1
        },
        itemsPerPage: {
            type: Number,
            required: true,
        },
        showNextPriorButtons: {
            type: Boolean,
            required: true,
            default: true
        },
        showPageNumberLabel: {
            type: Boolean,
            required: false,
            default: false
        },
        showRowsLabel: {
            type: Boolean,
            required: false,
            default: false
        },
        itemTitle: {
            type: String,
            required: false,
            default: 'item'
        },
        parentComponentKey: {
            type: String,
            default: () => {
            }
        },

    }, // props: {

    setup(props) {
        // console.log('setup props::')
        // console.log(props)
        // PROPS COMPUTED START

        const currentPage = computed(() => {
            // console.log('props::')
            // console.log(props)

            return props.currentPage
        })
        const page_rows_count = computed(() => {
            return props.page_rows_count
        })
        const filtered_rows_count = computed(() => {
            return props.filtered_rows_count
        })
        const itemsPerPage = computed(() => {
            return props.itemsPerPage
        })
        const showNextPriorButtons = computed(() => {
            return props.showNextPriorButtons
        })
        const showPageNumberLabel = computed(() => {
            return props.showPageNumberLabel
        })
        const showRowsLabel = computed(() => {
            return props.showRowsLabel
        })
        const itemTitle = computed(() => {
            return props.itemTitle
        })
        const pagesRange = computed(() => {
            return props.pagesRange
        })
        const parentComponentKey = computed({
            get: () => props.parentComponentKey
        })

/*
        const items_count = ref(3)
        const show_first_item = ref(false)
        const show_last_item = ref(false)
        const limit_start= ref(1)
        const limit_end= ref(1)


        if (paginationPages.length > items_count*2) {
            limit_start.value= currentPage.value - 1
            limit_end.value= limit_start.value + 2
        }

        if(currentPage.value >= items_count.value) {
            show_first_item.value= true
        }
        if($paginator->lastPage() > currentPage.value + 1) {
            show_last_item.value= true
        }

*/


        // PROPS COMPUTED END

        const paginationPages = computed(() => {
            let pages = []
            if (rangeStart.value === 1 && rangeEnd.value === 1) return pages
            for (let i = rangeStart.value; i <= rangeEnd.value; i++) {
                pages.push(i)
            }
            return pages
        })
        // COMPUTED BLOCK START
        const rangeStart = computed(() => {
            let start = currentPage.value - pagesRange.value
            return (start > 0) ? start : 1
        })
        const rangeEnd = computed(() => {
            let end = currentPage.value + pagesRange.value
            return (end < totalPages.value) ? end : totalPages.value
        })
        const totalPages = computed(() => {
            return Math.ceil(filtered_rows_count.value / itemsPerPage.value)
        })
        const nextPage = computed(() => {
            return currentPage.value + 1
        })
        const prevPage = computed(() => {
            return currentPage.value - 1
        })
        // COMPUTED BLOCK END

        // FUNCTIONS BLOCK START
        function hasFirst() {
            return rangeStart.value !== 1
        }

        function hasLast() {
            return rangeEnd.value < totalPages.value
        }

        function hasPrev() {
            return currentPage.value > 1
        }

        function hasNext() {
            return currentPage.value < totalPages.value
        }

        function changePage(page) {
            console.log('changePage page::')
            console.log(page)
            window.emitter.emit('paginationPageChangedEvent', {
                parentComponentKey: parentComponentKey.value,
                page: page
            })
        }

        // FUNCTIONS BLOCK END
        return { // setup return
            // Common methods
            isEmpty,

            filtered_rows_count,
            page_rows_count,

        // Component actions
            paginationPages,
            totalPages,
            hasFirst,
            hasLast,
            hasPrev,
            hasNext,
            changePage
        }
    }, // setup(props) {

}
</script>

<style lang="scss" scoped>

.pagination {
    width: 100%;
    display: flex;
    justify-content: flex-start !important;
    margin: 30px auto 30px;
    padding: 0 10px;
    max-width: 1280px;
}

.pagination__left, .pagination__right {
    width: 20%;
}

.pagination__left {
    float: left;
}

.pagination__right {
    float: right;
}

.pagination__right a {
    float: right;
}

.pagination a, .pagination span {
    display: block;
    text-align: center;
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 300;
    line-height: 34px;
    height: 36px;
}

.pagination a {
    padding: 0 10px;
    max-width: 160px;
    background-color: transparent;
    border-radius: 4px;
    border: 1px solid #ccc;
    text-decoration: none;
    margin: 0 6px;
    transition: all .2s ease-in-out;
}

.currentPage {
    font-weight: bold;
    color: white !important;
    width: 40px !important;
    padding-bottom: 0.9rem;
    //line-height: 0.9rem;
    //text-decoration: underline;
    //border:2px dotted red !important;
}

.pagination {
    font-weight: bold;
    color: white !important;
    //width:40px !important;
    //border:2px dotted yellow !important;
    text-align: center;
}

@media (hover) {
    .pagination a:hover {
        border-color: #939393;
        color: #939393;
    }
}

.pagination__mid {
    display: flex;
    justify-content: center;
    width: 60%;
}

.pagination__mid ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination__mid li {
    display: inline-block;
}

</style>
