With  vuejs 3/bootstrap 4 I use left sidebar
<aside class="main-sidebar" v-show="is_left_sidebar_block_visible">
    <!-- Brand Logo -->
    <inertia-link :href="route('admin.dashboard.index')" >
        <img :src="'/dist/img/Logo.png'" alt="Logo" class="img-circle " style="opacity: .8">
        <span class="brand-text font-weight-light">{{ site_name }}</span>
    </inertia-link>

    <!-- Sidebar -->
    <div class="sidebar" >
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img :src="'/dist/img/user.jpg'" class="" alt="User Image">
            </div>
            <div class="info" v-show="is_left_sidebar_visible">
                <a href="#" class="d-block">{{user.name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <inertia-link :href="route('admin.dashboard.index')" class="nav-link" :class="route().current('admin.dashboard.*') ? 'active' : ' '">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p v-show="is_left_sidebar_visible">
                            Dashboard
                        </p>
                    </inertia-link>
                </li>

and I need to hide a) all left_sidebar_block 2) text at right from icon. I have 2 vars for this
is_left_sidebar_block_visible - hides all left sidebar block
is_left_sidebar_visible - hides text at right from icon

But with v-show condition - have free empty space. I dislike it as I need to remove this free space with some smooth effect..

How can I dfo it ?

