<template>

<!--    <inertia-link :href="route('admin.currencies.index')" class="nav-link" :class="route().current('admin.currencies.*') ? 'active' : ' '">-->
<!--        <i class="far fa-circle nav-icon"></i>-->

    <inertia-link :href="route(link_to)" class="nav-link" :class="route().current('admin.currencies.*') ? 'active' : ' '">
        <i :class="getHeaderIcon(link_icon)" class="mr-1" ></i>
        <transition name="fade">
            <span v-if="!collapsed">
                <slot/>
            </span>
        </transition>

    </inertia-link>

<!--    <SidebarLink link_to="admin.currencies.index" link_icon="currency" link_active="'admin.currencies.*'">Currencies 1</SidebarLink>-->

    <!--  <router-link :to="to" class="link" :class="{ active: isActive }">-->
    <!--    <SidebarLink to="route('admin.currencies.index')" icon="currency">Currencies 1</SidebarLink>-->
<!--    link_to::{{link_to}}<br>-->
<!--    link_icon::{{link_icon}}<br>-->

<!--    <i class="icon" :class="icon"/>
    <transition name="fade">
      <span v-if="!collapsed">
        <slot/>
      </span>
    </transition>
    &lt;!&ndash;  </router-link>&ndash;&gt;-->
</template>

<script>
import {computed, ref} from 'vue'
// import { useRoute } from 'vue-router'
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
        link_active: {
            type: String,
            required: false
        }
    },
    setup(props) {
        // const route = useRoute()
        const isActive = computed(() => false /* route.path === props.to */)
        const link_to = ref( props.link_to )
        const link_icon = ref( props.link_icon )

        return {
            isActive,
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
