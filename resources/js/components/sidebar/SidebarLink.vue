<template>

<!--    active_component::<br>{{ active_component}}<br>-->
<!--    $page.component.::<br>{{ $page.component}}<br>-->
<!--    active_component="'admin.currencies.*'"-->
    <inertia-link :href="route(link_to)" class="nav-link"  :class="{ 'active-nav-link': $page.component.startsWith(active_component) }">
        <i :class="getHeaderIcon(link_icon)" class="mr-1" ></i>
        <transition name="fade">
            <span v-if="!collapsed">
                <slot/>
            </span>
        </transition>
    </inertia-link>

</template>

<script>
import {computed, ref} from 'vue'
import {collapsed} from './state'
import {
    getHeaderIcon,
} from '@/commonFuncs'

export default {
    props: {
        link_to: {
            type: String,
            required: true
        },
        link_icon: {
            type: String,
            required: true
        },
        active_component: {
            type: String,
            required: false
        }
    },
    setup(props) {
        const link_to = ref( props.link_to )
        const link_icon = ref( props.link_icon )

        return {
            collapsed,
            link_to,
            link_icon,
            getHeaderIcon
        }
    }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.1s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.link {
    display: flex;
    align-items: center;

    cursor: pointer;
    position: relative;
    font-weight: 400;
    user-select: none;

    margin: 0.1em 0;
    padding: 0.4em;
    border-radius: 0.25em;
    height: 1.5em;

    color: white;
    text-decoration: none;
}

.link:hover {
    background-color: var(--sidebar-item-hover);
}

.link.active {
    background-color: var(--sidebar-item-active);
}

.link .icon {
    flex-shrink: 0;
    width: 25px;
    margin-right: 10px;
}
</style>
